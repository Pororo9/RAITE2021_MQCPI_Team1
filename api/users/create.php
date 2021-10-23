<?php
include_once '../config/authorize.php';
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$users = new User($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->User_ID) &&
    !empty($data->User_Name) &&
    !empty($data->Last_Name) &&
    !empty($data->First_Name) &&
    !empty($data->Middle_Name) &&
    !empty($data->Gender) &&
    !empty($data->Email_Address) &&
    !empty($data->Password) &&      
    !empty($data->Type_ID)
){
 
    // set product property values
    $users->User_ID = $data->User_ID;
    $users->User_Name = $data->User_Name;
    $users->Last_Name = $data->Last_Name;
    $users->First_Name = $data->First_Name;
    $users->Middle_Name = $data->Middle_Name;
    $users->Email_Address =  $data->Email_Address;
    $users->Gender =  $data->Gender;
    $users->Password =  $data->Password;
    $users->Type_ID = $data->Type_ID;
   
    // create the product
    if($users->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Record was created."));
    }
 
    // if unable to create the user, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create record."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create record. Data is incomplete."));
}
?>
