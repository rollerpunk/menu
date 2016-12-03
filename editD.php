<!DOCTYPE html>
<head> 
  <title>Додати страву</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">
  <link rel="stylesheet" href="menu.css">
  <link rel="stylesheet" href="jquery-ui.css">
  <script src="jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>
  <script type="text/javascript" src="ajaxW.js"></script>
  <script type="text/javascript" src="wDish.js"></script>

<script type="text/javascript">

$(function(){ // we have dynamic page. wait until it loads
  var dish=getDishObj();
  list=""; 
  for (i=0;i< dish.length;i++)
  { 
    list+=dish[i][0]+"^";
  }
  if (list != "") // extra check it should be something anyway
  {
    updatePrice(list); 
  }
  oldPrice = $('#price').val();

});
</script>
</head>


<body>
<div class="add_form">
  <form>
  <fieldset>
  <legend><h2>Змінити страву</h2></legend>  
  Назва страви:<br>
  <input type="text" id="nameDs" placeholder= "Вібивна" autocomplete="off" required size="50" value="<?php echo @ $_POST['name']; ?>"/> <br>
   Iнгредієнти:<br>
   <table class="dishComp">  
     <tr>
       <th colspan="2">Складник</th><th colspan="2">Кількість</th><th>Ціна</th>
     </tr>


<?php

require "lib.php"; 

// it's time to get all dish data and put to the form
$name = test_input($_POST["name"]);

$sql = "SELECT * FROM dish WHERE Name='$name';";
$result=sendSql($sql);
$dish = $result->fetch_assoc();

//divide ingredieents to array
$ings= explode("^", $dish['Ingredients']);
$emount= explode("^", $dish['Emounts']);

for($i=0;($i+1)<count($ings);$i++)
{
  $sql = "SELECT * FROM ingredients WHERE Name='$ings[$i]';";
  $result=sendSql($sql);
  $ing = $result->fetch_assoc();
// calculate here

  $ppu= $ing['Price']/$ing['Pack']*$ing['Factor']; //price per unit / g
  $pr = $emount[$i]*$ppu/($ing['Unit']=='кг' ? 1000 : 1);

  echo '<tr class="ing2Calc"> 
         <td><div class="ui-widget">
           <input class = "calcTriger nameIng" type="text" name="nameIng" placeholder= "Свинина" autocomplete="off" required size="30" value="'.$ings[$i].'"/></div></td>';// ing name
  echo '  <td>'.$ppu.' грн/'. $ing['Unit'] .'</td>'; //price per unit
  echo ' <td><input class = "calcTriger" type= "number" name= "evalIng" min= "0" step= "1" placeholder="300" required autocomplete="off" size="4"value="'.$emount[$i].'"/></td>  '; //emount
  echo ' <td>'.($ing['Unit']=='кг' ? "г" : $ing['Unit']).'</td>'; //unit
  echo ' <td>'.$pr.' грн</td>'; // price
  echo ' <td><div class="delBtn">X</div></td>
       </tr>';
}

echo '<tr id="lastIng"><td colspan="3"> <button id="addIng" onclick="addIngr()">Додати інгредієнт</button></td></tr>
     <tr><th>Вихід</th><td><input type= "number" id= "output" min= "1" step= "0.01" placeholder="150" required autocomplete="off" size="6" value="'.$dish["Outcome"].'"/></td><td>г</td> 
     <tr>
     <td colspan="4"> Додаткова накрутка:  <input type= "number" id="factor" min= "0" step= "0.01" autocomplete="off" size="6" value="'.$dish["Factor"].'"/></td>
     <th> Ціна: <input type= "number" id="price" size="5"step= "0.01" autocomplete="off" value="'.$dish["Price"].'"/> грн</th>
     </tr>'
?>
   </table>
   <br>  
  </fieldset><br>
  </form>
  <button onclick="addDish()" >Змінити</button>
  <button class="cancel" onclick="location.href='printD.php';">Скасувати</button> 

</div>
  
 <form method="post" action="wDish.php" id="addDish">
   <input type="hidden" id="dName" name="dname">
   <input type="hidden" id="oldName" name="oldName" value="<?php echo @ $_POST['name']; ?>">
   <input type="hidden" id="ingr" name="ingr">
   <input type="hidden" id="emount" name="emount">
   <input type="hidden" id="outcome" name="outcome">
   <input type="hidden" id="dprice" name="dprice">
   <input type="hidden" id="dfactor" name="dfactor">
   <input type="hidden" id="action" name="action" value="editD">
</form>

</body>
</html>
