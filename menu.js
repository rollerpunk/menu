/*  moved to printIng.php
$(function(){ // we have dynamic page. wait until it loads
  //--------------------------------------------
  // edit ingredient on dblclick
  //--------------------------------------------
  $("#ingTbl").on("dblclick", "tr", function() {
     //alert($(this).text());
     //TODO: create editable field . use td above.

     //create object from the row and pass it to the edit page
     line= $(this).text().split(" ");
     var ing={name:line[6],
              price: line[21],
              pack: line[13],
              unit: line[14],
              factor: line[36]} 

     alert(JSON.stringify(ing));   
  });
});
*/

//--------------------------




