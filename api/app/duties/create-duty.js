$(document).ready(function(){
  // show html form when 'create product' button was clicked

  //AUTO CODE
  autoDutyID();  

  $(document).on('click', '.create-duty-button', function(){     
      // load list of categories
  
       // build Duty option html
      $.getJSON(getUrl() + "duty/read.php", function(data){
      // loop through returned list of data
  

 
  // we have our html form here where product information will be entered
  // we used the 'required' html5 property to prevent empty fields
  var create_duty_html=`
  <div class='card-body'> 
  <div class='row'>
      <div class='col-md-6'>    
        <h4>Duty Information</h4>            
       </div>
    <!-- /.col -->          
    <div class='col-md-6'>
          <div class='form-group'>
              <!-- 'read products' button to show list of products -->
              <div id='read-duty' class='btn btn-primary float-right  m-b-15px read-duty-button'>
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
          <label for='Duty_ID'>Duty ID</label>
          <input type='text' class='form-control' id='Duty_ID' placeholder='Enter Duty ID' name='Duty_ID' required>                  
        </div>                
        <!-- /.form-group -->
      </div>

      <!-- /.col -->
      <div class='col-md-6'>
        <div class='form-group'>
        <label for='Duty_Description'>Duty Description</label>
        <input type='text' class='form-control' id='Duty_Description' placeholder='Enter Duty Description' name='Duty_Description' required>         
        </div>
        <!-- /.form-group -->             
      </div>
      <!-- /.col -->            
    </div>
    <!-- /.row -->

    <div class='row'>
    <div class='col-md-6'>
      <div class='form-group'>
        <label for='Rank_ID'>Rank ID</label>
        <input type='text' class='form-control' id='Rank_ID' placeholder='Enter Rank ID' name='Rank_ID' required>                  
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
  $("#page-content").html(create_duty_html);
 
  // chage page title
  changePageTitle("Create New Duty Info.");
  });
  }); 


  // will run if create product form was submitted
  $(document).on('submit', '#create-duty-form', function(){
  var form_data=JSON.stringify($(this).serializeObject());
  // submit form data to api
  $.ajax({
  url: getUrl() + "duty/create.php",
  type : "POST",
  contentType : 'application/json',
  data : form_data,
  success : function(result) {
  // product was created, go back to products list
  updateID();
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


 function autoDutyID(){
  strYear = new Date().getFullYear();  
  $.getJSON( getUrl() + "duty/get-count.php", function(data){        
      getCount = data.Count;     
      updateCount = (parseInt(getCount)+1);
      len = parseInt(updateCount.toString().length);
   
      getYear = strYear.toString();
      if(len == 1){
          empID="DUTY-" +  "000" + updateCount + "-" + getYear.slice(-2);              
      }
      else if(len == 2){
        empID="DUTY-" +  "00" + updateCount + "-" + getYear.slice(-2);                
      }    
      else if(len == 3){
        empID="DUTY-" +  "0" + updateCount + "-" + getYear.slice(-2);                 
      }  
      else if(len == 4){
        empID="DUTY-" + updateCount + "-" + getYear.slice(-2);         
      }      
   });
 }

 function updateID(){
  $.ajax({
      url: getUrl() +  "duty/update-count.php",
      type : "POST",
      dataType : 'json',
      data : JSON.stringify({ Count : updateCount }),
      success : function(result) {
        autoDutyID();       
      },
      error: function(xhr, resp, text) {
           console.log(xhr, resp, text);
      }
      });  
 }


