<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("database.php");
session_start();
$ki_vagy_bejelentkezes;
if (isset($_SESSION["user_id"])) {
    $ki_vagy_bejelentkezes = '<li><a href="./logout.php"><span>Kijelentkezés</span></a></li>';
} else {
    $ki_vagy_bejelentkezes = '  <li>
                    <a href="login.php"><span id="loginIkon"
                            class="material-symbols-outlined">login</span>Bejelentkezés</a>
                </li>
                <li>
                    <a href="registration.php"><span id="regIkon"
                            class="material-symbols-outlined">arrow_upward</span>Regisztráció</a>
                </li>';
}
$table = "<div class='tanarContainer'>";



$tantargy = "";
$sqlSubject = "SELECT * FROM tantargyak";
$querySubject = mysqli_query($conn, $sqlSubject);

while ($row = mysqli_fetch_assoc($querySubject)) {
    $tantargy .= "<option values={$row["id"]}>{$row["nev"]}</option>";
}

$tantargy .= "
    </select>";



// A felhasználó által keresett kritériumok lekérdezése
if (isset($_POST['kereses'])) {
    $tantargyak = $_POST['tantargy'] !== "--- Válassz ---" ? $_POST['tantargy'] : "";
    $ertekelesek = $_POST['ertekeles'] ? $_POST['ertekeles'] : 0;
    $tanarok = $_POST['tanar'] ? $_POST['tanar'] : "";

    $sqlFind = "SELECT tanarok.id AS 'id', tanarok.vezeteknev, tanarok.keresztnev, tantargyak.nev AS 'nev', tanarok.atlag AS 'ertekeles' FROM tantargyak INNER JOIN tantargykapcsolotabla ON tantargyak.id = tantargykapcsolotabla.tantargy_id INNER JOIN tanarok ON tanarok.id = tantargykapcsolotabla.tanar_id GROUP BY id, tanarok.vezeteknev, tanarok.keresztnev, nev, ertekeles having ertekeles >= $ertekelesek and nev like '%$tantargyak%' and concat(tanarok.vezeteknev, ' ', tanarok.keresztnev) like '%$tanarok%'";

    $queryFind = mysqli_query($conn, $sqlFind);

    if (mysqli_num_rows($queryFind) > 0) {
        $picture = "./projectImg/manFace.png";
        while ($row = mysqli_fetch_assoc($queryFind)) {

            $ertekelesStyle = $row["ertekeles"] > 0 ? "" : "red";
            $ertekelesStyle = $row["ertekeles"] > 0 ? "projectImg/ratingStar.png" : "projectImg/red_star.png";
            $table .=
                "<div class='box'>
                    <div class=\"tanarPictureDiv\">
                        <img src={$picture} alt='tanar kep' title='tanar kep' class=\"tanarPicture\" />
                    </div>
                    <div class=\"tanarInfoDiv\">
                        <h3>{$row["vezeteknev"]} {$row["keresztnev"]}</h3>
                        <h4>{$row["nev"]}</h4>
                        <div class=\"ratingDiv\" >
            <img src=$ertekelesStyle alt=\"ratingStar_img\" class=\"topRatingImg\" ><p style=\"color= $ertekelesStyle\" >{$row["ertekeles"]}</p></div>
                    </div>
                    <div class=\"tanarInfoButton\">
                        <button type='button'><a href='informacio.php?id={$row["id"]}'>Információk</a></button>
                    </div>
        </div>";
        }
        $table .= "</div>";

        $tantargyak = "";
        $ertekelesek = 0;
        $tanarok = "";
    } else {
        $table .= "Nincs ilyen tanár.";
        $tantargyak = "";
        $ertekelesek = 0;
        $tanarok = "";
    }
} else {
    // Összes tanár lekérdezése
    //Ha nem kattintott rá a keresés gombra.

    $sql = "SELECT tanarok.id AS 'id', tanarok.vezeteknev, tanarok.keresztnev, tantargyak.nev AS 'nev', tanarok.atlag AS 'ertekeles' FROM tantargyak INNER JOIN tantargykapcsolotabla ON tantargyak.id = tantargykapcsolotabla.tantargy_id INNER JOIN tanarok ON tanarok.id = tantargykapcsolotabla.tanar_id GROUP BY id, tanarok.vezeteknev, tanarok.keresztnev, nev, ertekeles";
    $query = mysqli_query($conn, $sql);


    if (mysqli_num_rows($query) > 0) {
        $picture = "./projectImg/manFace.png";
        while ($row = mysqli_fetch_assoc($query)) {

            $ertekelesStyle = $row["ertekeles"] > 0 ? "" : "red";
            $ertekelesStyle = $row["ertekeles"] > 0 ? "projectImg/ratingStar.png" : "projectImg/red_star.png";
            $table .=
                "<div class='box'>
                    <div class=\"tanarPictureDiv\">
                        <img src={$picture} alt='tanar kep' title='tanar kep' class=\"tanarPicture\" />
                    </div>
                    <div class=\"tanarInfoDiv\">
                        <h3>{$row["vezeteknev"]} {$row["keresztnev"]}</h3>
                        <h4>{$row["nev"]}</h4>
                        <div class=\"ratingDiv\" >
            <img src=$ertekelesStyle alt=\"ratingStar_img\" class=\"topRatingImg\" ><p style=\"color= $ertekelesStyle\" >{$row["ertekeles"]}</p></div>
                    </div>
                    <div class=\"tanarInfoButton\">
                        <button type='button'><a href='informacio.php?id={$row["id"]}'>Információk</a></button>
                    </div>
        </div>";
        }
        $table .= "</div>";
    }
}

