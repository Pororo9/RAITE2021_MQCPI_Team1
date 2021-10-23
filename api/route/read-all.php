<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/route.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$route = new Route($db);

// query products
$stmt = $route->readall();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // route_arr array
    $route_arr=array();
    $route_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $route_item=array(
            "id" => $id,
            "Route_ID" => $Route_ID,
            "Destination" => $Destination,
            "Latitude" => $Latitude,
            "Longitude" => $Longitude          
        ); 
        array_push($route_arr["records"], $route_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show route data in json format
    echo json_encode($route_arr);
}

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no route found
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
