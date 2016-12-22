<?php
// work on ingredients

//----------------------------------------------------
require "lib.php"; 

//accept only post method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
 exit();
}

// define variables from post
$name = test_input($_POST["dname"]); // dish name
$price = test_input($_POST["dprice"]); //set price per dish  ??? do we need this ?
$outcome = test_input($_POST["outcome"]); //outcome of a dish
$factor = test_input($_POST["dfactor"]);  // additional factor
$dnotes = test_input($_POST["dnotes"]); //notes

//lists
$ings= test_input($_POST["ingr"]); // ingredients
$emount = test_input($_POST["emount"]); // input emount of ingredients
$emountout= test_input($_POST["emountout"]);  // outcome emount of ingredients
$btn= test_input($_POST["action"]); 

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

sendSql($sql);
header( "Location: printD.php" ); //go to ingredients view TODO: we also may go to menu or dish list



?>
