<!DOCTYPE html>
<head> 
  <title>Додати інгредієнт</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' media="only screen and (max-device-width: 799px)"/>
  <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 799px)" href="small-device.css" />  
  <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 800px)" href="menu.css" />  
  <link rel="stylesheet" type="text/css" href="common.css" />  

  <script src="jquery-1.12.4.js"></script>
  <script type="text/javascript" src="common.js"></script>
</head>

<body>
<?php

require "lib.php"; 
createMenu(); 

?>
<div class="main_div">
<div class="add_form">
<form method="post" action="wIng.php">
  <fieldset>
  <legend><h2>Додати інгредієнт</h2></legend>  
  Назва:<br>
   <input type="text" name="name" placeholder= "Картопля" autocomplete="off" required size="40"> <br>
  <div style="display:inline-block;margin:10px">
    Ціна:<br>
     <input type= "number" name= "price" min= "0" step= "0.05" placeholder="10" required autocomplete="off" size="4"/> грн<br>
  </div> 
  <div style="display:inline-block">
   Фасофка:<br>
     <input type= "number" name= "pack" min= "0" step= "0.01" placeholder="1" required autocomplete="off" size="4"/>
     <input type="radio" name="unit" value="кг" checked autocomplete="off"> кг
     <input type="radio" name="unit" value="г" autocomplete="off"> гр 
     <input type="radio" name="unit" value="шт" autocomplete="off"> шт 
     <br>
  </div><br>
  Накрутка:<br>
   <input type= "number" name= "factor" min= "1.1" step= "0.1" value= "2" required autocomplete="off" size="4"/>
  </fieldset><br>
  <button name="btn" value="addIng">Додати</button>
  <button class="cancel" onclick="location.href='printIng.php';">Скасувати</button> 
</form> 
</div>
</div>
</body>

</html>
