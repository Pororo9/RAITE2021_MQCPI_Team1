<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/shipping.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$shipping = new Shipping($db);

// query products
$stmt = $shipping->readall();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // shipping_arr array
    $shipping_arr=array();
    $shipping_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $shipping_item=array(
            "id" => $id,
            "Shipping_ID" => $Shipping_ID,
            "Route_ID" => $Route_ID,
            "Shipping_Destination" => $Shipping_Destination,
            "Shipping_Recipient" => $Shipping_Recipient          
        ); 
        array_push($shipping_arr["records"], $shipping_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show shipping data in json format
    echo json_encode($shipping_arr);
}

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no shipping found
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
