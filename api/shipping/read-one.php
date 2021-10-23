<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/shipping.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare object
$shipping = new Shipping($db);
 
// set ID property of record to read
$shipping->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$shipping->readOne();
 
if($shipping->Route_ID!=null){
    // create array
    $shipping_arr = array(
        "Shipping_ID" =>  $shipping->Shipping_ID,
        "Route_ID" => $shipping->Route_ID,
        "Shipping_Destination" => $shipping->Shipping_Destination,
        "Shipping_Recipient" => $shipping->Shipping_Recipient        
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($shipping_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Record does not exist."));
}
?>
