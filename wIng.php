<?php
// work on ingredients

//----------------------------------------------------
require "lib.php"; 

//accept only post method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
 exit();
}

// define variables from post
$name = test_input($_POST["name"]);
$factor = test_input($_POST["factor"]);
$pack = test_input($_POST["pack"]);
$unit = test_input($_POST["unit"]);
$price = test_input($_POST["price"]); //align price to monets ++
$btn= test_input($_POST["btn"]); 

if ($unit == "г")
{
  // align packing to kg for better calculation
  // pack may be in pieces or kg. We assume that 1kg = 1l of liquid
  $pack=$pack/1000;
  $unit="кг"; 
  $price = $price;
}

switch ($btn) {
  case "addIng":
    $sql = "INSERT INTO ingredients(Name, Price, Pack ,Unit ,Factor)   
           VALUES ('$name','$price','$pack' ,'$unit' ,'$factor')";
    break;

  case "editIng":
    $newName = test_input($_POST["newName"]);
    $sql="UPDATE ingredients
          SET Price='$price', Pack='$pack',Unit='$unit',Factor='$factor',Name='$newName'
          WHERE Name='$name'"; 
        
    break;

  case "del":
    exit("Delete is not impleented yet!");  
    break;
  default:
    echo ("wrong order code !!". $btn);
    header( "Location: printIng.php" );
}


sendSql($sql);

echo ("done");
header( "Location: printIng.php" ); //go to ingredients view TODO: we als may go to menu or dish list



?>
