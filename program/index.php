<?php 

include_once("database.php");

$sql = "SELECT tanarok.vezeteknev, tanarok.keresztnev, tanarok.id, tantargyak.nev FROM `tantargykapcsolotabla` inner join tanarok on tantargykapcsolotabla.tanar_id = tanarok.id inner JOIN tantargyak on tantargyak.id = tantargykapcsolotabla.tantargy_id";
$query = mysqli_query($conn, $sql);


$table = "<div class='container'>";

if(mysqli_num_rows($query) > 0){
    $picture = "../projectImg/manFace.png";
    while($row = mysqli_fetch_assoc($query)){
        $table .=  
        "<div class='box'>
            <img src={$picture} alt='tanar kep' title='tanar kep' width=200px height=200px />
            <h3>{$row["nev"]}</h3>
            <p>{$row["vezeteknev"]} {$row["keresztnev"]}</p>
            <a href='informacio.php?id={$row["id"]}'><button type='button'>Információk</button></a>
        </div>";
    }
    $table .= "</div>";
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
    <?php echo $table  ?>
</body>
</html>