//TODO: to include originals 
/*
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="ajaxW.js"></script>
*/



//TODO 
/*
 *  mark namefield as error if dish already exists
    print view,use sorting by gpoups   
    no price per unit in dish
    highlight final price
    calculate min width for window
    wider priceholder
    limited list for tags 
*/

$(function(){ // we have dynamic page. wait until it loads


    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }



   $("#dType").chosen(config);
    

});


function setTags(values)
{
 $.each(values.split(","), function(i,e){
      $("#dType option[value='" + e + "']").prop("selected", true);
    });
}

var priceList=[];
var oldPrice=0;


//----------------------------------
// add 1 more ingreedient to dish
//----------------------------------
function addIngr()
{                              // use div for autocomlite
  $('#lastIng').before(' <tr class="ing2Calc"> \
                               <td><div class="ui-widget">\
                                 <input class = "calcTriger nameIng in_data" type="text" name="nameIng" placeholder= "Свинина" autocomplete="off" required />\
                               </div></td> \
                               <td><input class = "calcTriger in_data" type= "number" name= "evalIng" min= "0" step= "1" placeholder="300" required autocomplete="off"/></td>  \
                               <td><input class = "calcTriger in_data" type= "number" name= "outIng" min= "0" step= "1" placeholder="300" required autocomplete="off"/>г</td>\
                               <td></td>\
                               <td><div class="delBtn">X</div></td>\
                       </tr>');
}

//----------------------------------------------------
//create object usable or JSON
//----------------------------------------------------
/*
{"employees":[
    {"firstName":"John", "lastName":"Doe"},
    {"firstName":"Anna", "lastName":"Smith"},
    {"firstName":"Peter", "lastName":"Jones"}
]}*/

function getDishObj(toJson=false)  //FIXME
{
  var otJson = [];
  var otObj=[];
  var tr = $('.ing2Calc').each(function(i) {   
    td = $(this).children();
    var itJson = [];
    var itObj =[];
    td.each(function() {
       x= $(this).find('.in_data')
       itJson.push('"'+x.attr("name")+'":"'+x.val()+'"');
       itObj.push(x.val());
    });
    otJson.push('{'+itJson.join(",")+'}');
    otObj.push (itObj);
  })
  json='{"'+ $('#nameDs').val()+'"'+":["+otJson.join(",")+"]}";

  if (toJson == true)
    return JSON.parse(json);
  else
    return otObj;
}


//--------------------------------------------
// price calculation
//--------------------------------------------
function udatePrice()
{
 //read ingredients
  var price=0;
  var dish=getDishObj();
  var outEmount = 0;
  for (i=0;i< dish.length;i++)
  { 

    priceIng = priceList[dish[i][0]];
    emount = dish[i][1]; 
    outEmount +=  dish[i][2]*1
    tPrice = ( priceIng * emount ) ;    // align units 
    price+=tPrice ;

  }
  //tmpPrice is multiplied by 1000  <--- kostuli dlja js kalkyljacii
  price = (price + $("#factor").val()*1000)/1000; //need to multyply  to avoid string and stupid calculation errors
  oldPrice=price;
  $('#price').val(price);
  $('#price').text(price);
  
  $('#output').val(outEmount);
  $('#output').text(outEmount);
  
  return price;
}



//--------------------------------------------
// trigger for recalculation by factor change
//--------------------------------------------
// syntax for dynamicly created elements
$(document).on('change', '#factor', function()
{
  price = udatePrice();

});

//----------------------------------
// trigger for recalculation by manual price change
//----------------------------------
// syntax for dynamicly created elements
$(document).on('change', '#price', function()
{
  price = $('#price').val();
  delta = ( price*1000 - oldPrice * 1000)/1000;
  $('#factor').val(delta);
  $('#factor').text(delta); 
});



