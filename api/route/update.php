<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/route.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$route = new Route($db);
 
// get id of user to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of user to be edited
$route->Route_ID = $data->Route_ID;
 
// set user property values
 $route->Route_ID = $data->Route_ID;
 $route->Destination = $data->Destination;
 $route->Latitude = $data->Latitude;
 $route->Longitude = $data->Longitude;

 
// update the user
if($route->update()){
 
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
