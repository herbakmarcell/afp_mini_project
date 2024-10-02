<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="projectImg/reg-favicon.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Regisztráció</title>
</head>
<?php
$hibak = [];
require_once './database.php';
require_once './functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jo_adatok = 0;
    $felhasznalonev_helyes = check_data("fnev|nem_ures");
    if ($felhasznalonev_helyes) {
        $felhasznalonev = tisztit($_POST['fnev']);
        $jo_adatok++;
    } else
        $hibak[] = 'A felhasználónév nem megfelelő!';


    $email_helyes = check_data('email|nem_ures');
    if ($email_helyes) {
        $email = tisztit($_POST['email']);
        $jo_adatok++;
    } else
        $hibak[] = 'Az email cím nem megfelelő!';

    $jelszo_helyes = check_data('jelszo|nem_ures,jelszo_megfelel');
    if ($jelszo_helyes) {
        $jelszo = tisztit($_POST['jelszo']);
        $jelszo = md5($jelszo);
        $jo_adatok++;
    } else
        $hibak[] = 'A jelszó nem megfelelő!';

    $jelszo_ujra_helyes = check_data('jelszoujra|nem_ures,jelszo_megfelel');
    if ($jelszo_ujra_helyes) {
        $jelszo_ujra = tisztit($_POST['jelszoujra']);
        $jelszo_ujra = md5($jelszo_ujra);
        if ($jelszo_ujra != $jelszo)
            $hibak[] = 'A jelszavak nem egyeznek!';
        else
            $jo_adatok++;
    } else
        $hibak[] = 'A "jelszó megerősítése" nem megfelelő!';


    if ($jo_adatok == 4) {


        $lekerdezes = "select * from felhasznalok where email = '" . $email . "';";
        if ($eredmeny = $conn->query($lekerdezes)) {
            if ($eredmeny->num_rows > 0) {
                $hibak[] = 'Már szerepel felhasználó a megadott email címmel!';
            } else {
                $lekerdezes = "insert into felhasznalok (nev,email,jelszo) values ('" . $felhasznalonev . "','" . $email . "','" . $jelszo . "');";
                if ($eredmeny = $conn->query($lekerdezes)) {
                    header("Location: http://localhost/afp_mini_project/program/login.php");
                }
            }
        }
    }



}




?>


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
                    <a href="index.php"><span id="hazIkon" class="material-symbols-outlined">home</span>Főoldal</a>
                </li>
                <li>
                    <a href="login.php"><span id="loginIkon"
                            class="material-symbols-outlined">login</span>Bejelentkezés</a>
                </li>
                <li>
                    <a href="registration.php" class="active"><span id="regIkon"
                            class="material-symbols-outlined">arrow_upward</span>Regisztráció</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <img src="projectImg/login_img.png" alt="login_img" class="bkep">
        <div class="jobb">
            <div class="kozep">
                <h1>Regisztráció</h1>
                <form action="" method="POST">
                    <label for="fnev">Felhasználónév:</label>
                    <input type="text" name="fnev" id="fnev" required>
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" required>
                    <label for="jelszo">Jelszó:</label>
                    <input type="password" name="jelszo" id="jelszo" required>
                    <label for="jelszoujra">Jelszó megerősítése:</label>
                    <input type="password" name="jelszoujra" id="jelszoujra" required>
                    <input type="submit" value="Regisztráció" id="belepes" name="belepes">
                    <p>Már van fiókja? <a href="login.php">Jelentkezzen be!</a></p>
                </form>
                <?php foreach ($hibak as $hiba): ?>
                    <p class="hibauzenet"><?= $hiba ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>