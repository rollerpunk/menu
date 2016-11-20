<!DOCTYPE html>
<head> 
  <title>Iнгредієнти</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">
  <link rel="stylesheet" href="menu.css">
</head>
<body>

<?php

require "dbwork.php"; // move all DB work outside

printIngredients(getIngredients());

//----------------------------------------
// --get array of ingredients
//----------------------------------------
function getIngredients()
{  
  $sql = "SELECT * FROM ingredients";
  return sendSql($sql); 
} // TODO: we will use objects soon


//----------------------------------------
// --print table of ingredients
//----------------------------------------
function printIngredients($result)
{
  if($result->num_rows > 0)
  {
  //good it's time to create table
  //header
    echo ("<div class=\"ingr_table\"><table>
    <tr>
      <th>Інгредієнт</th>
      <th>Фасофка</th>
      <th>Ціна</th>
      <th>Ціна за одиницю</th>
      <th>Накрутка</th>
      <th>Накручена ціна</th>
    </tr>");
  //rows
    while($row = $result->fetch_assoc())
    {
      echo("<tr>
      <td>".$row['Name']." </td>
      <td>".$row['Pack']." ".$row['Unit']." </td>
      <td>".$row['Price']."</td>
      <td>".$row['Price']/$row['Pack']." грн/".$row['Unit']." </td>
      <td>".$row['Factor']." </td>
      <td>".$row['Price']/$row['Pack']*$row['Factor']." </td>
      </tr>");     
    }
    echo ("</table></div>");
  }
}

?>
<br>
<hr>
  <button onclick="location.href='addIng.php';">Додати інгредієнт</button> 
</body></html>

