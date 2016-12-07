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
  echo'<div class="nav_menu" class="disable-select">';

  theMenu();
  echo '<div id="opener">
          <div id="rychka" class="disable-select">&#8942;</div>  
        </div></div>';
}
//------------------------
// ceate menu
//------------------------
function theMenu()
{
  echo '<div id="left_menu"> 
         <ul>
          <li><a href="printD.php">Страви</a></li>
          <li><a href="printIng.php">Інгредієнти</a></li>
          <li><a href="feddback.php">Відгук</a></li>
          <li><a href="about.html">Допомога</a></li>
        </ul>
        </div>';
}




//--------------------------
// create menu for mobile
//--------------------------
function createMenuM()
{
  theMenu(); //need to be hidden
  topBar();
}

//--------------------------
// create top menu for mobile
//--------------------------
function topBar()
{
  echo '
  <header class="topBar">
    <h1>
    <span class="titlePage">
    Title here
    </span>
    <i class="mOpener">=</i>
    </h1>
  </header><br>';
}
?>


