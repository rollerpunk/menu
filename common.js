// TODO:
// -- footer for butttons needs to stick if page is very long
// -- set layout : vertical/horisontal
// -- calculate and set best menu width
// -- hidde/show menu for vertical layout

$(function(){ // we have dynamic page. wait until it loads
  setActiveMenu();
});


function setActiveMenu()
{
  page = location.pathname.substring(1);
  switch (page) {
    case "addIng.php":;
    case "editIng.php":;
    case "printIng.php":
        setActive("printIng.php");
        break;
    case "addDish.php":;
    case "editD.php":;
    case "printD.php":
        setActive("printD.php");
        break;
    //add other pages too

    default:
     alert ("add page to menu handler:\n"+page);
  }
 
}

function setActive(page)
{
  $(".nav_menu a").each(function(){
    path= location.hostname+"/"+page;

    if ( path == $(this).prop("href").substring(7))
    {
      $(this).parent().addClass("active");
      return;
    }
  });
}

