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
  <script type="text/javascript" src="common.js"></script>
</head>


<body>
<?php

require "lib.php"; 
createMenu();

?>
<div class="main_div">
<div class="add_form">
  <form>
  <fieldset>
  <legend><h2>Додати страву</h2></legend>  
  Назва страви:<br>
  <input type="text" id="nameDs" placeholder= "Вібивна" autocomplete="off" required size="50"/> <br>
   Iнгредієнти:<br>
   <table class="dishComp">  
     <tr>
       <th colspan="2">Складник</th><th colspan="2">Кількість</th><th>Ціна</th>
     </tr>
     <tr id="lastIng"><td colspan="3"> <button id="addIng" onclick="addIngr()">Додати інгредієнт</button></td></tr>
     <tr><th>Вихід</th><td><input type= "number" id= "output" min= "1" step= "0.01" placeholder="150" required autocomplete="off" size="6"/></td><td>г</td> 
     <tr>
     <td colspan="4"> Додаткова накрутка:  <input type= "number" id="factor" min= "0" step= "0.01" value= 0 autocomplete="off" size="6"/></td>
     <th> Ціна: <input type= "number" id="price" size="5"step= "0.01" value= 0 autocomplete="off" /> грн</th>
     </tr>
   </table>
   <br>  
  </fieldset><br>
  </form>
  <button onclick="addDish()" >Додати</button>
  <button class="cancel" onclick="location.href='printD.php';">Скасувати</button> 

</div>
  
 <form method="post" action="wDish.php" id="addDish">
   <input type="hidden" id="dName" name="dname">
   <input type="hidden" id="ingr" name="ingr">
   <input type="hidden" id="emount" name="emount">
   <input type="hidden" id="outcome" name="outcome">
   <input type="hidden" id="dprice" name="dprice">
   <input type="hidden" id="dfactor" name="dfactor">
   <input type="hidden" id="action" name="action" value="addD">
</form>
</div>
</body>
</html>