<?php
// work on ajax requests
//----------------------------------------------------
require "lib.php"; 

//accept only post method
if ($_SERVER["REQUEST_METHOD"] != "POST") {
 exit();
}

// get variables from post

$orderCode = test_input($_POST["ordercode"]);
$table = test_input($_POST["table"]);
$name = test_input($_POST["name"]);

switch ($orderCode) {
  case "getPrice":
    $sql = "SELECT * FROM ".$table." WHERE Name='$name';";
    $result=sendSql($sql);
    $row = $result->fetch_assoc();
    echo json_encode($row,JSON_UNESCAPED_UNICODE );  
    break;

  case "saveDish":
    exit("saveDish is not impleented yet!");          
    break;

  case "del":
    exit("Delete is not impleented yet!");  
    break;
  default:
    echo ("wrong order code !!". $btn);
    sleep(10);
    header( "Location: printIng.php" );
}

?>
