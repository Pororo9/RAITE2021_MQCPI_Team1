$(document).ready(function(){
    // handle 'read one' button click
    $(document).on('click', '.read-one-users-button', function(){
    // product ID will be here
    // get product id
    var id = $(this).attr('data-id');
    // read product record based on given ID
    $.getJSON( getUrl() + "users/read-one.php?id=" + id, function(data){
    // start html
    var read_one_user_html=`
   
    <!-- when clicked, it will show the product's list -->
    <div id='read-products' class='btn btn-primary float-right  m-b-15px read-users-button'>
    <span class='fas fa-list'></span> Show List
    </div>
    <!-- product data will be shown in this table -->
    <table id='example2' class='table table-bordered table-hover'>
   
        <tr>
    <td class='w-30-pct'>User ID:</td>
    <td class='w-70-pct'>` + data.User_ID + `</td>
    </tr>

    <tr>
    <td class='w-30-pct'>Last Name:</td>
    <td class='w-70-pct'>` + data.Last_Name + `</td>
    </tr>
   
    <tr>
    <td>First Name:</td>
    <td>` + data.First_Name + `</td>
    </tr>
   
    
    <tr>
    <td>Middle Name:</td>
    <td>` + data.Middle_Name + `</td>
    </tr>
   
  
    <tr>
    <td>Gender:</td>
    <td>` + data.Gender + `</td>
    </tr>

    
    <tr>
    <td>Email Address:</td>
    <td>` + data.Email_Address + `</td>
    </tr>

    <tr>
    <td>User Name:</td>
    <td>` + data.User_Name + `</td>
    </tr>

    <tr>
    <td>User Type:</td>
    <td>` + data.Type_Name + `</td>
    </tr>

   
    </table>`;
    // inject html to 'page-content' of our app
    $("#page-content").html(read_one_user_html);
   
    // chage page title
    changePageTitle("User Information");
    });
    });
   });