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


function createMenu()
{
 echo'<div class="nav_menu">   
 <ul>
  <li><a href="printD.php">Страви</a></li>
  <li><a href="printIng.php">Інгредієнти</a></li>
  <li><a href="feddback.php">Відгук</a></li>
  <li><a href="about.html">Допомога</a></li>
</ul></div>'; 
}

?>
