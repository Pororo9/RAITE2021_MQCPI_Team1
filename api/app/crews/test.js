$(document).ready(function(){
    // show html form when 'create product' button was clicked

    //AUTO CODE
    autoCrewID();  

    $(document).on('click', '.create-crew-button', function(){     
        // load list of categories
    
         // build Duty option html
        $.getJSON(getUrl() + "duty/read.php", function(data){
        // loop through returned list of data
    
         // build Rank option html
        $.getJSON(getUrl() + "rank/read.php", function(data){
          
            // loop through returned list of data
            var rank_options_html=`<select name='Rank_ID' class='form-control' required>`;
            rank_options_html+=`<option value='Select One' disabled='disabled' selected='true'>Select One</option>`
            $.each(data.records, function(key, val){
              rank_options_html+=`<option value='` + val.Rank_ID + `'>` + val.Rank_Name + `</option>`;
            });
            rank_options_html+=`</select>`;

   
    // we have our html form here where product information will be entered
    // we used the 'required' html5 property to prevent empty fields
    var create_crew_html=`
    <div class='card-body'> 
    <div class='row'>
        <div class='col-md-6'>    
          <h4>Personal Information</h4>            
         </div>
      <!-- /.col -->          
      <div class='col-md-6'>
            <div class='form-group'>
                <!-- 'read products' button to show list of products -->
                <div id='read-products' class='btn btn-primary float-right  m-b-15px read-emp-button'>
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

      <div class='row'>
      <div class='col-md-6'>
        <div class='form-group'>
          <label for='Middle_Name'>Middle Name</label>
          <input type='text' class='form-control' id='Middle_Name' placeholder='Enter Middle Name' name='Middle_Name' required>                  
        </div>                
        <!-- /.form-group -->
      </div>
      

    <div class='row'>
      <div class='col-md-6'>
        <div class='form-group'>
          <label for='Birthday'>Date of Birth</label>
          <input type='date' class='form-control' id='Birthday' placeholder='Select Birthday' name='Birthday' required>                  
        </div>                
        <!-- /.form-group -->
      </div>

      <!-- /.col -->
      <div class='col-md-6'>
        <div class='form-group'>
        <label>Age</label>
        <select class="form-control select2" style="width: 100%;" name='Age'>
        <option selected="selected" disabled='disabled'>Select One</option>
        <option>22</option>
        <option>23</option>  
        <option>24</option>
        <option>25</option> 
        <option>26</option>  
        <option>27</option>
        <option>28</option>  
        <option>29</option>
        <option>30</option>
        </select>
        </div>
        <!-- /.form-group -->             
      </div>
      <!-- /.col -->            
    </div>
    <!-- /.row -->

  
<div class='row'>
      <div class='col-md-6'>
        <div class='form-group'>
          <label for='Home_Address'>Home Address</label>
          <input type='email' class='form-control' id='Home_Address' placeholder='Enter Home Address' name='Home_Address' required>                  
        </div>                
        <!-- /.form-group -->
      </div>
    

    <div class='row'>
    <div class='col-md-6'>
      <div class='form-group'>
        <h4>Contact Information</h4>
      </div>                
      <!-- /.form-group -->
    </div>
    <!-- /.col -->
   
  <div class='row'>
    <div class='col-md-6'>
      <div class='form-group'>
        <h4>In Case of Emergency</h4>
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

  <div class='row'>
        <div class='col-md-6'>
          <div class='form-group'>
            <label for='In_Case_Last_Name'>Last Name</label>
            <input type='text' class='form-control' id='In_Case_Last_Name' placeholder='Enter Last Name' name='In_Case_Last_Name' required>                  
          </div>                
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
        <div class='col-md-6'>
          <div class='form-group'>
          <label for='In_Case_First_Name'>First Name</label>
          <input type='text' class='form-control' id='In_Case_First_Name' placeholder='Enter First Name' name='In_Case_First_Name' required>         
          </div>
          <!-- /.form-group -->             
        </div>
        <!-- /.col -->            
      </div>
      <!-- /.row -->

      <div class='row'>
      <div class='col-md-6'>
        <div class='form-group'>
          <label for='In_Case_Middle_Name'>Middle Name</label>
          <input type='text' class='form-control' id='In_Case_Middle_Name' placeholder='Enter Middle Name' name='In_Case_Middle_Name' required>                  
        </div>                
        <!-- /.form-group -->
      </div>
      <!-- /.col -->
      <div class='col-md-6'>
        <div class='form-group'>
        <label for='In_Case_Relationship'>Relationship</label>
        <input type='text' class='form-control' id='In_Case_Relationship' placeholder='Enter Relationship' name='In_Case_Relationship' required>    
        </div>
        <!-- /.form-group -->             
      </div>
      <!-- /.col -->            
    </div>
    <!-- /.row -->

    <div class='row'>
    <div class='col-md-6'>
      <div class='form-group'>
        <label for='In_Case_Mobile_No'>Mobile No</label>
        <input type='text' class='form-control' id='In_Case_Mobile_No' placeholder='Enter Mobile No' name='In_Case_Mobile_No' required>                  
      </div>                
      <!-- /.form-group -->
    </div>
   
    <div class='row'>
    <div class='col-md-6'>
      <div class='form-group'>
        <label for='Mobile_Number'>Mobile Number</label>
        <input type='text' class='form-control' id='Mobile_Number' placeholder='Enter Mobile No' name='Mobile_Number' required>                  
      </div>                
      <!-- /.form-group -->
    </div>
      
      
    <!-- /.col -->
    <div class='col-md-6'>
      <div class='form-group'>
      <label>Position Name</label>
      ` + position_options_html + `  
      </div>
      <!-- /.form-group -->             
    </div>
    <!-- /.col -->            
  </div>
  <!-- /.row -->
                       
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
    $("#page-content").html(create_crew_html);
   
    // chage page title
    changePageTitle("Create New Crew");
    });
    }); 
    });

    // will run if create product form was submitted
    $(document).on('submit', '#create-crew-form', function(){
    var form_data=JSON.stringify($(this).serializeObject());
    // submit form data to api
    $.ajax({
    url: getUrl() + "crew/create.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
    // product was created, go back to products list
    updateID();
    showCrewList();
    },
    error: function(xhr, resp, text) {
    // show error to console
    console.log(xhr, resp, text);
    }
    });
   
    return false;
    });
   });


   function autoCrewID(){
    strYear = new Date().getFullYear();  
    $.getJSON( getUrl() + "crew/get-count.php", function(data){        
        getCount = data.Count;     
        updateCount = (parseInt(getCount)+1);
        len = parseInt(updateCount.toString().length);
     
        getYear = strYear.toString();
        if(len == 1){
            empID="CRW-" +  "000" + updateCount + "-" + getYear.slice(-2);              
        }
        else if(len == 2){
          empID="CRW-" +  "00" + updateCount + "-" + getYear.slice(-2);                
        }    
        else if(len == 3){
          empID="CRW-" +  "0" + updateCount + "-" + getYear.slice(-2);                 
        }  
        else if(len == 4){
          empID="CRW-" + updateCount + "-" + getYear.slice(-2);         
        }      
     });
   }

   function updateID(){
    $.ajax({
        url: getUrl() +  "crew/update-count.php",
        type : "POST",
        dataType : 'json',
        data : JSON.stringify({ Count : updateCount }),
        success : function(result) {
            autoCrewID();       
        },
        error: function(xhr, resp, text) {
             console.log(xhr, resp, text);
        }
        });  
   }


  