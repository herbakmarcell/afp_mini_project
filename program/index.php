<?php 

include_once("database.php");

// Összes tanár lekérdezése

$sql = "SELECT tanarok.vezeteknev as 'vezeteknev', tanarok.keresztnev as 'keresztnev', tanarok.id as 'id', tantargyak.nev as 'nev' FROM `tantargykapcsolotabla` inner join tanarok on tantargykapcsolotabla.tanar_id = tanarok.id inner JOIN tantargyak on tantargyak.id = tantargykapcsolotabla.tantargy_id";
$query = mysqli_query($conn, $sql);


$table = "<div class='container'>";

if(mysqli_num_rows($query) > 0){
    $picture = "../projectImg/manFace.png";
    while($row = mysqli_fetch_assoc($query)){
        $table .=  
        "<div class='box'>
            <img src={$picture} alt='tanar kep' title='tanar kep' width=200px height=200px />
            <p>{$row["vezeteknev"]} {$row["keresztnev"]}</p>
            <h3>{$row["nev"]}</h3>
            <a href='informacio.php?id={$row["id"]}'><button type='button'>Információk</button></a>
        </div>";
    }
    $table .= "</div>";
}

// Legjobbra értékelt tanárok lekérdezése

$sqlTop = "SELECT tanarok.vezeteknev AS 'vezeteknev', tanarok.keresztnev AS 'keresztnev', round(avg(ertekelesek.ertekeles), 1) AS 'atlag' FROM `tanarok` inner JOIN ertekelesek on tanarok.id = ertekelesek.tanar_id GROUP BY tanarok.vezeteknev, tanarok.keresztnev ORDER BY atlag DESC limit 6";
$queryTop = mysqli_query($conn, $sqlTop);

$topTable = "<div class='toplistacontainer'>";

if(mysqli_num_rows($queryTop) > 0){
    while($top = mysqli_fetch_assoc($queryTop)){
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

    <?php echo $table  ?>
</body>
</html>