<?php
require "dbwork.php"; // move all DB work outside

//TODO:
// make dish as ingredient



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
          <li><a href="print.php">Друк</a></li>
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
          <li><a href="print.php">Друк</a></li>
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
<form method="post" action="wIng.php" id="ingrForm">
  <fieldset>
  <legend><h2>';
  if ($name=="") 
    echo 'Додати інгредієнт'; 
  else 
    echo 'Змінити інгредієнт';

  echo ' </h2></legend>  
        Назва:<br>
        <input type="text" name="name" id ="ingName" autofocus '.($name=="" ? "placeholder= \"Картопля\" autocomplete=\"off\" required":"hidden").' value="'.$name.'"/>
        <input type="text" name="newName" '.($name!="" ? "placeholder= \"Картопля\" autocomplete=\"off\" required":"hidden").' value="'.$name.'"/> <br>
        <div style="display:inline-block">
        Фасофка:<br>
        <input type= "number"  class="i_triger" name= "pack" min= "0" step= "0.01" value="1" required autocomplete="off" value="'.$pack.'" />';
        
//	if ($unit=="") 
//     echo '<input class="i_triger" type="radio" name="unit" id="g" value="г" autocomplete="off"><label for="g">гр</label>';	 
        
        echo '<input type="radio" class="i_triger" name="unit" id= "kg" value="кг" autocomplete="off"';
	if ($unit =='кг' || $unit=="") echo "checked"; 
	
	echo '> <label for="kg">кг</label> <input type="radio" class="i_triger" name="unit" id= "p" value="шт" autocomplete="off"';
 	if ($unit =='шт') echo "checked"; 
 	
 	echo '> <label for="p">шт</label>'; 
	echo '<br></div><br>  
        <div style="display:inline-block;margin:10px">
        Ціна:<br>
        <input type= "number" class="i_triger" name= "price" min= "0" step= "0.05" placeholder="10" required autocomplete="off" size="4" value="'.$price.'"/> грн<br>
        </div> 
        <div id="ppu" style="display:inline-block;margin:10px"><span>0</span> грн/<span>кг</span></div> 
        <br>
        <div id = "bPrice" style="display:inline-block;margin:10px">
        Ціна бару: <input type= "number" name= "bPrice" min= "1" step= "0.1" required autocomplete="off" size="4" value="'.$bPrice.'"/> грн/<span>кг</span>
        </div>';
	if ($unit != "") echo '<br><br><button class="cancel" onclick="location.href=\'printIng.php\';">Видалити інгредієнт[n/a]</button>';
  echo '</fieldset><br>';
  if ($unit == "") echo '<button name="btn" value="addIng">Додати</button>'; else  echo '<button name="btn" value="editIng">Зміннити</button>';
  echo '<button class="cancel" onclick="location.href=\'printIng.php\';">Скасувати</button>
        </form> 
        </div>';
	
}

//---------------------------------------------
// dish form
//--------------------------------------------
function dishForm($name="")
{
  echo '<div class="add_form">
  <form method="post" action="wDish.php" id="addDish">
  <fieldset>
  <legend><h2>'.( $name == "" ? "Додати":"Змінити").' страву</h2></legend> 
  Назва страви:<br>
  <input type="text" id="nameDs" name="name" placeholder= "Вібивна"  required  autofocus autocomplete="off" value="'.$name.'"/> 
  <br>
  Iнгредієнти:<br>
   <table class="dishComp">  
	<tr><th>Складник</th><th>Вхід</th><th>Вихід</th><th>Ціна</th><th></th></tr>';
	
  if ($name != "" ) // edit dish
  { 
	  getIngs($name);
  }
  else 
  {
    echo '<tr id="lastIng"><td colspan="3"> <button id="addIng" onclick="addIngr()">Додати інгредієнт</button></td></tr>
     <tr>
	    <td colspan="2"> Додаткова накрутка:  <input type= "number" id="factor" min= "0" step= "0.01" autocomplete="off"/></td>
	    <th><input class= "total" type= "number" id= "output" min= "1" step= "0.01" placeholder="150" required autocomplete="off" />г</th> 
	    <th><input type= "number" id="price" size="5"step= "0.01" autocomplete="off" /> грн</th>       
     </tr>
	  <tr><td colspan="5">
    Тип: <br>
    <select size="7" multiple id="dType" name="type" data-placeholder="Тип страви..." class="chosen-select" autocomplete="off"  style="width:100%;">';
    $tags=getTags();
    foreach($tags as $value)
    {
         echo '<option value="'.$value.'">'.$value.'</option>';
    }
      
    echo '</select> 
    <br>
    Нотатки:
    <br><textarea id="notes" name="notes" rows="6" cols="50"></textarea>
    </td></tr>
    </table>';
  }

  if ($unit != "") echo '<br><br><button class="cancel" onclick="location.href=\'printIng.php\';">Видалити страву [n/a]</button>';
  
  echo '
  </fieldset><br>

  <button onclick="addDishJson()" >'.($name == "" ? "Додати":"Змінити").'</button>
  <button class="cancel" onclick="location.href=\'printD.php\';">Скасувати</button> ';
	  
  echo ' <input type="hidden" id="oldName" name="oldName" value="'.$name.'">
         <input type="hidden" id="dish" name="dish">
         <input type="hidden" id="action" name="action" value="'.($name == "" ? "addD":"editD").'">
  </form></div>';	
	
}


