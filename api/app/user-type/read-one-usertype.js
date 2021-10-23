$(document).ready(function(){
    // handle 'read one' button click
    $(document).on('click', '.read-one-type-button', function(){
    // product ID will be here
    // get product id
    var id = $(this).attr('data-id');
    // read product record based on given ID
    $.getJSON( getUrl() + "users-type/read-one.php?id=" + id, function(data){
    // start html
    var read_one_type_html=`
   
    <!-- when clicked, it will show the product's list -->
    <div id='read-products' class='btn btn-primary float-right  m-b-15px read-type-button'>
    <span class='fas fa-list'></span> Show List
    </div>
    <!-- product data will be shown in this table -->
    <table class='table table-bordered table-hover'>
   
        <tr>
    <td class='w-30-pct'>User Type ID:</td>
    <td class='w-70-pct'>` + data.Type_ID + `</td>
    </tr>

    <tr>
    <td class='w-30-pct'>User Type Name:</td>
    <td class='w-70-pct'>` + data.Type_Name + `</td>
    </tr>
   
    <tr>
    <td>User Type Description:</td>
    <td>` + data.Type_Description + `</td>
    </tr>
       
   
    </table>`;
    // inject html to 'page-content' of our app
    $("#page-content").html(read_one_type_html);
   
    // chage page title
    changePageTitle("User Type Information");
    });
    });
   });