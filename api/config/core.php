<?php
// show error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
 
// home page url
$home_url="http://localhost/RAITE2021/api/";
 
// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>
