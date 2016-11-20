<!DOCTYPE html>
<head> 
  <title>Додати інгредієнт</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">
  <link rel="stylesheet" href="menu.css">
</head>

<body>
<div class="add_form">
<form method="post">
  <fieldset>
  <legend><h2>Інгредієнт</h2></legend>  
  Назва:<br>
   <input type="text" name="name" placeholder= "Картопля" autocomplete="off" required size="40"> <br>
  <div style="display:inline-block;margin:10px">
    Ціна:<br>
     <input type= "number" name= "price" min= "0" step= "0.05" placeholder="10" required autocomplete="off" size="4"/> грн<br>
  </div> 
  <div style="display:inline-block">
   Фасофка:<br>
     <input type= "number" name= "pack" min= "0" step= "0.1" placeholder="1" required autocomplete="off" size="4"/>
     <input type="radio" name="unit" value="кг" checked autocomplete="off"> кг
     <input type="radio" name="unit" value="г" autocomplete="off"> гр <br>
  </div><br>
  Накрутка:<br>
   <input type= "number" name= "factor" min= "1.1" step= "0.1" value= "2" required autocomplete="off" size="4"/>
  </fieldset><br>
  <button>Додати</button>
  <button class="cancel" onclick="location.href='printIng.php';">Відмінити</button> 
</form> 
</div>

</body>

<?php

require "dbwork.php"; // move all DB work outside

//accept only post method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
 exit();
}

// define variables from post
$name = test_input($_POST["name"]);
$factor = test_input($_POST["factor"]);
$pack = test_input($_POST["pack"]);
$unit = test_input($_POST["unit"]);
$price = test_input($_POST["price"]); 
$table= "ingredients";

if ($unit == "г")
{
  //we have grams, align packing to kg
  // pack may be in pieces or kg. We assume that 1kg = 1l of liquid
  $pack=$pack/1000;
  $unit="кг"; 
}

$sql = "INSERT INTO ". $table ."(Name, Price, Pack ,Unit ,Factor)
  VALUES ('$name','$price','$pack' ,'$unit' ,'$factor')";


sendSql($sql);
header( "Location: printIng.php" ); //go to ingredients view

?>

</html>
