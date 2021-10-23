<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/shipping.php';
 
$database = new Database();
$db = $database->getConnection();
 
$shipping = new Shipping($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->Shipping_ID) &&
    !empty($data->Route_ID) &&
    !empty($data->Shipping_Destination) &&
    !empty($data->Shipping_Recipient)  
){
 
    // set product property values
    $shipping->Shipping_ID = $data->Shipping_ID;
    $shipping->Route_ID = $data->Route_ID;
    $shipping->Shipping_Destination = $data->Shipping_Destination;
    $shipping->Shipping_Recipient = $data->Shipping_Recipient;  
   
    // create the product
    if($shipping->create()){
 
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
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}
?>
