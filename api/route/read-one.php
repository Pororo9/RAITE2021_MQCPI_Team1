<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/route.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare object
$route = new Route($db);
 
// set ID property of record to read
$route->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$route->readOne();
 
if($route->Destination!=null){
    // create array
    $route_arr = array(
        "Route_ID" =>  $route->Route_ID,
        "Destination" => $route->Destination,
        "Latitude" => $route->Latitude,
        "Longitude" => $route->Longitude        
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($route_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Record does not exist."));
}
?>
