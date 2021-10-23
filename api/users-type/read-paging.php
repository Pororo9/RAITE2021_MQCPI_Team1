<?php
include_once '../config/authorize.php';
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/user-type.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and user object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$userstype = new UserType($db);
 
// query userstype
$stmt = $userstype->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // userstype array
    $userstype_arr=array();
    $userstype_arr["records"]=array();
    $userstype_arr["paging"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $userstype_item=array(
            "id" => $id,
            "Type_ID" => $Type_ID,
            "Type_Name" => $Type_Name,
            "Type_Description" => $Type_Description           
        ); 
 
        array_push($userstype_arr["records"], $userstype_item);
    }
 
 
    // include paging
    $total_rows=$userstype->count();
    $page_url="{$home_url}users-type/read-paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $userstype_arr["paging"]=$paging;
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($userstype_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user userstype does not exist
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>
