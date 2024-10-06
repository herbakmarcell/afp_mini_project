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
$jo_adatok = 0;
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    session_start();
    if(isset($_SESSION['user_id']))
    {
        $vezeteknev_helyes = check_data("vezeteknev|nem_ures");
        if($vezeteknev_helyes)
        {
            $vezeteknev = tisztit($_POST["vezeteknev"]);
            $jo_adatok++;
        }
        else 
            $hibak[] = "A vezetéknév nem megfelelő!";

        $keresztnev_helyes = check_data("keresztnev|nem_ures");
        if($keresztnev_helyes)
        {
            $keresztnev = tisztit($_POST["keresztnev"]);
            $jo_adatok++;
        }
        else 
            $hibak[] = "A keresztnév nem megfelelő";
        

        $tantargy_helyes = check_data("tantargyak|nem_ures");
        if($tantargy_helyes)
        {
            $tantargy_id = tisztit($_POST["tantargyak"]);
            $jo_adatok++;

        }
        else {
            $hibak[] = "A tárgy nem megfelelő!";
        }

        //Tanár lekérdezése az adatb-ből, hogy szerepel-e már 
        
        if($jo_adatok == 3)
        {
            
            $sql = "select * from tanarok where vezeteknev='$vezeteknev' and keresztnev='$keresztnev'";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) == 0)
            {
                //Tanár felvétele a rendszerbe
                $tanar_sql = "insert into tanarok (vezeteknev, keresztnev) values ('$vezeteknev', '$keresztnev')";
                $tanar_insert = mysqli_query($conn,$tanar_sql);


                //Tanár id meghatározása a kapcsolótlába
                $tanar_id_sql = "select max(id) from tanarok;";
                $tanar_id_query = mysqli_query($conn, $tanar_id_sql);
                if(mysqli_num_rows($tanar_id_query) > 0)
                {
                    $id_row = mysqli_fetch_array($tanar_id_query);
                    $tanar_id = $id_row[0];
                    
                }

                //Tantárgy id meghatározása a kapcsolótáblába
                $tantargy_id_sql = "select id from tantargyak where nev='$tartott_targy';";
                $tantargy_id_query = mysqli_query($conn,$tantargy_id_sql);
                
                if(mysqli_num_rows($tantargy_id_query) > 0)
                {
                    $id_row = mysqli_fetch_array($tantargy_id_query);
                    $tantargy_id = $id_row[0];
                }

                //Adatok felvétele a kapcsolótáblába
                $kapcsolo_sql = "insert into tantargykapcsolotabla (tanar_id,tantargy_id) values ('$tanar_id', '$tantargy_id');";
                $kapcsolo_query = mysqli_query($conn,$kapcsolo_sql);
                header("Location: ./index.php");

            }
            else {
                $hibak[] = "Már van ilyen oktató a rendszerben!";
            }
        }


    }
    else {
        $hibak[] = "Új tanár hozzáadásához először be kell jelentkeznie!";
    }
}
?>
<?php 
    //A tárgyak lekérdezése az adatbázisból
    $adatb_targyak_sql = "select id,nev from tantargyak;";
    $adatb_targyak_query = mysqli_query($conn,$adatb_targyak_sql);
    $adatb_targyak_lekerdezes_sikeres = false;
    if(mysqli_num_rows($adatb_targyak_query)>0)
        $adatb_targyak_lekerdezes_sikeres = true;

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
                <select id="tantargyak" name="tantargyak" required size="6">

                    <?php if($adatb_targyak_lekerdezes_sikeres): ?>
                        <?php while($sor = mysqli_fetch_assoc($adatb_targyak_query)): ?>
                            <option value="<?=$sor['id']?>"><?=$sor['nev']?></option>
                        <?php endwhile; ?>
                    <?php endif; ?>

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