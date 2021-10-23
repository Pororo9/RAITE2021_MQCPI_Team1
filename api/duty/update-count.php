<?php
include_once '../config/authorize.php';
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/duty.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$duty = new Duty($db);
 
// get id of user to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of user to be edited
$duty->Count = $data->Count;
 
// set user property values
 $duty->Count = $data->Count;
  
// update the user
if($duty->updateCount()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Record was updated."));
}
 
// if unable to update the user, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update record."));
}
?>
