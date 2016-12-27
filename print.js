$(document).ready(function() {
   alignTables();
});


//-------------------
// find largest and set for all
//--------------------
function alignTables()
{

 var largest = 0;
    $('table.print_table').each(function() {
        var width = $(this)[0].offsetWidth;
        if(width > largest) {
            largest = width;
        }
    }).width(largest);

}
