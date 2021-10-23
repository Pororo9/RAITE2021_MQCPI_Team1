$(document).ready(function(){
    // app html
    var app_html=`              
        <h1 id='page-title'></h1>     
        <!-- this is where the contents will be shown. -->
        <div id='page-content'></div>     
      `;

      var app_nav=`          
         <div id='page-nav'></div> 
    `;

    // inject to 'app' in index.html 
    $("#app").html(app_html); 
    $("#navbar").html(app_nav);     
   });
   // change page title
   function changePageTitle(page_title){
    // change page title
    $('#page-title').text(page_title);
    $('#page-crumbs').text(page_title);
    // change title tag
    document.title=page_title;
   }
   // function to make form values to json format
   $.fn.serializeObject = function()
   {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
    if (o[this.name] !== undefined) {
    if (!o[this.name].push) {
    o[this.name] = [o[this.name]];
    }
    o[this.name].push(this.value || '');
    } else {
    o[this.name] = this.value || '';
    }
    });
    return o;
   };


   function getUrl(){
     return "http://localhost/RAITE2021/api/";
    }

    
    function tConvert (time) {
      // Check correct time format and split into components
      time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
    
      if (time.length > 1) { // If time format correct
        time = time.slice (1);  // Remove full string match value
        time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
        time[0] = +time[0] % 12 || 12; // Adjust hours
      }
      return time.join (''); // return adjusted time or original string
    }