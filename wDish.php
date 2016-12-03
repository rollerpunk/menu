<?php
// work on ingredients

//----------------------------------------------------
require "lib.php"; 

//accept only post method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
 exit();
}

// define variables from post
$name = test_input($_POST["dname"]);
$price = test_input($_POST["dprice"]); //set price per dish
$outcome = test_input($_POST["outcome"]); //outcome of a dish
$factor = test_input($_POST["dfactor"]);
$ings= test_input($_POST["ingr"]); 
$emount = test_input($_POST["emount"]); // of ingredient


$btn= test_input($_POST["action"]); 


switch ($btn) {
  case "addD":
    $sql = "INSERT INTO dish (Name, Price, Outcome ,Factor, Ingredients, Emounts)   
           VALUES ('$name','$price','$outcome' ,'$factor' ,'$ings', '$emount')";
    break;

  case "editD":
   /* $newName = test_input($_POST["newName"]);
    $sql="UPDATE ingredients
          SET Price='$price', Pack='$pack',Unit='$unit',Factor='$factor',Name='$newName'
          WHERE Name='$name'"; 
    break;
     */   
    ;

  case "delD":
  ;
  default:
    echo ("wrong order code !!". $btn);
    header( "Location: printD.php" );
}


sendSql($sql);

echo ("done");
header( "Location: printD.php" ); //go to ingredients view TODO: we also may go to menu or dish list



?>