//-----------------------------------
// get ingredients for dish
//-----------------------------------
function getIngs($name)
{
	// it's time to get all dish data and put to the form
	$name = test_input($name);
	$sql = "SELECT * FROM dish WHERE Name='$name' ORDER BY Name ASC;";
	$result=sendSql($sql);
	$dish = $result->fetch_assoc();

        //divide ingredieents to array
        $ings = unserialize($dish['Ingredients']);
        $emount = unserialize($dish['Emounts']); // input emount of ingredients
        $outEmount = unserialize($dish['OutEmounts']);  // outcome emount of ingredients

	for($i=0;$i<count($ings);$i++)
	{
	  $sql = "SELECT * FROM ingredients WHERE Name='$ings[$i]';";
	  $result=sendSql($sql);
	  $ing = $result->fetch_assoc();
	// calculate here

	  $ppu= $ing['BarPrice']; //price per unit / g
	  $pr = $emount[$i]*$ppu/($ing['Unit'] == 'кг' ? 1000 : 1);

	  echo '<tr class="ing2Calc"> 
			 <td><div class="ui-widget">
			   <input class = "calcTriger nameIng in_data" type="text" name="nameIng" autocomplete="off" required  value="'.$ings[$i].'"/>
			 </div></td>';// ing name
	  echo ' <td><input class = "calcTriger in_data" type= "number" name= "evalIng" min= "0" step= "1"  required  value="'.$emount[$i].'"/></td>  '; //emount
	  echo ' <td><input class = "calcTriger in_data" type= "number" name= "outIng" min= "0" step= "1" required   value="'.$outEmount[$i].'"/> '.($ing['Unit']=='кг' ? "г" : $ing['Unit']).'</td>'; //out emount unit
	  echo ' <td>'.$pr.' грн</td>'; // price
	  echo ' <td><div class="delBtn">X</div></td>
	      </tr>';
	}	
	 
	 echo '<tr id="lastIng"><td colspan="3"> <button id="addIng" onclick="addIngr()">Додати інгредієнт</button></td></tr>
     <tr>
	  <td colspan="2"> Додаткова накрутка:  <input type= "number" id="factor" min= "0" step= "0.01" autocomplete="off" size="6" value="'.$dish["Factor"].'"/></td>
	  <th><input type= "number" id="output" step= "1" autocomplete="off" required value="'.$dish["Outcome"].'"/> г</th> 
	  <th><input type= "number" id="price" size="5"step= "0.01" autocomplete="off" value="'.$dish["Price"].'"/> грн</th>      
     </tr>
	 <tr><td colspan="5">
    Тип: <br>
    <select size="5" multiple id="dType" name="type" data-placeholder="Тип страви..." class="chosen-select" autocomplete="off"  style="width:100%;">';
    $tags=getTags();    
    foreach($tags as $value)
    {
        echo '<option value="'.$value.'" '.( strpos($dish['Type'],$value) === FALSE ? "" : "selected" ).'>'.$value.'</option>';
    }

    echo '</select> 
    <br> 
    Нотатки:<br><textarea form="myform" id="notes" name="notes" rows="6" cols="50">'.$dish["Notes"].'</textarea>
   </td></tr>
	 </table>';
    echo '<br><br><button class="cancel" onclick="location.href=\'printIng.php\';">Видалити страву</button>';
}




//-------------------------------
// get dish json from DB
//-------------------------------
function getJsonDish($name)
{

    $sql = "SELECT * FROM dish WHERE Name='$name' ;";
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

    return json_encode($dish,JSON_UNESCAPED_UNICODE );  //create  json for dish
}


// $dish -- sql dish object
function calculateDish($dish)
{

  $ings = unserialize($dish['Ingredients']);
  $emount = unserialize($dish['Emounts']); // input emount of ingredients

  $nofings = count($ings);

  $jing=[];
  $tprice=0;
  for ($i=0 ; $i < $nofings; $i++) // get/set data for each ingridient
  {
    $sql = "SELECT * FROM ingredients WHERE Name='".$ings[$i]."';";
    $result = sendSql($sql);
    $row = $result->fetch_assoc();
    $row['Emount'] = $emount[$i];

    $tprice += $row['Emount'] * $row['BarPrice'] / ($row['Unit'] == 'кг' ? 1000 : 1); // price per ing

  }
  $tprice += $dish['Factor']*1;
  return $tprice;

}

//-----------------------------------
// get array of tags
//-----------------------------------
function getTags()
{
    // get all tags data and put to the form
    $sql = "SELECT * FROM tags ORDER BY Name ASC;";
    $result=sendSql($sql);
    $tags=[];
    while ($row = $result->fetch_assoc())
    {
        $tags[] = $row['Name'];
    }
    
    return $tags;
}


?>


