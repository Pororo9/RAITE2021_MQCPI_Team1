$(document).ready(function(){
    // show html form when 'update product' button was clicked
    $(document).on('click', '.update-type-button', function(){
   
    // get product id
    var id = $(this).attr('data-id');
    // read one record based on given product id
    $.getJSON(getUrl() +  "users-type/read-one.php?id=" + id, function(data){
   
    // values will be used to fill out our form
    var type_id = data.Type_ID;
    var type_name = data.Type_Name;
    var type_desc = data.Type_Description;
       
   
    // store 'update product' html to this variable
    var update_dept_html=`  
    <div class='card-body'> 
    <div class='row'>
        <div class='col-md-6'>                
         </div>
      <!-- /.col -->          
      <div class='col-md-6'>
            <div class='form-group'>
                <!-- 'read products' button to show list of products -->
                <div id='read-products' class='btn btn-primary float-right  m-b-15px read-type-button'>
                <span class='fas fa-list'></span> Show List
                </div>                 
            </div>                
            <!-- /.form-group -->
         </div>
      <!-- /.col -->     
    </div>
<!-- /.row -->
    <!-- /.card-header -->
    <form id='update-type-form' action='#' method='post' border='0'>        
          <div class='row'>
            <div class='col-md-6'>
              <div class='form-group'>
                <label for='Type_ID'>User Type ID</label>
                <input type='text' class='form-control' id='Type_ID' placeholder=''  value='` + type_id +`'>                  
              </div>                
              <!-- /.form-group -->
            </div>
            <!-- /.col -->             
          </div>
          <!-- /.row -->


          <div class='row'>
          <div class='col-md-6'>
            <div class='form-group'>
              <label for='Type_ID'>User Type Name</label>
              <input type='text' class='form-control' id='Type_Name1' placeholder='Enter User Type Name' value='` + type_name +`' name='Type_Name' required>                  
            </div>                
            <!-- /.form-group -->
          </div>
          <!-- /.col -->
          <div class='col-md-6'>
            <div class='form-group'>
            <label for='Type_Description'>User Type Description</label>
            <input type='text' class='form-control' id='Type_Description' placeholder='Enter User Type Description' value='` + type_desc +`' name='Type_Description' required>         
            </div>
            <!-- /.form-group -->             
          </div>
          <!-- /.col -->            
        </div>
        <!-- /.row -->

        <div class='form-group'>          
          <input type='text' class='form-control'  placeholder=''  value='` + type_id +`' name='Type_ID' hidden>                  
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
    `;
    // inject html to 'page-content' of our app
    $("#page-content").html(update_dept_html);
    
    // chage page title
    changePageTitle("Update Department Information");
         
    });
    });
   
    // will run if 'create product' form was submitted
    $(document).on('submit', '#update-type-form', function(){
   
    // get form data
    var form_data=JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
    url: getUrl() + "users-type/update.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {        
    // product was created, go back to products list
    showTypeList();
    },
    error: function(xhr, resp, text) {
    // show error to console
    console.log(xhr, resp, text);
    }
    });
   
    return false;
    });
   });