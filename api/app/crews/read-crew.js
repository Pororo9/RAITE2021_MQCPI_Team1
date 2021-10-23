$(document).ready(function(){
    // show list of product on first load      
    showCrewList();
    $(document).on('click', '.read-crew-button', function(){   
        showCrewList();
    });
});
   
   function showCrewList(){      
       read_crew_html=`  
       <div class='row'>
            <div class='col-md-6'>                
             </div>
          <!-- /.col -->          
          <div class='col-md-6'>
                <div class='form-group'>
                    <!-- 'read products' button to show list of products -->
                    <div id='read-crew' class='btn btn-primary float-right  m-b-15px create-crew-button'>
                    <span class='fas fa-plus'></span> New Record
                    </div>                 
                </div>                
                <!-- /.form-group -->
             </div>
          <!-- /.col -->     
        </div>
        <br>
       
  <!-- /.row -->                
        <table id='example1' class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>Crew ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>

            <th>Birthday</th>
            <th>Age</th>
            <th>Email Address</th>

            <th>Home Address</th>
            <th>In Case Last Name</th>
            <th>In Case First Name</th>
            <th>In Case Middle Name</th>
            <th>Mobile Number</th>
            <th>Rank ID</th>
            <th style='text-align:center'>Action</th>           
            </tr>
            </thead>
            <tbody>
       `;
     
    // get list of products from the API
    $.getJSON(getUrl() + "crew/read-all.php", function(data){              
    // loop through returned list of data
    $.each(data.records, function(key, val) {  
          
    // creating new table row per record
    read_crew_html+=`
    <tr>
        <td>` + val.Crew_ID + `</td>
        <td>` + val.Last_Name + `</td>
        <td>` + val.First_Name + `</td>
        <td>` + val.Middle_Name + `</td>
        <td>` + val.Birthday + `</td>
        <td>` + val.Age + `</td>
        <td>` + val.Email_Address + `</td>
        <td>` + val.Home_Address + `</td>
        <td>` + val.In_Case_LastName + `</td>
        <td>` + val.In_Case_FirstName + `</td>  
        <td>` + val.In_Case_MiddleName + `</td>
        <td>` + val.In_Case_Relationship + `</td>  
        <td>` + val.Mobile_Number + `</td>  
        <td>` + val.Rank_ID + `</td>             

        <!-- 'action' buttons -->
        <td style='text-align:center'>
            <!-- read product button -->
            <button class='btn btn-primary m-r-10px read-one-emp-button' data-id='` + val.Crew_ID + `'>
                <span class='glyphicon glyphicon-eye-open'></span> Read
            </button>

            <!-- edit button -->
            <button class='btn btn-info m-r-10px update-emp-button' data-id='` + val.Crew_ID + `'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </button>

            <!-- delete button -->
            <button class='btn btn-danger delete-emp-button' data-id='` + val.Crew_ID + `'>
                <span class='glyphicon glyphicon-remove'></span> Delete
            </button>
        </td>

    </tr>`;
    });

    read_crew_html+=`
    </tbody>
    <tfoot>
    <tr>
    <th>Crew ID</th>
    <th>Last Name</th>
    <th>First Name</th>
    <th>Middle Name</th>
    <th>Home Address</th>
    <th>Mobile Number</th>
    <th>Rank ID</th>
    <th>Duty ID</th>
    <th style='text-align:center'>Action</th>          
    </tr>
    </tfoot>
  </table> 
    `;
    
    // inject to 'page-content' of our app
    
    $("#page-content").html(read_crew_html);    
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // chage page title
    changePageTitle("Employee List");    
        
});
 
}