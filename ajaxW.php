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
    $dish = $result->fetch_assoc();
   
    $ings = unserialize($dish['Ingredients']);
    $emount = unserialize($dish['Emounts']); // input emount of ingredients
    $emountout= unserialize($dish['OutEmounts']);  // outcome emount of ingredients

    // remove because those fields will be represented in other place below
    unset($dish['Ingredients']);
    unset($dish['Emounts']);
    unset($dish['OutEmounts']);

    $nofings = count($ings);

    $jing=[];
    $tprice=0;
    for ($i=0 ; $i < $nofings; $i++) // get/set data for each ingridient
    {
      $sql = "SELECT * FROM ingredients WHERE Name='".$ings[$i]."';";
      $result = sendSql($sql);
      $row = $result->fetch_assoc();
      $row['Emount'] = $emount[$i];
      $row['OutEmount'] = $emountout[$i];      
      $tprice += $row['Emount'] * $row['BarPrice'] / ($row['Unit'] == 'кг' ? 1000 : 1); // price per ing

      $jing[] = $row; //put to array of ings
    }
    $tprice += $dish['Factor']*1;
    $dish['tPrice'] =  $tprice;
    $dish['Ings'] = $jing;
    $dish['nOfIngs']=$nofings;
//TODO:  we may count pricee here



    echo json_encode($dish,JSON_UNESCAPED_UNICODE );  //create  json for dish
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
