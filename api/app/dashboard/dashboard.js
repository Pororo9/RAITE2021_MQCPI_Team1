$(document).ready(function(){

    $.getJSON( getUrl() + "employees/get-count.php", function(data){        
        getCount = data.Count;     
        document.getElementById("totalEmp").innerHTML = getCount;
     });


     $.getJSON( getUrl() + "users/get-count.php", function(data){        
        getCount = data.Count;     
        document.getElementById("totalUsers").innerHTML = getCount;
     });

     $.getJSON( getUrl() + "attendances/get-tot-attend.php", function(data){        
        getCount = data.Total_Attend;     
        document.getElementById("todayatt").innerHTML = getCount;
     });

});


