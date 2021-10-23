$(document).ready(function(){
    // show html form when 'create product' button was clicked
    autoUserID();  
    $(document).on('click', '.create-users-button', function(){     
    // load list of categories
    $.getJSON(getUrl() + "users-type/read.php", function(data){
    // build categories option html
    // loop through returned list of data
    var usertype_options_html=`<select name='Type_ID' class='form-control'>`;
    usertype_options_html+=`<option value='Select One' disabled='disabled' selected='true'>Select One</option>`
    $.each(data.records, function(key, val){
        usertype_options_html+=`<option value='` + val.Type_ID + `'>` + val.Type_Name + `</option>`;
    });
    usertype_options_html+=`</select>`;
   
    // we have our html form here where product information will be entered
    // we used the 'required' html5 property to prevent empty fields
    var create_user_html=`      
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
      <form id='create-users-form' action='#' method='post' border='0'>     
            <!--1ST ROW-->    
            <div class='row'>
              <div class='col-md-6'>
                <div class='form-group'>
                  <label for='User_ID'>User ID</label>
                  <input type='text' class='form-control' id='User_ID' placeholder=''  value='` + userID +`'>                  
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
                <input type='text' class='form-control' id='Last_Name' placeholder='Enter Last Name' name='Last_Name' required>                  
              </div>                
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class='col-md-6'>
              <div class='form-group'>
              <label for='First_Name'>First Name</label>
              <input type='text' class='form-control' id='First_Name' placeholder='Enter First Name' name='First_Name' required>         
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
              <input type='text' class='form-control' id='Middle_Name' placeholder='Enter Middle Name' name='Middle_Name' required>                  
            </div>                
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class='col-md-6'>
            <div class='form-group'>
                <label>Gender</label>
                <select class="form-control select2" style="width: 100%;" name='Gender'>
                <option selected="selected" disabled='disabled'>Select One</option>
                <option>Male</option>
                <option>Female</option>               
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
          <label for="Email_Address">Email address</label>
          <input type="email" class="form-control" id="Email_Address" placeholder="Enter email address" name='Email_Address'>                 
          </div>                
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class='col-md-6'>
          <div class='form-group'>
          <label for='User_Name'>User Name</label>
          <input type='text' class='form-control' id='User_Name' placeholder='Enter User Name' name='User_Name' required>   
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
        <input type='text' class='form-control'  placeholder=''  value='` + userID +`' name='User_ID' hidden>                  
        </div>    
        
        <div class='form-group'>          
        <input type='text' class='form-control'  placeholder=''  value='default' name='Password' hidden>                  
        </div>    
          

          <div class='row'>          
          <div class='col-md-6'>
            <div class='form-group'>
            <button type='submit' class='btn btn-primary'>
            <span class='fas fa-save'></span> Save Record
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
    $("#page-content").html(create_user_html);
   
    // chage page title
    changePageTitle("Create New User");
    });
    });

    // will run if create product form was submitted
    $(document).on('submit', '#create-users-form', function(){
    var form_data=JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
    url: getUrl() + "users/create.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
    // product was created, go back to products list
    updateID();
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

   $(document).on('focusout', '#Email_Address', function(){
        document.getElementById("User_Name").value = document.getElementById("Email_Address").value;
   });


   function autoUserID(){
    strYear = new Date().getFullYear();  
    $.getJSON( getUrl() + "users/get-count.php", function(data){        
        getCount = data.Count;     
        updateCount = (parseInt(getCount)+1);
        len = parseInt(updateCount.toString().length);
     
        getYear = strYear.toString();
        if(len == 1){
            userID="USR-" +  "000" + updateCount + "-" + getYear.slice(-2);              
        }
        else if(len == 2){
          userID="USR-" +  "00" + updateCount + "-" + getYear.slice(-2);                
        }    
        else if(len == 3){
          userID="USR-" +  "0" + updateCount + "-" + getYear.slice(-2);                 
        }  
        else if(len == 4){
          userID="USR-" + updateCount + "-" + getYear.slice(-2);         
        }     
     });
   }

   function updateID(){
    $.ajax({
        url: getUrl() +  "users/update-count.php",
        type : "POST",
        dataType : 'json',
        data : JSON.stringify({ Count : updateCount }),
        success : function(result) {
            autoUserID();       
        },
        error: function(xhr, resp, text) {
             console.log(xhr, resp, text);
        }
        });  
   }


  