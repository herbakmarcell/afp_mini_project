<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bejelentkezés</title>
</head>
<?php
$hibak = [];

require './functions.php';
require './database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $jo_adatok = 0;
    $email_helyes = check_data("email|nem_ures");
    if ($email_helyes) {
        $email = tisztit($_POST['email']);
        $jo_adatok++;
    } else {
        $hibak[] = "Az email nem megfelelő";
    }

    $jelszo_helyes = check_data("jelszo|nem_ures,jelszo_megfelel");
    if ($jelszo_helyes) {
        $jelszo = tisztit($_POST['jelszo']);
        $jo_adatok++;
    } else {
        $hibak[] = "A jelszó nem megfelelő";
    }

    if ($jo_adatok == 2) //Az emailnek és a jelszónak is jónak kell lennie
    {
        if ($eredmeny = $conn->query("select email, jelszo from felhasznalok where email = '" . $email . "' and jelszo = '" . $jelszo . "';")) {
            if ($eredmeny->num_rows == 1) { //Talált egy felhasználót
                $ertek = $eredmeny->fetch_column();

                echo "A bejelentkezés sikeres";
            } else {
                $hibak[] = "Nem találtunk ilyen felhasználót!";
            }

        }
    }


    $conn->close();
} else {
    http_response_code(405);
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
                <li><a href="login.php" class="active">Bejelentkezés</a></li>
                <li><a href="registration.html">Regisztráció</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <img src="projectImg/login_img.png" alt="login_img" class="bkep">
        <div class="jobb">
            <div class="kozep">
                <h1>Bejelentkezés</h1>
                <form action="" method="POST">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" required>
                    <label for="jelszo">Jelszó:</label>
                    <input type="password" name="jelszo" id="jelszo">
                    <input type="submit" value="Bejelentkezés" id="belepes" name="belepes">
                    <p>Még nincs fiókja? <a href="registration.html">Regisztráljon itt!</a></p>
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