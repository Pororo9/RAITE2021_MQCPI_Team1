<?php
include_once '../config/authorize.php';
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
include_once '../config/database.php';
include_once '../objects/user-type.php';
// instantiate database and usertypes object
$database = new Database();
$db = $database->getConnection();
// initialize object
$usertypes = new UserType($db);
// query categories
$stmt = $usertypes->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 // categories array
 $usertypes_arr=array();
 $usertypes_arr["records"]=array();
 // retrieve our table contents
 // fetch() is faster than fetchAll()
 // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 // extract row
 // this will make $row['name'] to
 // just $name only
 extract($row);
 $usertypes_item=array(
 "id" => $id,
 "Type_Name" => $Type_Name,
 "Type_ID" => html_entity_decode($Type_ID)
 );
 array_push($usertypes_arr["records"], $usertypes_item);
 }
 // set response code - 200 OK
 http_response_code(200);
 // show categories data in json format
 echo json_encode($usertypes_arr);
}
else{
 // set response code - 404 Not found
 http_response_code(404);
 // tell the user no  found
 echo json_encode(
 array("message" => "No categories found.")
 );
}
// read categories
?>