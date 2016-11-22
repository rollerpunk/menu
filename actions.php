<?php

require "lib.php"; // move all DB work outside

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
$btn= test_input($_POST["btn"]); 

if ($unit == "г")
{
  //we have grams, align packing to kg
  // pack may be in pieces or kg. We assume that 1kg = 1l of liquid
  $pack=$pack/1000;
  $unit="кг"; 
}

switch ($btn) {
  case "add":
    $sql = "INSERT INTO ingredients(Name, Price, Pack ,Unit ,Factor)   
           VALUES ('$name','$price','$pack' ,'$unit' ,'$factor')";
    break;

  case "edit":
    $sql="UPDATE ingredients
          SET Price='$price', Pack='$pack',Unit='$unit',Factor='$factor'
          WHERE Name='$name'"; 
    break;

  case "del":
    exit("Delete is not impleented yet!");  
    break;
  default:
    header( "Location: printIng.php" );
}


sendSql($sql);
header( "Location: printIng.php" ); //go to ingredients view TODO: we als may go to menu or dish list





?>
