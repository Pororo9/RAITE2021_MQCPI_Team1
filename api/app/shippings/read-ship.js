$(document).ready(function(){
    // show list of product on first load      
    showShipList();
    $(document).on('click', '.read-ship-button', function(){   
        showShipList();
    });
});
   
   function showShipList(){      
       read_ship_form_html=`  
       <div class='row'>
            <div class='col-md-6'>                
             </div>
          <!-- /.col -->          
          <div class='col-md-6'>
                <div class='form-group'>
                    <!-- 'read products' button to show list of products -->
                    <div id='read-ship' class='btn btn-primary float-right  m-b-15px create-ship-button'>
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
            <th>Shipping ID</th>
            <th>Route ID</th>
            <th>Shipping Description</th>
            <th>Shipping Recipient</th>
            <th style='text-align:center'>Action</th>           
            </tr>
            </thead>
            <tbody>
       `;
     
    // get list of products from the API
    $.getJSON(getUrl() + "shipping/read-all.php", function(data){              
    // loop through returned list of data
    $.each(data.records, function(key, val) {  
          
    // creating new table row per record
    read_ship_form_html+=`
    <tr>
        <td>` + val.Shipping_ID + `</td>
        <td>` + val.Route_ID + `</td>
        <td>` + val.Shipping_Description + `</td>
        <td>` + val.Shipping_Recipient + `</td>

        <!-- 'action' buttons -->
        <td style='text-align:center'>
            <!-- read product button -->
            <button class='btn btn-primary m-r-10px read-one-ship-button' data-id='` + val.Shipping_ID + `'>
                <span class='glyphicon glyphicon-eye-open'></span> Read
            </button>

            <!-- edit button -->
            <button class='btn btn-info m-r-10px update-ship-button' data-id='` + val.Shipping_ID + `'>
                <span class='glyphicon glyphicon-edit'></span> Edit
            </button>

            <!-- delete button -->
            <button class='btn btn-danger delete-ship-button' data-id='` + val.Shipping_ID + `'>
                <span class='glyphicon glyphicon-remove'></span> Delete
            </button>
        </td>

    </tr>`;
    });

    read_ship_form_html+=`
    </tbody>
    <tfoot>
    <tr>
    <th>Shipping ID</th>
    <th>Route ID</th>
    <th>Shipping Desciption</th>
    <th>Shipping Recipient</th>
    <th style='text-align:center'>Action</th>          
    </tr>
    </tfoot>
  </table> 
    `;
    
    // inject to 'page-content' of our app
    
    $("#page-content").html(read_ship_form_html);    
    $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // chage page title
    changePageTitle("Shipping List");    
        
});
 
}