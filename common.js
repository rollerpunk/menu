
//-----------------------------------------
//  send http request (POST) and return responce
//-----------------------------------------
function sendHttpReq(url,request,action)
{
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

//----------------------------------------------------------------------------------
// reads price of item from any table 
//--------------------------------------------------------------------------------
/* there must be Name and Price colums
Actualy more options may be implemented, but it would be easier with common naming
*/
function dbGetPrice(item,table,action)
{ //TODO:   create dish objeect or so
  action="getPrice"+table;
  url ="work.php";
  request = 'ordercode=getPrice&table='+table+'&name='+item;
  sendHttpReq(url,request,action); // we do not expect any answer. Function will be trigered at POST reply
}


function resultHandler(result,action)
{
  switch(action) 
  {
    case "getPriceingredients":
      getPricePart2(result);
      break;
    default:
      alert("Not supported action:"+action);
  } 
}


//---------------------------------------------------------------------------------
//commn error handling
//-----------------------------------------------------------------------------------
function handleError(msg)
{
  alert("ERROR:\n"+msg);  //TODO make me better
}


