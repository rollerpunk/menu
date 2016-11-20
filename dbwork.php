<?php


//--------------------
//connect to DB
//--------------------
function dbConnect($server="localhost",$db="menu-web",$user="menu",$pass="menu")

{
  // Create connection
  $conn = new mysqli($server, $user, $pass,$db);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn; 
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
}// NB: don't forget to close a connection with   $conn->close();
//------------------------------------------------------------------


//----------------------------
//common function to open/close db and send sql request
//----------------------------
function sendSql($sql)
{
  $conn=dbConnect();
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

}


?>
