$(document).ready(function(){
    // handle 'read one' button click
    $(document).on('click', '.read-one-ship-button', function(){
    // product ID will be here
    // get product id
    var id = $(this).attr('data-id');
    // read product record based on given ID
    $.getJSON( getUrl() + "shipping/read-one.php?id=" + id, function(data){
    // start html
    var read_one_ship_html=`
   
    <!-- when clicked, it will show the product's list -->
    <div id='read-products' class='btn btn-primary float-right  m-b-15px read-ship-button'>
    <span class='fas fa-list'></span> Show List
    </div>
    <!-- product data will be shown in this table -->
    <table class='table table-bordered table-hover'>
   
        <tr>
    <td class='w-30-pct'> Shipping ID:</td>
    <td class='w-70-pct'>` + data.Shipping_ID + `</td>
    </tr>

    <tr>
    <td class='w-30-pct'>Route ID:</td>
    <td class='w-70-pct'>` + data.Route_ID + `</td>
    </tr>
   
    <tr>
    <td>Shipping Destination:</td>
    <td>` + data.Shipping_Destination + `</td>
    </tr>
   
    
    <tr>
    <td>Shipping Recipient:</td>
    <td>` + data.Shipping_Recipient + `</td>
    </tr>
        
   
    </table>`;
    // inject html to 'page-content' of our app
    $("#page-content").html(read_one_ship_html);
   
    // chage page title
    changePageTitle("Shipping Information");
    });
    });
   });