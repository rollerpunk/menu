<!DOCTYPE html>
<head> 
  <title>Додати страву</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.ico" type="image/x-icon">

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' media="only screen and (max-device-width: 799px)"/>
  <link rel="stylesheet" type="text/css" href="common.css" />  
  <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 800px)" href="menu.css" />  
  <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 799px)" href="small-device.css" />  

  <script src="jquery-1.12.4.js"></script>

  <link rel="stylesheet" href="jquery-ui.css">
  <script src="jquery-ui.js"></script>

  <link rel="stylesheet" href="chosen.min.css">
  <script src="chosen.jquery.min.js" type="text/javascript"></script>

  <script type="text/javascript" src="common.js"></script>
  <script type="text/javascript" src="ajaxW.js"></script>
  <script type="text/javascript" src="wDish.js"></script>
  



</head>


<body>
<?php

require "lib.php"; 
createMenu();

?>
<div class="main_div">

<?php
dishForm();
?>

</div>
</body>
</html>
