<!DOCTYPE html>
<head> 
  <title>Iнгредієнти</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.ico" type="image/x-icon">

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' media="only screen and (max-device-width: 799px)"/>
  <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 799px)" href="small-device.css" />  
  <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 800px)" href="menu.css" />  

  <script src="jquery.min.js"></script>
  <script src="printIng.js"></script>
  <script type="text/javascript" src="common.js"></script>
 
</head>
<body>
<?php


require "lib.php"; 
createMenu();

?>
<div class="main_div">

<?php
printIngredients();
//-------------------------------------------------------------------

//----------------------------------------
// --print table of ingredients
//----------------------------------------
function printIngredients()
{
  $result = sendSql("SELECT * FROM ingredients ORDER BY Name ASC;"); 

  if($result->num_rows > 0)
  {
  //good it's time to create table
  //header
    echo ("<div class=\"ingr_table\" id=\"ingTbl\" ><table>
    <tr>
      <th>Інгредієнт</th>
      <th>Ціна</th>
      <th>Фасофка</th>
      <th colspan=\"2\" >Ціна за одиницю</th>
      <th>Ціна бару</th>
    </tr>");
  //rows

    while($row = $result->fetch_assoc())
    {
      $tPrice  = $row['Price']/$row['Pack'];
      $tUnit = $row['Unit'];
      $tPack=$row['Pack'];
      echo("<tr>
      <td>".$row['Name']." </td>
      <td>".($row['Price'])." грн </td>
      <td>".$tPack." ".$tUnit." </td>
      <td>".$tPrice." </td>
      <td>грн/".$tUnit." </td>
      <td>".$row['BarPrice']." </td>
      </tr>");     
    }
    echo ("</table></div>");
  }
}

?>

</div>
<footer class="footer_btn">
<hr>
  <button onclick="location.href='addIng.php';">Додати інгредієнт</button> 
</footer>

<form method="post" action="editIng.php" id="formIng">
   <input type="hidden" id="ingName" name="name">
   <input type="hidden" id="price" name="price">
   <input type="hidden" id="pack" name="pack">
   <input type="hidden" id="unit" name="unit">
   <input type="hidden" id="bPrice" name="bPrice">
</form>
</body>
</html>

