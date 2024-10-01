<?php 

include_once("./database.php");

$teacherId = $_GET['id'];

$sqlTeacher = "SELECT * FROM tanarok INNER JOIN tantargykapcsolotabla on 
tantargykapcsolotabla.tantargy_id = tanarok.id INNER JOIN tantargyak on tantargykapcsolotabla.tantargy_id = tantargyak.id GROUP BY tanarok.vezeteknev, tanarok.keresztnev, nev HAVING tanarok.id = $teacherId";
$queryTeacher = mysqli_query($conn, $sqlTeacher);

$table = "<div>";
$starBtn = "";
if(mysqli_num_rows($queryTeacher) > 0){
   while($row = mysqli_fetch_assoc($queryTeacher)){
        $table .= "
          <h2>{$row["vezeteknev"]} {$row["keresztnev"]}</h2>
          <p>{$row["nev"]}</p>
        ";
   } 
}
$table .= "</div>";

$btnStarRate = "";



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    foreach ($_POST as $param_name => $param_val) {
        
        $btnStarRate = $param_name;
    }
    
    
    $sqlInsert = "INSERT INTO ertekelesek (`felhasznalo_id`, `tanar_id`, `ertekeles`) VALUES (2 ,$teacherId, $btnStarRate)";
    $queryInsert = mysqli_query($conn, $sqlInsert);


    $sqlAvg = "SELECT round(AVG(ertekeles), 1) as 'atlag' FROM ertekelesek GROUP BY tanar_id HAVING tanar_id = $teacherId";
    $queryAvg = mysqli_query($conn, $sqlAvg);

    if(mysqli_num_rows($queryAvg) > 0){
        while($row = mysqli_fetch_assoc($queryAvg)){
            $sqlUpdate = "UPDATE tanarok
            SET atlag = {$row["atlag"]}
            WHERE id = $teacherId";
        }
        $queryUpdate = mysqli_query($conn, $sqlUpdate);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanár oldal</title>
</head>
<body>
    <form action="" method="post">
        <?php echo $table;  ?>

    <?php 
    

    
    ?>
    <button type="submit" id="1" name="1" > <img src="projectImg/ratingStar.png" alt=""> </button>
    <button type="submit" id="2" name="2"> <img src="projectImg/ratingStar.png" alt=""> </button>
    <button type="submit" id="3" name="3"> <img src="projectImg/ratingStar.png" alt=""> </button>
    <button type="submit" id="4" name="4" > <img src="projectImg/ratingStar.png" alt=""> </button>
    <button type="submit" id="5" name="5"> <img src="projectImg/ratingStar.png" alt=""> </button>
    </form>
</body>
</html>