<?php

include_once("./database.php");
session_start();
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

$teacherId = $_GET['id'];

$sqlTeacher = "SELECT * FROM tanarok INNER JOIN tantargykapcsolotabla on tantargykapcsolotabla.tanar_id = tanarok.id INNER JOIN tantargyak on tantargykapcsolotabla.tantargy_id = tantargyak.id GROUP BY tanarok.vezeteknev, tanarok.keresztnev, nev HAVING tanarok.id = $teacherId";
$queryTeacher = mysqli_query($conn, $sqlTeacher);

$table = "<div class='tanarInfoData'>";
$starBtn = "";
if (mysqli_num_rows($queryTeacher) > 0) {
    while ($row = mysqli_fetch_assoc($queryTeacher)) {
        $table .= "
          <h3 >Név: {$row["vezeteknev"]} {$row["keresztnev"]}</h3>
          <p>Tantárgy: {$row["nev"]}</p>
          <p>Átlag értékelés: <span style='color: yellow'>{$row["atlag"]}<span></p>
        ";
    }
}
$table .= "</div>";

$btnStarRate = "";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $param_name => $param_val) {

        $btnStarRate = $param_name;
    }

    $sql = "select * from ertekelesek where felhasznalo_id ='" . $userId . "' and tanar_id = '" . $teacherId . "';";
    $queryErtekeles = mysqli_query($conn, $sql);
    if (mysqli_num_rows($queryErtekeles) > 0) {
        $sqlInsert = "update ertekelesek set ertekeles = '" . $btnStarRate . "' where felhasznalo_id ='" . $userId . "' and tanar_id = '" . $teacherId . "';";
    } else {
        $sqlInsert = "INSERT INTO ertekelesek (`felhasznalo_id`, `tanar_id`, `ertekeles`) VALUES ($userId ,$teacherId, $btnStarRate)";
    }


    $queryInsert = mysqli_query($conn, $sqlInsert);


    $sqlAvg = "SELECT round(AVG(ertekeles), 1) as 'atlag' FROM ertekelesek GROUP BY tanar_id HAVING tanar_id = $teacherId";
    $queryAvg = mysqli_query($conn, $sqlAvg);

    if (mysqli_num_rows($queryAvg) > 0) {
        while ($row = mysqli_fetch_assoc($queryAvg)) {
            $sqlUpdate = "UPDATE tanarok
            SET atlag = {$row["atlag"]}
            WHERE id = $teacherId";
        }
        $queryUpdate = mysqli_query($conn, $sqlUpdate);
    }
    // oldal frissítése
    header("Refresh:0");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="projectImg/info-favicon.png">
    <title>Tanár oldal</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fooldal.css">
    <link rel="stylesheet" href="informacio.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
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
                    <a href="index.php"><span class="material-symbols-outlined">
                            arrow_back
                        </span>Vissza</a>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="tanarInfoDiv">
            <div class="tanarPictureDiv\">
                <img src=./projectImg/manFace.png alt='tanar kep' title='tanar kep' class="tanarPicture" />
            </div>
            <div class="tanarInfoForm">
                <?php echo $table; ?>
                <form action="" method="post">
                    <?php 
                    
                    if(isset($_SESSION['user_id'])){
                    ?>
                        <button type="submit" id="1" name="1" > <img src="projectImg/ratingStar.png" alt=""> </button>
                        <button type="submit" id="2" name="2"> <img src="projectImg/ratingStar.png" alt=""> </button>
                        <button type="submit" id="3" name="3" > <img src="projectImg/ratingStar.png" alt=""> </button>
                        <button type="submit" id="4" name="4" > <img src="projectImg/ratingStar.png" alt=""> </button>
                        <button type="submit" id="5" name="5" > <img src="projectImg/ratingStar.png" alt=""> </button>
                    <?php 
                    
                    }else{
                        echo "<div class='tanarInfoData'><h3>Az értékeléshez jelentkezzen be.<h3></div>";
                    }
                    
                    
                    ?>
                </form>
            </div>
        </div>
        <div class="tanarErtekeloDiv">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi itaque harum quidem non illo, doloremque
            amet doloribus qui cupiditate nobis esse maxime labore eius fugiat sequi veniam quo corporis. Tenetur.
            Culpa quia cum quis, perferendis molestiae placeat repellat nobis. Cupiditate, eveniet vero! Magnam nesciunt
            aspernatur reprehenderit nostrum praesentium laboriosam dolorum, molestias, officiis magni facere ullam
            veniam! Eaque minus maiores hic?
            Dolorem omnis asperiores, hic nihil quibusdam quasi natus molestiae veniam saepe illo animi aliquid ratione
            ea tempore pariatur vitae blanditiis reprehenderit ad architecto fuga. Praesentium dicta eveniet pariatur
            consequuntur a.
        </div>
    </main>
    <footer>
        <ul>
            <li><a href="login.php">Bejelentkezés</a></li>
            <li><a href="registration.php">Regisztráció</a></li>
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
</body>

</html>