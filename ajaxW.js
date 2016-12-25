
//TODO: add info on page about ongoing request


//-----------------------------------------
//  send http request (POST) and return responce
//-----------------------------------------

/*
to make only 1 instance of request output 
additionaly result handler is iintroduced
to return execution to proper place

execution is ends at request send
asynchronous answer comes and rersult is handled by result handler
"action" is used to identyfy what to do with the result and where to go to continue execution

*/


function sendHttpReq(request,action)
{
  url ="ajaxW.php";

  if (window.XMLHttpRequest)
    { xmlhttp=new XMLHttpRequest();}  /*code for IE7+, Firefox, Chrome, Opera, Safari*/  
  else
    { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); } // code for IE6, IE5
   
  xmlhttp.open("POST",url,true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // to send GET-like data in POST    //xmlhttp.open("GET",url+"?"+the_data,false);
  xmlhttp.send(request);



  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4) 
    {
      if(xmlhttp.status==200)
      {
//------SUCCESS------------
        clearTimeout(timeout);
        //do thomething with result
        result =  xmlhttp.responseText; 
        resultHandler(result,action)
      }
      else
      {
        handleError("Errod during reading DB\n status: "+xmlhttp.statusText+"\n status# : "+xmlhttp.status+"\n state: "+xmlhttp.readyState+"\n response: " + xmlhttp.responseText); // error
        clearTimeout(timeout);
        return false;
      }
    }
  }
  //we may receive wrong answers let's wait for a while 
  var timeout = setTimeout( function()
  { 
    xmlhttp.abort(); 
    handleError("DB response timeout") 
    return false;
  }, 15000);//timeout for 15sec 
  return true;
}

//-----------------------------------
// decide what to do with the result
//-----------------------------------

function resultHandler(result,action)
{
  switch(action) 
  {
    case "getPriceingredients":
      getPricePart2(result);
      break;
    case "getDishDetail":
      dishDetailPart2(result);
      break;
    case "getPriceList":
      setPriceList(result);
      break;
    case "getIngredient":
      getPricePart2(result);
      break;

    default:
      alert("Not supported action:"+action);

  } 
}
//////////////////////////////////////////////////
// trigers
//////////////////////////////////////////////////

//----------------------------------
// reads price of item from any table 
//----------------------------------
/* there must be Name and Price colums
Actualy more options may be implemented, but it would be more usefoul with common naming TODO: currently uses only once
*/
function dbGetPrice(item,table,action)
{ 
  action="getPrice"+table;
  request = 'ordercode=getPrice&table='+table+'&name='+item;
  sendHttpReq(request,action); // we do not expect any answer. Function will be trigered at POST reply
}


//------------------------
// get all dish details
//------------------------
function dbGetDish(item)
{
  action="getDishDetail";
  request = 'ordercode=getDish&name='+item;
  sendHttpReq(request,action); 
}


//-----------------------------------
// update prices at editDish loads
//-----------------------------------
function updatePrice(list)
{
  action="getPriceList";
  request = 'ordercode=getPriceList&name='+list;
  sendHttpReq(request,action); 
}


//---------------------------------------------------------------------------------
//commn error handling
//-----------------------------------------------------------------------------------
function handleError(msg)
{
  alert("ERROR:\n"+msg);  //TODO make me better
}




