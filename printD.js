//-----------------------------------------------------
// print dish details
//-----------------------------------------------------
// syntax for dynamicly created elements
$(document).on('click', 'tr.passive', function() 
{
//using click while long press is not implemented

   //check if it's not a header
   var x= $(this).find("th") 
   if (x.length != 0)
   { //skip headlines
      return; 
   }
   dish=$(this).find("td:nth-child(1)").text();

   //create editable field . use td above. 
   $(this).addClass( "tr-active" ); //to find the priceHolder  
   dbGetDish(dish);  //get dish details
  
//cntinue in part 2   
});
//--------------------------------------
//   print dish details part2
//-------------------------------------
//second part to be called when result will come
// receive json of ingredients
function dishDetailPart2(result)
{  

  data = JSON.parse(result); 
  ing= data.Ingredients.split("^"); // should be the same length
  emount= data.Emounts.split("^"); // checked before write wtrite to db
  
  
  str='<tr class="dish_details" > <td colspan="3" > <table> ';
  for (i=0;i<ing.length-1;i++) //there is extra separator. just ignore last element
  {
    ingJSON = getIngJsonDB(ing[i]);
    str+="<tr><td>"+ing[i]+"</td><td>"+emount[i]+" "+ingJSON.Unit+"</td></tr>"
  }
  str+='<tr><td colspan="3">Нотатки:<br><textarea rows="6" cols="50" readonly >'+data.Notes+'</textarea></td></tr></table></td></tr>';
  $row=$(".tr-active"); //find active row
  // insert details       
  $row.after(str);


  $row.addClass( "expanded" );
  $row.removeClass("passive");
  $row.removeClass("tr-active");
} 


//-----------------------------------------------------
// colapse dish details
//-----------------------------------------------------
// syntax for dynamicly created elements
$(document).on('click', 'tr.expanded', function()
{
  $row = $(this).next("tr");
  $row.remove();
  $(this).removeClass("expanded");
  $(this).addClass("passive");
});


//-----------------------------------------------------
// edit dish 
//-----------------------------------------------------
// syntax for dynamicly created elements
$(document).on('click', '.dish_details', function()
{
   //alert ("clicked: "+ $(this).prop("tagName"));
   $row = $(this).prev("tr"); // get dish
   item = $row.find("td:nth-child(1)").html();
   $("#name").val(item);
   $('#editDish').submit(); //submiin form

});




