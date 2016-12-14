//----------------------------------
// trigger for calculation of ingredient price per unit
//----------------------------------
// syntax for dynamically created elements
$(document).on('change', '.i_triger', function () {getPpu();});

//-----------------------------------
// calculate and display price per unit
//-----------------------------------
function getPpu()
{
	
  unit=$('input[name=unit]:checked', '#ingrForm').val();
  price=$('input[name=price]').val();
  pack=$('input[name=pack]').val();
  
  // align to kg
  if (unit == "г")
  {
	  unit= "кг";
	  price=price*1000;
  }
  
  ppu= price*100000/pack/100000; //fucking js
  
  //display price per unit
  $("#ppu").find("span:nth-child(1)").empty();
  $("#ppu").find("span:nth-child(1)").append(ppu); 
  $("#ppu").find("span:nth-child(2)").empty();
  $("#ppu").find("span:nth-child(2)").append(unit );
  
  $("#bPrice").find("span").empty();
  $("#bPrice").find("span").append(unit );
  
	
}