<!DOCTYPE html>
<head> 
  <title>Iнгредієнти</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="icon" href="menu.png" type="image/x-icon">
  <link rel="stylesheet" href="menu.css">
  <script src="jquery.min.js"></script>

  <script>
  //it's very page dependant script, by #ingTbl. We should not run it for all pages
  $(function(){ // we have dynamic page. wait until it loads
    //--------------------------------------------
    // edit ingredient on dblclick
    //--------------------------------------------
    $("#ingTbl").on("click", "tr", function() {
//using click while long press is not implemented

       //check if it's not a header
       var x= $(this).find("th") 
       if (x.length != 0)
       { //skip headlines
          return; 
       }

       //TODO: create editable field . use td above.   
       line= $(this).text().split(" ");       
  
//to find indexes
  /*     str="";
       for (i=6;i<line.length;i++)
       {
         str+=", "+i+":"+line[i];
         if (i%7==0)
           str+="\n";
       }      

       alert (str);*/

       // fill hidden form and send it to editIng.php withh post
       $('#ingName').val(line[6]);
       $('#price').val(line[13]);
       $('#pack').val(line[21]);
       $('#unit').val(line[22]);
       $('#factor').val(line[43]);

       $('#formIng').submit(); //submiin form

       //create object from the row and pass it to the edit page
       /* TODO: for future maybe
       var ing={name:line[6],
                price: line[21],
                pack: line[13],
                unit: line[14],
                factor: line[36]} 
       alert(JSON.stringify(ing)); 
       $('#ing').val(JSON.stringify(ing));

//TODO: there is no dblclick on phones. use long press like below

    $("a").mouseup(function(){
      clearTimeout(pressTimer);
      // Clear timeout
      return false;
    }).mousedown(function(){
      // Set timeout
      pressTimer = window.setTimeout(function() { ... Your Code ...},1000);
      return false; 
    });

       */
    });


  });
  </script>
</head>
<body>

<?php

require "dbwork.php"; // move all DB work outside

printIngredients(getIngredients());



//-------------------------------------------------------------------
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

<br>
<hr>
  <button onclick="location.href='addIng.html';">Додати інгредієнт</button> 
  <button onclick="location.href='addDish.html';">Додати страву</button> 
  
<form method="post" action="editIng.php" id="formIng">
   <input type="hidden" id="ingName" name="name">
   <input type="hidden" id="price" name="price">
   <input type="hidden" id="pack" name="pack">
   <input type="hidden" id="unit" name="unit">
   <input type="hidden" id="factor" name="factor">
</form>

</body>
</html>

