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
$name = test_input($_POST["name"]);

switch ($orderCode) {
  case "getPrice":
    $table = test_input($_POST["table"]);
    $sql = "SELECT * FROM ".$table." WHERE Name='$name';";
    $result=sendSql($sql);
    $row = $result->fetch_assoc();
    echo json_encode($row,JSON_UNESCAPED_UNICODE );  
    break;


  case "getDish":
    $sql = "SELECT * FROM dish WHERE Name='$name';";
    $result=sendSql($sql);
    $row = $result->fetch_assoc();
    echo json_encode($row,JSON_UNESCAPED_UNICODE );  
    break;
  default:
    echo ("wrong order code !!". $orderCode);
}

?>
