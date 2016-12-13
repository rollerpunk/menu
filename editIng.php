<!DOCTYPE html>
<head> 
  <title>Змінити інгредієнт</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">

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

<?php 
formIng($_POST['name'],$_POST['unit'],$_POST['pack'],$_POST['price'],$_POST['bPrice']);
?>

</div>
</body>

</html>
