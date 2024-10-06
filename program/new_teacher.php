<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="projectImg/addt_favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="new_teacher.css">
    <title>Új Tanár Felvétele</title>
</head>

<?php
require_once './database.php';
require_once './functions.php';
$hibak = [];

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    session_start();
    if(isset($_SESSION['user_id']))
    {
        $vezeteknev_helyes = check_data("vezeteknev|nem_ures");
        if($vezeteknev_helyes)
        {
            $vezeteknev = tisztit($_POST["vezeteknev"]);
        }
        else 
            $hibak[] = "A vezetéknév nem megfelelő!";

        $keresztnev_helyes = check_data("keresztnev|nem_ures");
        if($keresztnev_helyes)
        {
            $keresztnev = tisztit($_POST["keresztnev"]);
        }
        else 
            $hibak[] = "A keresztnév nem megfelelő";
        

        $tantargyak = ['példa1','példa2','példa3','példa4','példa5','példa6', 'példa7', 'példa8'];
        $tantargy_helyes = check_data("tantargyak|nem_ures");
        if($tantargy_helyes)
        {
            $tantargy_index = tisztit($_POST["tantargyak"]);
            $tartott_targy = $tantargyak[$tantargy_index];
        }




    }
    else {
        $hibak[] = "Új tanár hozzáadásához először be kell jelentkeznie!";
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
                    <a href="index.php"><span class="material-symbols-outlined">arrow_back</span>Vissza</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="keret">
            <h1>Új Tanár Felvétele</h1>
            <form method="POST" action="">
                <label for="vezeteknev">Vezetéknév:</label>
                <input type="text" id="vezeteknev" name="vezeteknev" required>

                <label for="keresztnev">Keresztnév:</label>
                <input type="text" id="keresztnev" name="keresztnev" required>
                
                <label for="tantargyak">Tantárgyak:</label>
                <select id="tantargyak" name="tantargyak" required multiple size="6">
                    <option value="0">pelda1</option>
                    <option value="1">pelda2</option>
                    <option value="2">pelda3</option>
                    <option value="3">pelda4</option>
                    <option value="4">pelda5</option>
                    <option value="5">pelda6</option>
                    <option value="6">pelda7</option>
                    <option value="7">pelda8</option>
                </select>

                <input type="submit" value="Hozzáadás" id="hozzaadas" name="hozzaadas">
            </form>
            <?php foreach($hibak as $hiba): ?>
                <p><?=$hiba?></p>
            <?php endforeach; ?>
        </div>
    </div>
    
</body>
</html>