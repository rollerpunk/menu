<?php
require "dbwork.php"; // move all DB work outside

//===========Commmon Functions=================

//-----------------------------
//-- make received data sefe --
//-----------------------------
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
