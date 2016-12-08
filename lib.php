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

//----------------------------
// create vertical menu for monitors with opener sidebar
//----------------------------
function createMenu()
{
//pc version
  echo'<div class="nav_menu" class="disable-select">
       <div class="left_menu"> 
         <ul>
          <li><a href="printD.php">Страви</a></li>
          <li><a href="printIng.php">Інгредієнти</a></li>
          <li><a href="feddback.php">Відгук</a></li>
          <li><a href="about.html">Допомога</a></li>
        </ul>
        </div>
        <div id="opener">
          <div id="rychka" class="disable-select">&#8942;</div>  
        </div></div>';

//mobile version
  echo '<div id="mMenu" class="left_menu disable-select"> 
         <ul>
          <li><a href="printD.php">Страви</a></li>
          <li><a href="printIng.php">Інгредієнти</a></li>
          <li><a href="feddback.php">Відгук</a></li>
          <li><a href="about.html">Допомога</a></li>
        </ul>
        </div>
        <header class="topBar">
          <h1>
            <span class="titlePage">
            Title here
            </span>
            <i class="mOpener disable-select" >=</i>
          </h1>
      </header><br>';
}


?>


