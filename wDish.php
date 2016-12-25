<?php
// work on ingredients

//----------------------------------------------------
require "lib.php"; 

//accept only post method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
 exit();
}

// define variables from post


$btn= test_input($_POST["action"]); 

$dish = $_POST["dish"]; //dish json
$jdish = json_decode($dish, true); 

$name = $jdish['Name']; // dish name
$price = $jdish['Price']; //set price per dish  ??? do we need this ?
$outcome = $jdish['Outcome']; //outcome of a dish
$factor = $jdish['Factor'];  // additional factor
$dnotes = $jdish['Notes']; //notes

//arrays need to be transformated for savable view
$ings= serialize($jdish['Ingredients']); // ingredients
$emount = serialize($jdish['Emounts']); // input emount of ingredients
$emountout= serialize($jdish['OutEmounts']);  // outcome emount of ingredients


switch ($btn) {
  case "addD":
    $sql = "INSERT INTO dish (Name, Price, Outcome ,Factor, Ingredients, Emounts, OutEmounts, Notes )   
           VALUES ('$name','$price','$outcome' ,'$factor' ,'$ings', '$emount','$emountout','$dnotes')";
    break;

  case "editD":
    $oldName= test_input($_POST["oldName"]); 

    $sql="UPDATE dish
          SET Price='$price',Outcome='$outcome',Factor='$factor',Name='$name',Ingredients='$ings',Emounts='$emount',OutEmounts='$emountout',Notes='$dnotes'
          WHERE Name='$oldName'"; 
    break;
    
   

  case "delD":
  ;
  default:
    echo ("wrong order code !!". $btn);
}

//echo $sql;
sendSql($sql);
header( "Location: printD.php" ); //go to ingredients view TODO: we also may go to menu or dish list



?>
