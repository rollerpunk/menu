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
    echo getJsonDish($name);
    break;

  case "getPriceList":
    $ings=explode("^", $name);
    $sql= "SELECT * FROM ingredients WHERE Name='".$ings[0]."'";
    for($i=1;($i+1)<count($ings);$i++) // 1 extra element .do not count
      $sql= $sql." OR Name='".$ings[$i]."'";
    $sql=$sql.";";

    $result=sendSql($sql);
    $i=0;
    echo "{";
    while ($row = $result->fetch_assoc()) // TODO : many objects?
    {
      echo "\"".$i++."\": ".json_encode($row,JSON_UNESCAPED_UNICODE ).",";  
    }
    echo "\"length\":".$i;
    echo "}";
    break;
  default:
    echo ("wrong order code !!". $orderCode);
}

?>
