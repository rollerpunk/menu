<!DOCTYPE html>
<head> 
  <title>Iнгредієнти</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">
  <link rel="stylesheet" href="menu.css">
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
  $result = sendSql("SELECT * FROM ingredients"); 

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
      <th>Накрутка</th>
      <th>Накручена ціна</th>
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
      <td>".$row['Factor']." </td>
      <td>".$tPrice*$row['Factor']." </td>
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
   <input type="hidden" id="factor" name="factor">
</form>
</body>
</html>

