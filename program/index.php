<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("database.php");

$table = "<div class='container'>";

// A felhasználó által keresett kritériumok lekérdezése
if (isset($_POST['kereses'])) {

    $ertekeles = "";
    $tanar = "";

    if(!empty($_POST['tantargy'])){
        echo $_POST['tantargy'];
    }



    //Ha nem üres az értékelés mező
    if (!empty($_POST['ertekeles'])) {
        $ertekeles = $_POST['ertekeles'];

        $sqlFind = "SELECT tanarok.id as 'id', concat(tanarok.vezeteknev, ' ', tanarok.keresztnev) as 'tanar', tantargyak.nev as 'nev', round(avg(ertekelesek.ertekeles), 1) AS 'ertekeles' FROM tantargyak INNER JOIN tantargykapcsolotabla on tantargyak.id = tantargykapcsolotabla.tantargy_id INNER JOIN tanarok on tantargykapcsolotabla.tanar_id = tanarok.id INNER JOIN ertekelesek on tanarok.id = ertekelesek.tanar_id
        GROUP BY tanarok.vezeteknev, tanarok.keresztnev HAVING ertekeles >= $ertekeles;
        ";
    }
    //Ha a tanár mező nem üres
    else if (!empty($_POST['tanar'])) {
        $tanar = $_POST["tanar"];

        $sqlFind = "SELECT tanarok.id as 'id', concat(tanarok.vezeteknev, ' ', tanarok.keresztnev) as 'tanar', tantargyak.nev as 'nev', round(avg(ertekelesek.ertekeles), 1) AS 'ertekeles' FROM tantargyak INNER JOIN tantargykapcsolotabla on tantargyak.id = tantargykapcsolotabla.tantargy_id INNER JOIN tanarok on tantargykapcsolotabla.tanar_id = tanarok.id INNER JOIN ertekelesek on tanarok.id = ertekelesek.tanar_id 
        GROUP BY tanarok.vezeteknev, tanarok.keresztnev having tanarok.vezeteknev like '%$tanar%' or tanarok.keresztnev LIKE '%$tanar%'";
    }
    //Ha egyik mező sem üres
    else if (!empty($_POST['tanar']) && !empty($_POST['ertekeles'])) {
        $tanar = $_POST["tanar"];
        $ertekeles = $_POST['ertekeles'];
        $sqlFind = "SELECT tanarok.id as 'id', concat(tanarok.vezeteknev, ' ', tanarok.keresztnev) as 'tanar', tantargyak.nev as 'nev', round(avg(ertekelesek.ertekeles), 1) AS 'ertekeles' FROM tantargyak INNER JOIN tantargykapcsolotabla on tantargyak.id = tantargykapcsolotabla.tantargy_id INNER JOIN tanarok on tantargykapcsolotabla.tanar_id = tanarok.id INNER JOIN ertekelesek on tanarok.id = ertekelesek.tanar_id GROUP BY tanarok.vezeteknev, tanarok.keresztnev having ertekeles >= $ertekeles and (tanarok.vezeteknev like '%$tanar%' or tanarok.keresztnev LIKE '%$tanar%')";
    }


    $queryFind = mysqli_query($conn, $sqlFind);


    if (mysqli_num_rows($queryFind) > 0) {
        $picture = "./projectImg/manFace.png";
        while ($row = mysqli_fetch_assoc($queryFind)) {
            $table .=
                "<div class='box'>
            <img src={$picture} alt='tanar kep' title='tanar kep' width=200px height=200px />
            <p>{$row["tanar"]}</p>
            <h3>{$row["nev"]}</h3>
            <h3>{$row["ertekeles"]}</h3>
            <a href='informacio.php?id={$row["id"]}'><button type='button'>Információk</button></a>
        </div>";
        }
        $table .= "</div>";
    } else {
        $table .= "Nincs ilyen tanár.";
        $ertekeles = "";
        $tanar = "";
    }
} else {
    // Összes tanár lekérdezése
    //Ha nem kattintott rá a keresés gombra.
    $sql = "SELECT tanarok.vezeteknev as 'vezeteknev', tanarok.keresztnev as 'keresztnev', tanarok.id as 'id', tantargyak.nev as 'nev', round(avg(ertekelesek.ertekeles), 1) as 'ertekeles' FROM `tantargykapcsolotabla` inner join tanarok on tantargykapcsolotabla.tanar_id = tanarok.id inner join ertekelesek on tanarok.id = ertekelesek.tanar_id inner JOIN tantargyak on tantargyak.id = tantargykapcsolotabla.tantargy_id GROUP BY tanarok.vezeteknev, tanarok.keresztnev";
    $query = mysqli_query($conn, $sql);


    if (mysqli_num_rows($query) > 0) {
        $picture = "./projectImg/manFace.png";
        while ($row = mysqli_fetch_assoc($query)) {
            $table .=
                "<div class='box'>
            <img src={$picture} alt='tanar kep' title='tanar kep' width=200px height=200px />
            <p>{$row["vezeteknev"]} {$row["keresztnev"]}</p>
            <h3>{$row["nev"]}</h3>
            <h3>{$row["ertekeles"]}</h3>
            <a href='informacio.php?id={$row["id"]}'><button type='button'>Információk</button></a>
        </div>";
        }
        $table .= "</div>";
    }



    
}

// Legjobbra értékelt tanárok lekérdezése

$sqlTop = "SELECT tanarok.vezeteknev AS 'vezeteknev', tanarok.keresztnev AS 'keresztnev', round(avg(ertekelesek.ertekeles), 1) AS 'atlag' FROM `tanarok` inner JOIN ertekelesek on tanarok.id = ertekelesek.tanar_id GROUP BY tanarok.vezeteknev, tanarok.keresztnev ORDER BY atlag DESC limit 6";
$queryTop = mysqli_query($conn, $sqlTop);

$topTable = "<div class='toplistacontainer'>";

if (mysqli_num_rows($queryTop) > 0) {
    while ($top = mysqli_fetch_assoc($queryTop)) {
        $topTable .=
            "<div class='topBox'>
            <p>{$top["vezeteknev"]} {$top["keresztnev"]} {$top["atlag"]}</p>
        </div>";
    }
    $topTable .= "</div>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>

</head>

<body>
    <h1>Legjobbra értékelt tanárok</h1>
    <?php echo $topTable ?>

    <form action="" method="post">
        <label for="ertekeles">Értékelés:
            <input type="number" name="ertekeles" id="ertekeles">
        </label>
        <label for="tanar">Tanár
            <input type="text" name="tanar" id="tanar">
        </label>
        <button type="submit" name="kereses" id="kereses">Keresés</button>
        <button type="submit" name="reset" id="reset">Reset</button>
    </form>


    <?php echo $table  ?>
</body>

</html>