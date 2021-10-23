$(document).ready(function(){
    // show html form when 'update product' button was clicked
    $(document).on('click', '.update-users-button', function(){
   
    // get product id
    var id = $(this).attr('data-id');
    // read one record based on given product id
    $.getJSON(getUrl() +  "users/read-one.php?id=" + id, function(data){
   
    // values will be used to fill out our form
    var user_id = data.User_ID;
    var lname = data.Last_Name;
    var fname = data.First_Name;
    var mname = data.Middle_Name;
    var gender = data.Gender;
    var email = data.Email_Address;
    var user_name = data.User_Name;
    var type_id = data.Type_ID;
    var type_name = data.Type_Name;
   
    
    // load list of categories
    $.getJSON( getUrl() +  "users-type/read.php", function(data){
   
    // build 'categories option' html
    // loop through returned list of data
    var usertype_options_html=`<select name='Type_ID' class='form-control'>`;
   
    $.each(data.records, function(key, val){
    // pre-select option is category id is the same
    if(val.Type_ID==type_id){ 
        usertype_options_html+=`<option value='` + val.Type_ID + `' selected>` + val.Type_Name + `</option>`; 
    }   
     else{       
        usertype_options_html+=`<option value='` + val.Type_ID + `'>` + val.Type_Name + `</option>`;
    }
    });
    usertype_options_html+=`</select>`;
   
    // store 'update product' html to this variable
    var update_user_html=`  
    <div class='card-body'> 
    <div class='row'>
        <div class='col-md-6'>                
         </div>
      <!-- /.col -->          
      <div class='col-md-6'>
            <div class='form-group'>
                <!-- 'read products' button to show list of products -->
                <div id='read-products' class='btn btn-primary float-right  m-b-15px read-users-button'>
                <span class='fas fa-list'></span> Show List
                </div>                 
            </div>                
            <!-- /.form-group -->
         </div>
      <!-- /.col -->     
    </div>
<!-- /.row -->
 <!-- /.card-header -->
  <form id='update-users-form' action='#' method='post' border='0'>     
        <!--1ST ROW-->    
        <div class='row'>
          <div class='col-md-6'>
            <div class='form-group'>
              <label for='User_ID'>User ID</label>
              <input type='text' class='form-control' id='User_ID' placeholder=''  value='` + user_id +`'>                  
            </div>                
            <!-- /.form-group -->
          </div>
          <!-- /.col -->             
        </div>
        <!-- /.row -->

        <!--2ND ROW-->
        <div class='row'>
        <div class='col-md-6'>
          <div class='form-group'>
            <label for='Last_Name'>Last Name</label>
            <input type='text' class='form-control' id='Last_Name' placeholder='Enter Last Name' name='Last_Name' value='` + lname +`' required>                  
          </div>                
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class='col-md-6'>
          <div class='form-group'>
          <label for='First_Name'>First Name</label>
          <input type='text' class='form-control' id='First_Name' placeholder='Enter First Name' name='First_Name' value='` + fname +`' required>         
          </div>
          <!-- /.form-group -->             
        </div>
        <!-- /.col -->            
      </div>
      <!-- /.row -->

      <!--3RD ROW-->
      <div class='row'>
      <div class='col-md-6'>
        <div class='form-group'>
          <label for='Middle_Name'>Middle Name</label>
          <input type='text' class='form-control' id='Middle_Name' placeholder='Enter Middle Name' name='Middle_Name' value='` + mname +`' required>                  
        </div>                
        <!-- /.form-group -->
      </div>
      <!-- /.col -->
      <div class='col-md-6'>
        <div class='form-group'>
        <label>Gender</label>
            <select class='form-control select2' style='width: 100%;' name='Gender'>
            <option selected='selected' value='` + gender +`'>` + gender +`</option>
            <option value='Male'>Male</option>
            <option value='Female'>Female</option>               
      </select>
        </div>
        <!-- /.form-group -->             
      </div>
      <!-- /.col -->            
    </div>
    <!-- /.row -->

    <!--4TH ROW-->
    <div class='row'>
    <div class='col-md-6'>
      <div class='form-group'>
      <label for='Email_Address'>Email address</label>
      <input type='email' class='form-control' id='Email_Address' placeholder='Enter email address' name='Email_Address' value='` + email +`'>                 
      </div>                
      <!-- /.form-group -->
    </div>
    <!-- /.col -->
    <div class='col-md-6'>
      <div class='form-group'>
      <label for='User_Name'>User Name</label>
      <input type='text' class='form-control' id='User_Name1' placeholder='Enter User Name' name='User_Name' value='` + user_name +`' required>   
      </div>
      <!-- /.form-group -->             
    </div>
    <!-- /.col -->            
  </div>
  <!-- /.row -->


    <!--5th ROW-->
    <div class='row'>
    <div class='col-md-6'>
    <div class='form-group'>
    <label>User Type</label>
        ` + usertype_options_html + `               
    </div>                
    <!-- /.form-group -->
    </div>
    <!-- /.col -->
    <div class='col-md-6'>
    <div class='form-group'>              
   
    </div>
    <!-- /.form-group -->             
    </div>
    <!-- /.col -->            
    </div>
    <!-- /.row -->


    <div class='form-group'>          
    <input type='text' class='form-control'  placeholder=''  value='` + user_id +`' name='User_ID' hidden>                  
    </div>    
    
    <div class='form-group'>          
    <input type='text' class='form-control'  placeholder=''  value='default' name='Password' hidden>                  
    </div>    
      

      <div class='row'>          
      <div class='col-md-6'>
        <div class='form-group'>
        <button type='submit' class='btn btn-primary'>
        <span class='fas fa-edit'></span> Update Record
      </button>        
        </div>
        <!-- /.form-group -->             
      </div>
      <!-- /.col -->            
    </div>
    <!-- /.row -->       
  </form>   
</div>
    `;
    // inject html to 'page-content' of our app
    $("#page-content").html(update_user_html);
    
    // chage page title
    changePageTitle("Update User Information");
   
    });
    });
    });
   
    // will run if 'create product' form was submitted
    $(document).on('submit', '#update-users-form', function(){
   
    // get form data
    var form_data=JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
    url: getUrl() + "users/update.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {    
    // product was created, go back to products list
    showUserList();
    },
    error: function(xhr, resp, text) {
    // show error to console
    console.log(xhr, resp, text);
    }
    });
   
    return false;
    });
   });