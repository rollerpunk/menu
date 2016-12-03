//it's very page dependant script, by #dishTbl. We should not run it for all pages


$(function(){ // we have dynamic page. wait until it loads
  $(".dDetails").on("click", "tr", function() {
      var x= $(this).find("th") 
   if (x.length != 0)
   { //skip headlines
      return; 
   }

//to find indexes

     str="";
     for (i=6;i<line.length;i++)
     {
       str+=", "+i+":"+line[i];
       if (i%7==0)
         str+="\n";
     }      
     line= $(this).text().split(" ");       
     alert (str);

     // fill hidden form and send it to editIng.php withh post
 /*    $('#ingName').val(line[6]);
     $('#price').val(line[13]);
     $('#pack').val(line[21]);
     $('#unit').val(line[22]);
     $('#factor').val(line[43]);

     $('#formIng').submit(); //submiin form

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



//-----------------------------------------------------
// aoutocomplete at ingreient with available in DB
//-----------------------------------------------------
// syntax for dynamicly created elements
$(document).on('click', 'tr', function() // TODO: add id selector
{
//using click while long press is not implemented

   //check if it's not a header
   var x= $(this).find("th") 
   if (x.length != 0)
   { //skip headlines
      return; 
   }


   line= $(this).text().split(" ");       
   //create editable field . use td above. 
   $(this).addClass( "tr-active" ); //to find the priceHolder
  
   dbGetDish(line[6]);  //get dish details
  
//cntinue in part 2   
});
//--------------------------------------
//   print dish details part2
//-------------------------------------
//second part to be called when result will come
// receive json of ingredients
function dishDetailPart2(data)
{  
  alert ("removeme :get dish--\n "+ data);
} // TODO: we will use objects soon



