<!DOCTYPE html>
<head> 
  <title>Страви</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">
  <link rel="stylesheet" href="menu.css">
  <script src="jquery.min.js"></script>
  <script type="text/javascript" src="ajaxW.js"></script>
  <script src="printD.js"></script>
  <script type="text/javascript" src="common.js"></script>
</head>
<body>

<?php

require "lib.php"; // move all DB work outside

createMenu();
?>

<div class="main_div">


<?php
printDishlist();

// there is html below
 
//-------------------------------------------------------------------
//--- functions --


//----------------------------------------
// --print table of ingredients
//----------------------------------------
function printDishlist()
{

  $result=sendSql("SELECT * FROM dish"); 

  if($result->num_rows > 0)
  {
  //good it's time to create table
  //header
    echo ("<div class=\"ingr_table\" id=\"ingTbl\" ><table>
    <tr>
      <th>Страва</th>
      <th>Вихід</th>
      <th>Ціна</th>   
    </tr>");
  //rows

    while($row = $result->fetch_assoc())
    {
      echo("<tr class='passive'>
      <td>".$row['Name']." </td>
      <td>".$row['Outcome']." г</td>
      <td>".$row['Price']." грн </td>
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
  <button onclick="location.href='addDish.php';">Додати страву</button> 
</footer>  

 <form method="post" action="editD.php" id="editDish">
   <input type="hidden" id="name" name="name">
</form>

</body>
</html>

