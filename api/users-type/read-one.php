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
 
// set ID property of record to read
$userstype->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$userstype->readOne();
 
if($userstype->Type_Name!=null){
    // create array
    $userstype_arr = array(
        "Type_ID" =>  $userstype->Type_ID,
        "Type_Name" => $userstype->Type_Name,
        "Type_Description" => $userstype->Type_Description        
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
