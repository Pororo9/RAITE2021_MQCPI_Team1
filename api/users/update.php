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
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$users = new User($db);
 
// get id of user to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of user to be edited
$users->User_ID = $data->User_ID;
 
// set user property values
$users->User_Name = $data->User_Name;
 $users->Last_Name = $data->Last_Name;
 $users->First_Name = $data->First_Name;
 $users->Middle_Name = $data->Middle_Name;
 $users->Email_Address =  $data->Email_Address;
 $users->Gender =  $data->Gender;
 $users->Password =  $data->Password;
 $users->Type_ID = $data->Type_ID;

 
// update the user
if($users->update()){
 
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
