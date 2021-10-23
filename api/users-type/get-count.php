<?php
include_once '../config/authorize.php';
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user-type.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare object
$userstype = new UserType($db);
 
 // read the details of product to be edited
$userstype->getCount();
 
if($userstype->Count!=null){
    // create array
    $userstype_arr = array(
        "Count" =>  $userstype->Count
    );
   

    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($userstype_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Record does not exist."));
}
?>
