// TODO:
// -- mobile view 6p 
// -- separate menu for mobile 
// -- redirect to mobile
// -- freeze span !! on big table
// -- set layout : vertical/horisontal
// -- floating thead for tables
// -- calculate and set best menu width

$(function(){ // we have dynamic page. wait until it loads
  setActiveMenu(); // define what sector is active
  stickFooter();
});

// -------------------------------------------
// show/hide navigation menu
//--------------------------------------------
// syntax for dynamicly created elements
$(document).on('click', '#opener', function() 
{
 
  if ($("#opener").css( "cursor") == "w-resize")
  {
   $("#opener").css( "cursor", "e-resize" );
   $(".nav_menu").css( "width", "5px" );
   $(".main_div , .footer_btn").css( "margin-left", "7px" );
   $(".nav_menu ul").css("display","none");
  }
  else
  {
   $("#opener").css( "cursor", "w-resize" );
   $(".nav_menu").css( "width", "20%" );
   $(".main_div , .footer_btn").css( "margin-left", "20%" );
   $(".nav_menu ul").css("display","block");
  }

  // align fixed footer width
  dWidth =  $(".main_div").css("width");
  $(".footer_btn").css("width",dWidth);
});

//---------------------------------------
// select which  menu item is active
//---------------------------------------
function setActiveMenu()
{
  page = location.pathname.substring(1);
  $(".titlePage").empty();


  switch (page) {
    case "addIng.php":;
    case "editIng.php":;
    case "printIng.php":
    case "mPrintIng.php":
        page= "printIng.php";
        $(".titlePage").append("Інгрідієнти");
        break;
    case "addDish.php":;
    case "editD.php":;
    case "printD.php":
    case "mPrintD.php":
        $(".titlePage").append("Страви");
        page="printD.php";
        break;
    //add other pages too

    default:
     alert ("add page to menu handler:\n"+page);
     $(".titlePage").append(page);
     return;
  }
  
  $(".nav_menu a").each(function(){
    if ( page == this.getAttribute('href', 2))
    {
      $(this).parent().addClass("active");
      return;
    }
 
  });
}

function stickFooter()
{
  if ($(window).height() < $(document).height()) // it's too long. stick footer
  {
    dWidth =  $(".main_div").css("width");
    var styles = {
      position : "fixed",
      bottom: "0",      
      backgroundColor :"white",
      width: dWidth
    };
    $(".footer_btn").css(styles);
    $(".main_div").css("padding-bottom","90px");


    $( window ).resize(function() {
      dWidth =  $(".main_div").css("width");
      $(".footer_btn").css("width",dWidth);
    });

  }
 
}

