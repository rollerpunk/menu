//TODO: to include originals 
/*
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
*/


var priceList=[];
var oldPrice=0;


//----------------------------------
// add 1 more ingreedient to dish
//----------------------------------
function addIngr()
{                              // use div for autocomlite
  $('#lastIng').before(' <tr class="ing2Calc"> \
                               <td><div class="ui-widget">\
                                 <input class = "calcTriger nameIng" type="text" name="nameIng" placeholder= "Свинина" autocomplete="off" required size="30" />\
                               </div></td> \
                               <td></td>\
                               <td><input class = "calcTriger" type= "number" name= "evalIng" min= "0" step= "1" placeholder="300" required autocomplete="off" size="4"/></td>  \
                               <td></td>\
                               <td></td>\
                               <td><div class="delBtn">X</div></td>\
                       </tr>');
} //TODO: make filds numerable to get by name/id





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
       x= $(this).find('.calcTriger')
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
  for (i=0;i< dish.length;i++)
  { 

    priceIng = priceList[dish[i][0]];
    emount = dish[i][2]; 
    tPrice = ( priceIng * emount ) ;    // align units 
    price+=tPrice ;
  }
  //tmpPrice is multiplied by 1000  <--- kostuli dlja js kalkyljacii
  price = (price + $("#factor").val()*1000)/1000; //need to multyply  to avoid string and stupid calculation errors
  oldPrice=price;

  return price;
}



//--------------------------------------------
// triger for recalculation by factor change
//--------------------------------------------
// syntax for dynamicly created elements
$(document).on('change', '#factor', function()
{
  price = udatePrice();
  $('#price').val(price);
  $('#price').text(price);
});

//----------------------------------
// triger for recalculation by manual price change
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
// TODO:add dish to DB
//------------------------------------
function addDish()
{

  
  //copy data to form
  $("#dName").val( $("#nameDs").val());
  $("#outcome").val($("#output").val()); 
  $("#dprice").val($("#price").val()); 
  $("#dfactor").val($("#factor").val()); 

  var dish=getDishObj(); 
  //put data to strings
  var ing="";
  var emnt="";  
  for (i=0;i< dish.length;i++)
  {
    ing+=dish[i][0]+"^";
    emnt+=dish[i][2]+"^";
  }


  $("#ingr").val(ing);  //TODO check if the same num of elements
  $("#emount").val(emnt);  

//TODO: check data

  $('#addDish').submit(); //submiin form

}



//----------------------------------
// triger for calculation by ingridient change
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
  priceList[ing.Name] = ing.Price/ing.Pack*ing.Factor; //set factorised price*1000

  $row=$(".td-active").closest("tr");
  $row.find("td:nth-child(2)").empty();  //select 2nd column (td)
  $row.find("td:nth-child(2)").append(priceList[ing.Name]+" грн/"+ ing.Unit); 
  $row.find("td:nth-child(4)").empty();
  $row.find("td:nth-child(4)").append((ing.Unit=="кг"? "г": ing.Unit));//translate to g
  emount = $row.find("td:nth-child(3)").find("input").val(); //get emount of ingredient
  $row.find("td:nth-child(5)").empty();
  $row.find("td:nth-child(5)").append(emount*priceList[ing.Name]/1000+" грн"); //price per ingredient
  $(".td-active").removeClass("td-active");

//update total price
  price = udatePrice();
  $('#price').val(price);
  $('#price').text(price); 

};


//----------------------------------
// remove ingredient
//----------------------------------
// syntax for dynamicly created elements
$(document).on('click', '.delBtn', function()
{
  alert("del");
  $row=$(this).closest("tr");
  $row.remove();

//update total price
  price = udatePrice();
  $('#price').val(price);
  $('#price').text(price); 
});




//-----------------------------------------------------
// aoutocomplete at ingreient with available in DB
//-----------------------------------------------------
// syntax for dynamicly created elements
$(document).on('focus', '.nameIng', function() 
{
  //alert("keyup");
  $(this).autocomplete({ source: 'search.php'  });
});

