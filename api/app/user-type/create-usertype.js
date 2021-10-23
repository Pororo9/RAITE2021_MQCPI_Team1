$(document).ready(function(){
  
    autoTypeID();  
    $(document).on('click', '.create-type-button', function(){     
   
    var create_type_html=`
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
      <form id='create-type-form' action='#' method='post' border='0'>
         
            <div class='row'>
              <div class='col-md-6'>
                <div class='form-group'>
                  <label for='Type_ID'>User Type ID</label>
                  <input type='text' class='form-control' id='Type_ID' placeholder=''  value='` + typeID +`'>                  
                </div>                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->             
            </div>
            <!-- /.row -->


            <div class='row'>
            <div class='col-md-6'>
              <div class='form-group'>
                <label for='Type_Name'>User Type Name</label>
                <input type='text' class='form-control' id='Type_Name' placeholder='Enter User Type Name' name='Type_Name' required>                  
              </div>                
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class='col-md-6'>
              <div class='form-group'>
              <label for='Type_Description'>User Type Description</label>
              <input type='text' class='form-control' id='Type_Description' placeholder='Enter User Type Description' name='Type_Description' required>         
              </div>
              <!-- /.form-group -->             
            </div>
            <!-- /.col -->            
          </div>
          <!-- /.row -->

          <div class='form-group'>          
            <input type='text' class='form-control'  placeholder=''  value='` + typeID +`' name='Type_ID' hidden>                  
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
    `;
    // inject html to 'page-content' of our app
    $("#page-content").html(create_type_html);
   
    // chage page title
    changePageTitle("Create New User Type");    
    });

    // will run if create product form was submitted
    $(document).on('submit', '#create-type-form', function(){    
    var form_data=JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
    url: getUrl() + "users-type/create.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
    // product was created, go back to products list
    updateID();
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

   
   function autoTypeID(){
    strYear = new Date().getFullYear();  
    $.getJSON( getUrl() + "users-type/get-count.php", function(data){        
        getCount = data.Count;     
        updateCount = (parseInt(getCount)+1);
        len = parseInt(updateCount.toString().length);
     
        getYear = strYear.toString();
        if(len == 1){
            typeID="TYP-" +  "000" + updateCount + "-" + getYear.slice(-2);              
        }
        else if(len == 2){
           typeID="TYP-" +  "00" + updateCount + "-" + getYear.slice(-2);                
        }    
        else if(len == 3){
          typeID="TYP-" +  "0" + updateCount + "-" + getYear.slice(-2);                 
        }  
        else if(len == 4){
          typeID="TYP-" + updateCount + "-" + getYear.slice(-2);         
        }    
     });
   }

   function updateID(){
    $.ajax({
        url: getUrl() +  "users-type/update-count.php",
        type : "POST",
        dataType : 'json',
        data : JSON.stringify({ Count : updateCount }),
        success : function(result) {
            autoDeptID();       
        },
        error: function(xhr, resp, text) {
             console.log(xhr, resp, text);
        }
        });  
   }