<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/duty.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$duty = new Duty($db);

// query products
$stmt = $duty->readall();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // duty_arr array
    $duty_arr=array();
    $duty_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $duty_item=array(
            "id" => $id,
            "Duty_ID" => $Duty_ID,
            "Duty_Description" => $Duty_Description,
            "Rank_ID" => $Rank_ID          
        ); 
        array_push($duty_arr["records"], $duty_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show duty data in json format
    echo json_encode($duty_arr);
}

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no duty found
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