//------------------------------------
// add dish to DB.  Using JSON object
//------------------------------------
function addDishJson()
{

  jDish="{ ";
  jDish+="\"Name\":\""+$("#nameDs").val()+"\",";
  jDish+="\"Price\" : \""+$("#price").val()+"\" ,";
  jDish+="\"Outcome\":\""+$("#output").val()+"\",";
  jDish+="\"Factor\":\""+$("#factor").val()+"\",";

  var dish=getDishObj(); 
  //put data to strings
  var ing="[";
  var emnt="[";  
  var oemnt="[";
  for (i=0;i< dish.length;i++)
  {
    ing+="\""+dish[i][0]+"\",";
    emnt+="\""+dish[i][1]+"\",";
    oemnt+="\""+dish[i][2]+"\",";
  }
  // replace last , with ]
  ing = ing.replace(/.$/,"]");
  emnt = emnt.replace(/.$/,"]");
  oemnt = oemnt.replace(/.$/,"]");
 
  jDish+="\"Ingredients\":"+ing+",";  
  jDish+="\"Emounts\":"+emnt+",";
  jDish+="\"OutEmounts\":"+oemnt+",";
  jDish+="\"Notes\":\""+$("#notes").val()+"\",";
  jDish+="\"Type\":\""+$("#dType").val()+"\"}";

  $("#dish").val(jDish);   
//TODO: check data
  if ($("#nameDs").val() !="")
    $('#addDish').submit(); //submit form
  
}



//----------------------------------
// trigger for calculation by ingridient change
// update price for current ingredient
//----------------------------------
// syntax for dynamicly created elements
$(document).on('change', '.calcTriger', function() 
{
  var ing =[];
  var $row = $(this).closest("tr");    // get closest <tr>  -- parrent one
  var $tds= $row.children();
  var on =0;
  $.each($tds, function() {               
     x= $(this).find('.calcTriger') // find inputs too check if all is filled
     if (x.val()=="") on=1;       
     ing.push(x.val());         
  });
  if (on==1) return; //we can't doublereturn. nned to use one more check
  
  $td = $row.find("td:nth-child(1)"); // Finds the 1st <td> element
  $td.addClass( "td-active" ); //find the priceHolder



 //get price
  dbGetPrice(ing[0],"ingredients");  
//end of first part
});

//second part to be called when result will come
function getPricePart2(result)
{
  //price is per kg,but we use it for grams (1000 times more)   <----kostul dlja kalkyljacii v js
   
  ing = JSON.parse(result); 
  priceList[ing.Name] = ing.BarPrice*(ing.Unit=="кг" ? 1:1000); //set factorised price*1000

  $row=$(".td-active").closest("tr");
// TODO: add units ,use g for now 
  
  emount = $row.find("td:nth-child(2)").find("input").val(); //get emount of ingredient
  
  $row.find("td:nth-child(3)").contents().filter(function () {
	  return this.nodeType === 3; 
  }).remove();
  //$row.find("td:nth-child(3)").find("input").val(emount*60/100) // auto decrease outcome
  $row.find("td:nth-child(3)").append((ing.Unit == "кг" ? "г" : ing.Unit));
  $row.find("td:nth-child(4)").empty();
  $row.find("td:nth-child(4)").append(emount*priceList[ing.Name]/1000+" грн"); //price per ingredient
  $(".td-active").removeClass("td-active");

//update total price
  price = udatePrice();


};


//----------------------------------
// remove ingredient
//----------------------------------
// syntax for dynamicly created elements
$(document).on('click', '.delBtn', function()
{

  $row=$(this).closest("tr");
  $row.remove();

//update total price
  price = udatePrice();

});


//-----------------------------------
// update prices at editDish loads
//-----------------------------------
function setPriceList(result) //json object
{
  ings = JSON.parse(result); 
  len = ings["length"];
  for (i=0;i<len;i++)
  {    
    price= ings[i]["BarPrice"]*(ings[i]["Unit"]=="кг"? 1:1000);
    priceList[ings[i]["Name"]]=price;   // store price
  }
  price = udatePrice();
  
  if ($('#price').val() != price)
    alert ("price updated \nold:"+$('#price').val()+"\nnew: "+price);

}

//-----------------------------------------------------
// aoutocomplete at ingreient with available in DB
//-----------------------------------------------------
// syntax for dynamicly created elements
$(document).on('focus', '.nameIng', function() 
{
  //alert("keyup");
  $(this).autocomplete({ source: 'search.php'  });
});


// syntax for dynamicly created elements
$(document).on('change', '#nameDs', function() 
{
   isDishInDb($('#nameDs').value)
});

function isDishInDb2(result)
{  
    if (result == 1) // dish already present in DB
    {
       // alert("Dish already exists");
        $( "#nameDs" ).addClass( ":invalid" );    
    }
    else
    {
        $( "#nameDs" ).removeClass( ":invalid" );
    }
}

