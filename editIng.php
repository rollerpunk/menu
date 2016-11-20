<!DOCTYPE html>
<head> 
  <title>Змінити інгредієнт</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">
  <link rel="stylesheet" href="menu.css">
</head>


<body>


<div class="add_form">
<form method="post" action="actions.php">
  <fieldset>
  <legend><h2>Інгредієнт</h2></legend>  
  Назва:<br>
   <input type="text" name="name" placeholder= "Картопля" autocomplete="off" required size="40" value="<?php echo @ $_POST['name']; ?>"/> <br>
  <div style="display:inline-block;margin:10px">
    Ціна:<br>
     <input type= "number" name= "price" min= "0" step= "0.05" placeholder="10" required autocomplete="off" size="4" value="<?php echo @ $_POST['price']; ?>"/> грн<br>
  </div> 
  <div style="display:inline-block">
   Фасофка:<br>
     <input type= "number" name= "pack" min= "0" step= "0.01" placeholder="1" required autocomplete="off" size="4" value="<?php echo @ $_POST['pack']; ?>" />
     <input type="radio" name="unit" value="кг" autocomplete="off" <?php if ($_POST['unit'] =='кг') echo "checked" ?>> кг
     <input type="radio" name="unit" value="шт" autocomplete="off" <?php if ($_POST['unit'] =='шт') echo "checked" ?>> шт <br>
  </div><br>
  Накрутка:<br>
   <input type= "number" name= "factor" min= "1.1" step= "0.1" value= "2" required autocomplete="off" size="4" value="<?php echo @ $_POST['factor']; ?>"/>
  </fieldset><br>
  <button name="btn" value="edit">Зміннити</button>
  <button class="cancel" onclick="location.href='printIng.php';">Скасувати</button> 
</form> 
</div>

</body>

</html>
