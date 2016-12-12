<!DOCTYPE html>
<head> 
  <title>Додати інгредієнт</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">

  <link rel="stylesheet" type="text/css" href="common.css" />  
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' media="only screen and (max-device-width: 799px)"/>
  <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 799px)" href="small-device.css" />  
  <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 800px)" href="menu.css" />  


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
  <div style="display:inline-block">
   Фасофка:<br>
     <input type= "number" name= "pack" min= "0" step= "0.01" placeholder="1" required autocomplete="off" size="4"/>
     <input type="radio" name="kg" value="кг" checked autocomplete="off"><label for="kg">кг</label>
     <input type="radio" name="g" value="г" autocomplete="off"><label for="g">гр</label>
     <input type="radio" name="p" value="шт" autocomplete="off"><label for="p">шт</label>
     <br>
  </div><br>
  <div style="display:inline-block;margin:10px">
   Ціна:<br>
     <input type= "number" name= "price" min= "0" step= "0.05" placeholder="10" required autocomplete="off" size="4"/> грн
  </div> 
   <div style="display:inline-block;margin:10px">
   Ціна бару:<br>
   <input type= "number" name= "bPrice" min= "0" step= "0.05" placeholder="10" required autocomplete="off" size="4"/> грн
  </div>
  </fieldset><br>
  <button name="btn" value="addIng">Додати</button>
  <button class="cancel" onclick="location.href='printIng.php';">Скасувати</button> 
</form> 
</div>
</div>
</body>

</html>
