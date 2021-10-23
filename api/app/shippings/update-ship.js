$(document).ready(function(){
    // show html form when 'update product' button was clicked
    $(document).on('click', '.update-ship-button', function(){
   
    // get product id
    var id = $(this).attr('data-id');
    // read one record based on given product id
    $.getJSON(getUrl() +  "shipping/read-one.php?id=" + id, function(data){
   
    // values will be used to fill out our form
    var ShipID = data.Shipping_ID;
    var RouteID = data.Route_ID;
    var ShipDesc = data.Shipping_Description;
    var ShipRec = data.Shipping_Recipient;
 
    // store 'update product' html to this variable
    var update_ship_html=`   
    <div class='card-body'> 
    <div class='row'>
        <div class='col-md-6'>                
         </div>
      <!-- /.col -->          
      <div class='col-md-6'>
            <div class='form-group'>
                <!-- 'read products' button to show list of products -->
                <div id='read-products' class='btn btn-primary float-right  m-b-15px read-ship-button'>
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
              <label for='Shipping_ID'>Shipping ID</label>
              <input type='text' class='form-control' id='Shipping_ID' placeholder=''  value='` + ShipID +`'>                  
            </div>                
            <!-- /.form-group -->
          </div>
          <!-- /.col -->             
        </div>
        <!-- /.row -->


        <div class='row'>
        <div class='col-md-6'>
          <div class='form-group'>
            <label for='Route_ID'>Route ID</label>
            <input type='text' class='form-control' id='Route_ID' placeholder='Enter Route ID' name='Route_ID' value='` + RouteID +`' required>                  
          </div>                
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class='col-md-6'>
          <div class='form-group'>
          <label for='Shipping_Description'>Shipping Description</label>
          <input type='text' class='form-control' id='Shipping_Description' placeholder='Enter Shipping Description' name='Shipping_Description' value='` + ShipDesc +`' required>         
          </div>
          <!-- /.form-group -->             
        </div>
        <!-- /.col -->            
      </div>
      <!-- /.row -->

      <!-- /.col -->
      <div class='col-md-6'>
        <div class='form-group'>
        <label for='Shipping_Recipient'>Shipping Recipient</label>
        <input type='text' class='form-control' id='Shipping_Recipient' placeholder='Enter Shipping Description' name='Shipping_Recipient' value='` + ShipRec +`' required>         
        </div>
        <!-- /.form-group -->             
      </div>
      <!-- /.col -->            
    </div>

      <div class='form-group'>          
        <input type='text' class='form-control'  placeholder=''  value='` + ShipID +`' name='Shipping_ID' hidden>                  
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
    $("#page-content").html(update_ship_html);
    
    // chage page title
    changePageTitle("Update Shipping Information");
         
    });
    });
 
    // will run if 'create product' form was submitted
    $(document).on('submit', '#update-ship-form', function(){
   
    // get form data
    var form_data=JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
    url: getUrl() + "shipping/update.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
    // product was created, go back to products list
    showShipList();
    },
    error: function(xhr, resp, text) {
    // show error to console
    console.log(xhr, resp, text);
    }
    });
   
    return false;
    });
   });