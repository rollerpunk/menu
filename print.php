<!DOCTYPE html>
<head> 
  <title>Роздруківка</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' media="only screen and (max-device-width: 799px)"/>
  <link rel="stylesheet" type="text/css" media="only screen and (max-device-width: 799px)" href="small-device.css" />  
  <link rel="stylesheet" type="text/css" media="only screen and (min-device-width: 800px)" href="menu.css" />  
  <link rel="stylesheet" type="text/css" href="common.css" />  

  <script src="jquery.min.js"></script>
  <script type="text/javascript" src="ajaxW.js"></script>
  <script type="text/javascript" src="common.js"></script>
  <script src="print.js"></script>
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
    echo "<div class= \"header_table\"><table class=\"print_table\" id=\"printTbl\" \>
        <tr>
          <th>Страва</th>
          <th>К-ть</th>
          <th>Ціна</th>   
        </tr></table></div>";
  //rows
    
    while($row = $result->fetch_assoc())
    {
      $res =getJsonDish($row['Name']);

      $dish = json_decode($res,true);          

      // print dish
      echo "<table class='print_table'> 

        <tr class= \"dish_print_name\">        
          <td>".$dish['Name']." </td>
          <td>".$dish['Outcome']." г</td>
          <td>".$dish['Price']." грн </td>
        </tr>";
     
      echo "<tr class='print_ing_list'><td><u>Інгрідієннти:</u></td></tr>";
      for ($i=0 ; $i < $dish['nOfIngs']; $i++) // get/set data for each ingridient
      {
        echo "<tr class='print_ing_list'>";
        echo "<td>".$dish['Ings'][$i]['Name']."</td>";
        echo "<td>".$dish['Ings'][$i]['Emount']." "; // income
        echo ($dish['Ings'][$i]['Unit'] == 'кг' ? "г" : $dish['Ings'][$i]['Unit'])."</td>"; //units
        echo "<td>".$dish['Ings'][$i]['Emount'] * $dish['Ings'][$i]['BarPrice'] / ($dish['Ings'][$i]['Unit'] == 'кг' ? 1000 : 1)." грн</td>"; //price
       
        echo "</tr>";
      }    
      $note = str_replace("\n", "<br>", $dish['Notes']); 
      echo "<tr class='print_ing_list' ><td><u>Нотатки:</u><br><p>".$note."</p></td></tr>"; 
       echo ("</table>");
    }
    echo "</div>";
  }
}

?>

</div>
<footer class="footer_btn">
<hr>
  <button onclick="">Друкувати</button> 
</footer>  

 <form method="post" action="editD.php" id="editDish">
   <input type="hidden" id="name" name="name">
</form>

</body>
</html>

