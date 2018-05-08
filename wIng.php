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
$bPrice = test_input($_POST["bPrice"]);
$pack = test_input($_POST["pack"]);
$unit = test_input($_POST["unit"]);
$price = test_input($_POST["price"]);
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
    $sql = "INSERT INTO ingredients(Name, Price, Pack ,Unit ,BarPrice)   
           VALUES ('$name','$price','$pack' ,'$unit' ,'$bPrice')";
    sendSql($sql);
    break;

  case "editIng":
    $newName = test_input($_POST["newName"]);
    $sql="UPDATE ingredients
          SET Price='$price', Pack='$pack',Unit='$unit',BarPrice='$bPrice',Name='$newName'
          WHERE Name='$name'";
    sendSql($sql);
    
   break;

  case "del":
    exit("Delete is not impleented yet!");  
    break;
  default:
    echo ("wrong order code !!". $btn);
    header( "Location: printIng.php" );
}


echo ("done");
header( "Location: printIng.php" ); //go to ingredients view TODO: we also may go to menu or dish list
/*
//Update affected dishes with new price
function updatePrices($ing)
{
  // get a list of dishes to update
  $sql = "SELECT * FROM dish WHERE Ingredients LIKE '%$ing%' ;";
  $result = sendSql($sql);
  
  while ($row = $result->fetch_assoc())
    {   
      $dish = $ing['Name'];

      // recalculate dish
      $price = calculateDish($dish)

      //update dish
      $sql2="UPDATE dish SET Price='$price'WHERE Name='$dish'"; 
      sendSql($sql2);

    }

}*/



?>
