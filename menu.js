//TODO: to include originals 
/*
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
*/

var priceList=[]; // array with ingredients prices
var oldPrice= 0; //needed to calculate factor at price change. Also we could recalculate al dish once again byt why for ?
var oldFactor= 0;
//------------------------------------
// TODO:add dish to DB
//------------------------------------
function addDish()
{
 alert("add Dish to DB");
}

//-----------------------------------
// TODO:get ingredient price from DB
//-----------------------------------

function getIngPrice(item)
{
 alert("get price of ingridient "+item+" from DB");
 return 100;

 // TODO: can we multiple iingredients ?
}


//----------------------------------
// add 1 more ingreedient to dish
//----------------------------------
function addIngr()
{                              // use div for autocomlite
  $('#lastIng').before(' <tr class="ing2Calc"> \
                               <td><div class="ui-widget">\
                                 <input class = "calcTriger nameIng" type="text" name="nameIng" placeholder= "Свинина" autocomplete="off" required size="40" />\
                               </div></td> \
                               <td><input class = "calcTriger" type= "number" name= "evalIng" min= "0" step= "0.01" placeholder="300" required autocomplete="off" size="4"/></td>  \
                               <td> <select class = "calcTriger" autocomplete="off" name="unitIng"> <option value="кг">Кг</option><option value="г" selected>г</option><option value="шт">Шт</option></select></td>\
                       </tr>');
} //TODO: make filds numerable to get by name/id

//----------------------------------
// triger for calculation by ingridient change
//----------------------------------
// syntax for dynamicly created elements
$(document).on('change', '.calcTriger', function() 
{

  // check  if all is filled enought to get data
  var no;
  var tr = $('.calcTriger').each(function() {   
    if ( $(this).val()=="") no=true;
  });
  if (no == true) return;

  udatePrice();
 });




//--------------------------------------------
// triger for recalculation by factor change
//--------------------------------------------
// syntax for dynamicly created elements
$(document).on('change', '#factor', function()
{
  var factor = $("#factor").val();
  var delta = (factor*100 - oldFactor*100)/100;
  alert ("d: "+ delta + "\nf: " + factor + "\no: "+ oldFactor );
  price =  ($('#price').val()*100 + delta*100)/100;
  oldPrice=price;
  oldFactor=$("#factor").val();
  $('#price').val(price);
  $('#price').text(price);
});

//----------------------------------
// triger for recalculation by manual price change
//----------------------------------
// syntax for dynamicly created elements
$(document).on('change', '#price', function()
{
  //we need to change eval by price delta
  delta = ($('#price').val()*100 - oldPrice*100)/100;
  delta = (delta*100 + $('#factor').val()*100)/100;
  alert ("d: "+ delta + "\np: " + $('#price').val() + "\no: "+ oldPrice );
  $('#factor').val(delta);
  $('#factor').text(delta);
  oldPrice=$('#price').val();
  oldFactor=$("#factor").val();
});


//----------------------------------------------------
//create object usable or JSON
//----------------------------------------------------
/*
{"employees":[
    {"firstName":"John", "lastName":"Doe"},
    {"firstName":"Anna", "lastName":"Smith"},
    {"firstName":"Peter", "lastName":"Jones"}
]}
*/
function getDishObj(toJson=false)
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

//-----------------------------------------------------
// aoutocomplete at ingreient with available in DB
//-----------------------------------------------------
// syntax for dynamicly created elements
$(document).on('focus', '.nameIng', function() 
{
  //alert("keyup");
  $(this).autocomplete({ source: 'search.php'  });
});

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
    priceIng = priceList[dish[i][0]]
    if(!priceIng) //get price from DB if it wasn't done before
    {
      priceIng = getIngPrice(dish[i][0]);
      priceList[dish[i][0]]=priceIng; 
    }
    
    emount = dish[i][1];
    // align units 
     
   
    // we can try to calculate  (avoid reals)
    tPrice = ( priceIng * emount ) ;

    if(dish[i][2] == "г") tPrice = tPrice/1000;  
    price+=tPrice ; 

  }


  price = (price*100 + $("#factor").val()*100)/100 ; //need to multyply by 1 to avoidstring
  oldPrice=price;
  $('#price').val(price);
  $('#price').text(price);
}



