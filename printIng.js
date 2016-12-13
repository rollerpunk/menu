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

       line = $(this).find("td:nth-child(2)").text().split(" ");
       price= line[0];
       line = $(this).find("td:nth-child(3)").text().split(" ");
       pack= line[0];
       unit= line[1];
       line = $(this).find("td:nth-child(6)").text().split(" ");
       bPrice=line[0];  
	   

       // fill hidden form and send it to editIng.php withh post
       $('#ingName').val($(this).find("td:nth-child(1)").text());
       $('#price').val(price);
       $('#pack').val(pack);
       $('#unit').val(unit);
       $('#bPrice').val(bPrice);
       $('#formIng').submit(); //submiin form


//TODO: there is no dblclick on phones. use long press like below
/*
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
