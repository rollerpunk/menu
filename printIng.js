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
