<!DOCTYPE html>
<head> 
  <title>Iнгредієнти</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">
  <link rel="stylesheet" href="menu.css">
  <script src="jquery.min.js"></script>
  <script type="text/javascript" src="ajaxW.js"></script>
  <script src="printD.js"></script>
</head>
<body>

<?php

require "dbwork.php"; // move all DB work outside

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
      echo("<tr>
      <td>".$row['Name']." </td>
      <td>".$row['Outcome']." г</td>
      <td>".$row['Price']." грн </td>
      </tr>");     
    }
    echo ("</table></div>");
  }
}

?>

<br>
<hr>
  <button onclick="location.href='addIng.html';">Додати інгредієнт</button> 
  <button onclick="location.href='addDish.html';">Додати страву</button> 
  
 <form method="post" action="addD.php" id="addDish">
   <input type="hidden" id="dName" name="dname">
   <input type="hidden" id="ingr" name="ingr">
   <input type="hidden" id="emount" name="emount">
   <input type="hidden" id="outcome" name="outcome">
   <input type="hidden" id="dprice" name="dprice">
   <input type="hidden" id="dfactor" name="dfactor">

</form>

</body>
</html>

