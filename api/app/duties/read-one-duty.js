$(document).ready(function(){
    // handle 'read one' button click
    $(document).on('click', '.read-one-duty-button', function(){
    // product ID will be here
    // get product id
    var id = $(this).attr('data-id');
    // read product record based on given ID
    $.getJSON( getUrl() + "duty/read-one.php?id=" + id, function(data){
    // start html
    var read_one_ship_html=`
   
    <!-- when clicked, it will show the product's list -->
    <div id='read-products' class='btn btn-primary float-right  m-b-15px read-duty-button'>
    <span class='fas fa-list'></span> Show List
    </div>
    <!-- product data will be shown in this table -->
    <table class='table table-bordered table-hover'>
   
        <tr>
    <td class='w-30-pct'> Duty ID:</td>
    <td class='w-70-pct'>` + data.Duty_ID + `</td>
    </tr>

    <tr>
    <td class='w-30-pct'>Duty Description:</td>
    <td class='w-70-pct'>` + data.Duty_Description + `</td>
    </tr>
   
    <tr>
    <td>Rank ID:</td>
    <td>` + data.Rank_ID + `</td>
    </tr>
   
 
        
   
    </table>`;
    // inject html to 'page-content' of our app
    $("#page-content").html(read_one_duty_html);
   
    // chage page title
    changePageTitle("Duty Information");
    });
    });
   });