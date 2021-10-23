$(document).ready(function(){
    // show list of product on first load      
    showUserList();
    $(document).on('click', '.read-users-button', function(){   
        showUserList();
    });
});
   
   function showUserList(){      
       read_user_html=`  
       <div class='row'>
            <div class='col-md-6'>                
             </div>
          <!-- /.col -->          
          <div class='col-md-6'>
                <div class='form-group'>
                    <!-- 'read products' button to show list of products -->
                    <div id='read-products' class='btn btn-primary float-right  m-b-15px create-users-button'>
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
            <th>User ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Email Address</th>
            <th>User Name</th>
            <th style='text-align:center'>Action</th>           
            </tr>
            </thead>
            <tbody>
       `;
     
    // get list of products from the API
    $.getJSON(getUrl() + "users/read-all.php", function(data){              
    // loop through returned list of data
    $.each(data.records, function(key, val) {  
          
    // creating new table row per record
    read_user_html+=`
    <tr>
        <td>` + val.User_ID + `</td>
        <td>` + val.Last_Name + `</td>
        <td>` + val.First_Name + `</td>
        <td>` + val.Middle_Name + `</td>
        <td>` + val.Email_Address + `</td>
        <td>` + val.User_Name + `</td>             

        <!-- 'action' buttons -->
        <td style='text-align:center'>
            <!-- read product button -->
            <button class='btn btn-primary m-r-10px read-one-users-button' data-id='` + val.User_ID + `'>
                <span class='glyphicon glyphicon-eye-open'></span> Read
            </button>

            <!-- edit button -->
            <button class='btn btn-info m-r-10px update-users-button' data-id='` + val.User_ID + `'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </button>

            <!-- delete button -->
            <button class='btn btn-danger delete-users-button' data-id='` + val.User_ID + `'>
                <span class='glyphicon glyphicon-remove'></span> Delete
            </button>
        </td>

    </tr>`;
    });

    read_user_html+=`
    </tbody>
    <tfoot>
    <tr>
    <th>User ID</th>
    <th>Last Name</th>
    <th>First Name</th>
    <th>Middle Name</th>
    <th>Email Address</th>
    <th>User Name</th>
    <th style='text-align:center'>Action</th>          
    </tr>
    </tfoot>
  </table> 
    `;
    
    // inject to 'page-content' of our app
    
    $("#page-content").html(read_user_html);    
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // chage page title
    changePageTitle("User List");    
        
});
 
}