// Legjobbra értékelt tanárok lekérdezése

$sqlTop = "SELECT tanarok.vezeteknev AS 'vezeteknev', tanarok.keresztnev AS 'keresztnev', atlag FROM `tanarok` GROUP BY tanarok.vezeteknev, tanarok.keresztnev, atlag having atlag > 0 ORDER BY atlag DESC limit 6;";
$queryTop = mysqli_query($conn, $sqlTop);

$topTable = "<div class='toplistacontainer'>";

if (mysqli_num_rows($queryTop) > 0) {
    while ($top = mysqli_fetch_assoc($queryTop)) {
        $topTable .=
            "<div class='topBox'>
            <p>{$top["vezeteknev"]} {$top["keresztnev"]}</p> <div class=\"ratingDiv\">
            <img src=\"projectImg/ratingStar.png\" alt=\"ratingStar_img\" class=\"topRatingImg\"><p>{$top["atlag"]}</p></div>
        </div>";
    }
}
$topTable .= "</div>";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
    <link rel="icon" type="image/x-icon" href="projectImg/home-favicon.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fooldal.css">
</head>

<body class="fooldalBody">
    <nav>
        <p class="title"><a href="index.php">Tanár értékelő</a></p>
        <a href="#" class="hmenu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="linkek">
            <ul>
                <li>
                    <a href="index.php" class="active"><span id="hazIkon"
                            class="material-symbols-outlined">home</span>Főoldal</a>
                </li>

                <?php echo $ki_vagy_bejelentkezes ?>

            </ul>
        </div>
    </nav>
    <header class="headerImg">
        <img src="projectImg/login_img.png" alt="login_img" class="bkep">
        <figcaption>Tanárértékelő</figcaption>
    </header>
    <h1>Legjobbra értékelt tanárok</h1>
    <?php echo $topTable ?>

    <div class="keresesDiv">
        <form action="" method="post">
            <label for="tantargy">Tantárgy:
                <select name='tantargy'>
                    <option>--- Válassz ---</option>
                    <?php echo $tantargy; ?>
                </select></label>
            <div class="keresoMezoDiv"><label for="ertekeles">Értékelés:
                    <input type="number" name="ertekeles" id="ertekeles">
                </label>
                <label for="tanar">Tanár
                    <input type="text" name="tanar" id="tanar">
                </label>
            </div>
            <div class="buttonsDiv">
                <button type="submit" name="kereses" id="kereses">Keresés</button>
                <button type="submit" name="reset" id="reset">Reset</button>
            </div>
        </form>
    </div>
    <main>
        <?php echo $table ?>
    </main>
    <div class="studentImgDiv"></div>
    <footer>
        <ul>
            <li><a href="login.php">Bejelentkezés</a></li>
            <li><a href="registration.html">Regisztráció</a></li>
            <li><a href="#">Főoldal</a></li>
        </ul>
        <div class="socialOldalak">
            <h2>Kövess minket:</h2>
            <ul>
                <li><a href="#" class="fa fa-facebook"></a><a href="">Facebook</a></li>
                <li><a href="#" class="fa fa-linkedin"></a><a href="">Linkedin</a></li>
                <li><a href="https://github.com/herbakmarcell/afp_mini_project.git" target="_blank"
                        class="fa fa-github"></a><a href="https://github.com/herbakmarcell/afp_mini_project.git"
                        target="_blank">Github</a></li>
            </ul>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>