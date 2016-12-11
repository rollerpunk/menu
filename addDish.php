<!DOCTYPE html>
<head> 
  <title>Додати страву</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' media="only screen and (max-device-width: 799px)"/>
  <link rel="stylesheet" type="text/css" href="common.css" />  
  <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 800px)" href="menu.css" />  
  <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 799px)" href="small-device.css" />  


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
  <input type="text" id="nameDs" placeholder= "Вібивна" autocomplete="off" required /> <br>
   Iнгредієнти:<br>
   <table class="dishComp">  
     <tr>
       <th colspan="2">Складник</th><th>Вхід</th><th>Вихід</th><th colspan="2">Ціна</th>
     </tr>
     <tr id="lastIng"><td colspan="3"> <button id="addIng" onclick="addIngr()">Додати інгредієнт</button></td></tr>
     <tr>
       <td colspan="2"> Додаткова накрутка:  <input type= "number" id="factor" min= "0" step= "0.01" value= 0 autocomplete="off" /></td>
       <th></th><th> <input type= "number" id= "output" min= "1" step= "0.01" placeholder="150" required autocomplete="off" /> г</th> 
       <th colspan="2"><input type= "number" id="price" step= "0.01" value= 0 autocomplete="off" /> грн</th>

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
   <input type="hidden" id="emountout" name="emountout">
   <input type="hidden" id="outcome" name="outcome">
   <input type="hidden" id="dprice" name="dprice">
   <input type="hidden" id="dfactor" name="dfactor">
   <input type="hidden" id="action" name="action" value="addD">
</form>
</div>
</body>
</html>
