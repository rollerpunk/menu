<?php


//--------------------
//connect to DB
//--------------------
function dbConnect($server="localhost",$db="webmenu",$user="webmenu",$pass="menu12345")

{
  // Create connection
  
  for ($i = 1; $i <= 10; $i++)
  {
    $conn = new mysqli($server, $user, $pass,$db);
    if (!$conn->connect_error) 
    {
      // connection to db successful
      return $conn;
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    // NB: don't forget to close a connection with   $conn->close();
    //------------------------------------------------------------------  
    }
   
    sleep(5); // next try in 10 sec
  }
  // no connection after 10 retrys. Just die
  die("[DBWork]Connection failed: " . $conn->connect_error);
}
  
   



//----------------------------
//common function to open/close db and send sql request
//----------------------------
function sendSql($sql)
{

  $conn=dbConnect();

  $conn->query("SET NAMES 'utf8';");
  $conn->query("SET CHARACTER SET 'utf8';");
  $conn->query("SET SESSION collation_connection = 'utf8_general_ci';");

  //logging
/*  if ((strpos($sql,"INSERT") === FALSE ) && (strpos($sql,"UPDATE") === FALSE ))
  {
     echo "str=". $sql;
     exit();
  }
  else
    if (!$conn->query("INSERT INTO logs (Who, What) VALUES (user ,'.$sql.';"))
    {
      echo $conn->error;
      exit();
    }
*/

  $result = $conn->query($sql);
  if (!$result)
  {
    if ($conn->errno != 1146 )
    {
      echo "<div class=\"footer errorDiv\"><br><b>sql</b># ".$conn->errno.":<br>" . $sql . "<br><b>Error:</b><br>" . $conn->error . "<br></div>"; //TODO make normal error handler
      return false;
    }
  }
  $conn->close();
  return  $result;
}


//---------------------------------------
// init database 
//---------------------------------------
function initDB()
{
//TODO: for future use. we need to have separate DB per user. Is it possible to create ?


$str="CREATE TABLE IF NOT EXISTS `ingredients` (
  `Name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Price` float NOT NULL,
  `Pack` float NOT NULL,
  `Unit` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Factor` int(11) NOT NULL,
  PRIMARY KEY (`Name`)
)";
sendSql($str);

$str="CREATE TABLE IF NOT EXISTS `dish` (
  `Name` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `Outcome` int(11) NOT NULL,
  `Factor` int(11) NOT NULL,
  `Ingredients` text NOT NULL,
  `Emounts` text NOT NULL,
  UNIQUE KEY `Name` (`Name`)
)";

sendSql($str);

}


?>
