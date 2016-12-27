// TODO:
// -- mobile view 6p 
// -- freeze panels !! on big table
// -- set layout : vertical/horisontal < -needed ?
// -- floating thead for tables

$(function(){ // we have dynamic page. wait until it loads
  setActiveMenu(); // define what sector is active
  stickFooter();
  selectLayout(); //check if mobile
});


//---------------------------------------
// select which  menu item is active
//---------------------------------------
function setActiveMenu()
{
  n = location.pathname.lastIndexOf("/")
  page = location.pathname.substring(n+1);


  $(".titlePage").empty();


  switch (page) {
    case "addIng.php":;
    case "editIng.php":;
    case "printIng.php":
        page= "printIng.php";
        $(".titlePage").append("Інгрідієнти");
        break;
    case "addDish.php":;
    case "editD.php":;
    case "printD.php":
        $(".titlePage").append("Страви");
        page="printD.php";
        break;

    case "print.php":
      $(".titlePage").append("Друк");
      page="print.php";
      break;
   
    //add other pages too

    default:
     alert ("[common.js] warning: \nadd page to menu handler:\n"+page);
     $(".titlePage").append(page);
     return;
  }
  

  $(".left_menu a").each(function(){ 
    if ( page == this.getAttribute('href', 2))
    {
      $(this).parent().addClass("active");
      return;
    }
 
  });
}



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


//-----------------------------------------
// stick footer if tabble is tall
//-----------------------------------------
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


//-----------------------------
// open/close mbile menu
//-----------------------------
$(document).on('click', '.mOpener', function() 
{
  if ($('.left_menu').is(':visible'))
  {
    $('#mMenu').hide();
    $(".main_div, .footer_btn").show();
  }
  else
  {
    $('#mMenu').show();
    $(".main_div, .footer_btn").hide();
  }

});

//-------------------------------
// select layut depending on device
//-------------------------------

function selectLayout()
{
  if (screen.width < 800) 
  {//mobile

    $(".nav_menu").remove();
    $(".topBar").show();
    $('#mMenu').hide();
  }
  else //pc
  {
    $("#opener").show();
    $(".topBar").remove();
    $("#mMenu").remove();
  }

}


