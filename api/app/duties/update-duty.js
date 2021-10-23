$(document).ready(function(){
    // show html form when 'update product' button was clicked
    $(document).on('click', '.update-duty-button', function(){
   
    // get product id
    var id = $(this).attr('data-id');
    // read one record based on given product id
    $.getJSON(getUrl() +  "duty/read-one.php?id=" + id, function(data){
   
    // values will be used to fill out our form
    var DutyID = data.Duty_ID;
    var DutyDesc = data.Duty_Description;
    var RankID = data.Rank_ID;
 
    // store 'update product' html to this variable
    var update_duty_html=`   
    <div class='card-body'> 
    <div class='row'>
        <div class='col-md-6'>                
         </div>
      <!-- /.col -->          
      <div class='col-md-6'>
            <div class='form-group'>
                <!-- 'read products' button to show list of products -->
                <div id='read-products' class='btn btn-primary float-right  m-b-15px read-duty-button'>
                <span class='fas fa-list'></span> Show List
                </div>                 
            </div>                
            <!-- /.form-group -->
         </div>
      <!-- /.col -->     
    </div>
<!-- /.row -->
<!-- /.card-header -->
  <form id='update-post-form' action='#' method='post' border='0'>
     
        <div class='row'>
          <div class='col-md-6'>
            <div class='form-group'>
              <label for='Duty_ID'>Duty ID</label>
              <input type='text' class='form-control' id='Duty_ID' placeholder=''  value='` + DutyID+`'>                  
            </div>                
            <!-- /.form-group -->
          </div>
          <!-- /.col -->             
        </div>
        <!-- /.row -->

        <!-- /.col -->
        <div class='col-md-6'>
          <div class='form-group'>
          <label for='Duty_Description'>Duty Description</label>
          <input type='text' class='form-control' id='Duty_Description' placeholder='Enter Duty Description' name='Duty_Description' value='` + DutyDesc +`' required>         
          </div>
          <!-- /.form-group -->             
        </div>
        <!-- /.col -->            
      </div>
      <!-- /.row -->

      <!-- /.col -->
      <div class='col-md-6'>
        <div class='form-group'>
        <label for='Rank_ID'>Rank ID</label>
        <input type='text' class='form-control' id='Rank_ID' placeholder='Enter Rank ID' name='Rank_ID' value='` + RankID +`' required>         
        </div>
        <!-- /.form-group -->             
      </div>
      <!-- /.col -->            
    </div>

      <div class='form-group'>          
        <input type='text' class='form-control'  placeholder=''  value='` + DutyID +`' name='Duty_ID' hidden>                  
      </div>       
      
      

      <div class='row'>          
      <div class='col-md-6'>
        <div class='form-group'>
        <button type='submit' class='btn btn-primary'>
        <span class='fas fa-save'></span> Update Record
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
    $("#page-content").html(update_duty_html);
    
    // chage page title
    changePageTitle("Update Duty Information");
         
    });
    });
 
    // will run if 'create product' form was submitted
    $(document).on('submit', '#update-duty-form', function(){
   
    // get form data
    var form_data=JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
    url: getUrl() + "duty/update.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
    // product was created, go back to products list
    showDutyList();
    },
    error: function(xhr, resp, text) {
    // show error to console
    console.log(xhr, resp, text);
    }
    });
   
    return false;
    });
   });