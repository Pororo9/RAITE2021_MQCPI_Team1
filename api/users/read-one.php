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
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare object
$users = new User($db);
 
// set ID property of record to read
$users->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$users->readOne();
 
if($users->User_Name!=null){
    // create array
    $users_arr = array(
        "User_ID" =>  $users->User_ID,
        "User_Name" =>  $users->User_Name,
        "Last_Name" => $users->Last_Name,
        "First_Name" => $users->First_Name,
        "Middle_Name" => $users->Middle_Name,
        "Gender" => $users->Gender,        
        "Email_Address" => $users->Email_Address,
        "Type_ID" => $users->Type_ID,
        "Type_Name" => $users->Type_Name 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($users_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Record does not exist."));
}
?>
