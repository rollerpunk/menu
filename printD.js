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
//alert (result);
  data = JSON.parse(result); 

  nOfIngs = data.nOfIngs;  
  
  str='<tr class="dish_details" > <td colspan="2"> <table> ';
  for (i=0;i<nOfIngs;i++) //there is extra separator. just ignore last element
  {
    str+="<tr><td>"+data.Ings[i].Name+"</td><td>"+data.Ings[i].Emount+" "+(data.Ings[i].Unit == "кг" ? "г" : data.Ings[i].Unit)+"</td></tr>"
  }
  str+='<tr><td colspan="3"><u>Нотатки:</u><br><div >'+data.Notes.replace(/\n/g, "<br>")+'</div></td></tr></table></td></tr>';
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




