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

//-------------------------------------
//  ingredient form
//--------------------------------------
function formIng($name="",$unit="",$pack="",$price="",$bPrice="")
{
echo'
<div class="add_form">
<form method="post" action="wIng.php">
  <fieldset>
  <legend><h2>';
  if ($name=="") echo 'Додати інгредієнт'; else echo 'Змінити інгредієнт';
  echo' </h2></legend>  
  Назва:<br>
      <input type="text" name="name" '.($name=="" ? "placeholder= \"Картопля\" autocomplete=\"off\" required":"hidden").' value="'.$name.'"/>
      <input type="text" name="newName" '.($name!="" ? "placeholder= \"Картопля\" autocomplete=\"off\" required":"hidden").' value="'.$name.'"/> <br>
  <div style="display:inline-block">
   Фасофка:<br>
     <input type= "number" name= "pack" min= "0" step= "0.01" placeholder="1" required autocomplete="off" value="'.$pack.'" />';
	if ($unit=="") echo '<input type="radio" name="unit" id="g" value="г" autocomplete="off"><label for="g">гр</label>';	 
    echo '<input type="radio" name="unit" id= "kg" value="кг" autocomplete="off"';	 
	if ($unit =='кг') echo "checked"; 
	echo '> <label for="kg">кг</label>
	 <input type="radio" name="unit" id= "p" value="шт" autocomplete="off"';
 	if ($unit =='шт') echo "checked";	
	echo '> <label for="p">шт</label>'; 
	
	
	echo '<br>
  </div><br>
  

  <div style="display:inline-block;margin:10px">
    Ціна:<br>
     <input type= "number" name= "price" min= "0" step= "0.05" placeholder="10" required autocomplete="off" size="4" value="'.$price.'"/> грн<br>
  </div> 
   <div style="display:inline-block;margin:10px">
     Ціна бару:<br>
     <input type= "number" name= "bPrice" min= "1.1" step= "0.1" required autocomplete="off" size="4" value="'.$bPrice.'"/>
    </div>';
	if ($unit != "") echo'<br><br><button class="cancel" onclick="location.href=\'printIng.php\';">Видалити</button>';
  echo '</fieldset><br>';
  if ($unit == "") echo '<button name="btn" value="addIng">Додати</button>'; else  echo '<button name="btn" value="editIng">Зміннити</button>';
  
  echo '<button class="cancel" onclick="location.href=\'printIng.php\';">Скасувати</button>';   
  
echo'</form> 
</div>';
	
}

?>


