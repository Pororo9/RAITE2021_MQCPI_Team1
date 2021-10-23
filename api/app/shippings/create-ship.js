$(document).ready(function(){
  // show html form when 'create product' button was clicked

  //AUTO CODE
  autoShipID();  

  $(document).on('click', '.create-ship-button', function(){     
      // load list of categories
  
       // build Duty option html
      $.getJSON(getUrl() + "shipping/read.php", function(data){
      // loop through returned list of data
  

 
  // we have our html form here where product information will be entered
  // we used the 'required' html5 property to prevent empty fields
  var create_ship_html=`
  <div class='card-body'> 
  <div class='row'>
      <div class='col-md-6'>    
        <h4>Shipping Information</h4>            
       </div>
    <!-- /.col -->          
    <div class='col-md-6'>
          <div class='form-group'>
              <!-- 'read products' button to show list of products -->
              <div id='read-ship' class='btn btn-primary float-right  m-b-15px read-ship-button'>
              <span class='fas fa-list'></span> Show List
              </div>                 
          </div>                
          <!-- /.form-group -->
       </div>
    <!-- /.col -->     
  </div>
<!-- /.row -->
<!-- /.card-header -->
<form id='create-crew-form' action='#' method='post' border='0'>
        

      <div class='row'>
      <div class='col-md-6'>
        <div class='form-group'>
          <label for='Shipping_ID'>Shipping ID</label>
          <input type='text' class='form-control' id='Shipping_ID' placeholder='Enter Shipping ID' name='Shipping_ID' required>                  
        </div>                
        <!-- /.form-group -->
      </div>

      <!-- /.col -->
      <div class='col-md-6'>
        <div class='form-group'>
        <label for='Route_ID'>Route ID</label>
        <input type='text' class='form-control' id='Route_ID' placeholder='Enter Route ID' name='Route_ID' required>         
        </div>
        <!-- /.form-group -->             
      </div>
      <!-- /.col -->            
    </div>
    <!-- /.row -->

    <div class='row'>
    <div class='col-md-6'>
      <div class='form-group'>
        <label for='Shipping_Destination'>Shipping Destination</label>
        <input type='text' class='form-control' id='Shipping_Destination' placeholder='Enter Shipping Destination' name='Shipping_Destination' required>                  
      </div>                
      <!-- /.form-group -->
    </div>
    
    <div class='row'>
    <div class='col-md-6'>
      <div class='form-group'>
        <label for='Shipping_Recipient'>Shipping Recipient</label>
        <input type='text' class='form-control' id='Shipping_Recipient' placeholder='Enter Shipping Recipient' name='Shipping_Recipient' required>                  
      </div>                
      <!-- /.form-group -->
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
  $("#page-content").html(create_ship_html);
 
  // chage page title
  changePageTitle("Create New Shipping Info.");
  });
  }); 


  // will run if create product form was submitted
  $(document).on('submit', '#create-ship-form', function(){
  var form_data=JSON.stringify($(this).serializeObject());
  // submit form data to api
  $.ajax({
  url: getUrl() + "shipping/create.php",
  type : "POST",
  contentType : 'application/json',
  data : form_data,
  success : function(result) {
  // product was created, go back to products list
  updateID();
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


 function autoShipID(){
  strYear = new Date().getFullYear();  
  $.getJSON( getUrl() + "shipping/get-count.php", function(data){        
      getCount = data.Count;     
      updateCount = (parseInt(getCount)+1);
      len = parseInt(updateCount.toString().length);
   
      getYear = strYear.toString();
      if(len == 1){
          empID="SHP-" +  "000" + updateCount + "-" + getYear.slice(-2);              
      }
      else if(len == 2){
        empID="SHP-" +  "00" + updateCount + "-" + getYear.slice(-2);                
      }    
      else if(len == 3){
        empID="SHP-" +  "0" + updateCount + "-" + getYear.slice(-2);                 
      }  
      else if(len == 4){
        empID="SHP-" + updateCount + "-" + getYear.slice(-2);         
      }      
   });
 }

 function updateID(){
  $.ajax({
      url: getUrl() +  "shipping/update-count.php",
      type : "POST",
      dataType : 'json',
      data : JSON.stringify({ Count : updateCount }),
      success : function(result) {
        autoShipID();       
      },
      error: function(xhr, resp, text) {
           console.log(xhr, resp, text);
      }
      });  
 }


