$(document).ready(function(){
    // will run if the delete button was clicked
    $(document).on('click', '.delete-type-button', function(){
    // get the product id
   
    var type_id = $(this).attr('data-id');
    // bootbox for good looking 'confirm pop up'
    
    bootbox.confirm({   
    message: "<h4>Are you sure you want to delete this record?</h4>",
    buttons: {
    confirm: {
    label: '<span class="fas fa-check"></span> Yes',
    className: 'btn-danger'
    },
    cancel: {
    label: '<span class="fas fa-times"></span> No',
    className: 'btn-primary'
    }
    },
    callback: function (result) {
    if(result==true){
    // send delete request to api / remote server
    $.ajax({
    url: getUrl() +  "users-type/delete.php",
    type : "POST",
    dataType : 'json',
    data : JSON.stringify({ Type_ID : type_id }),
    success : function(result) {
   
    // re-load list of products
    showTypeList();
    },
    error: function(xhr, resp, text) {
    console.log(xhr, resp, text);
    }
    });
   
    }
    }
    });
    });
   });