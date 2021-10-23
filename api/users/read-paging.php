<?php
include_once '../config/authorize.php';
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/user.php';
 
// utilities
$utilities = new Utilities();
 
// instantiate database and user object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$users = new User($db);
 
// query users
$stmt = $users->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // users array
    $users_arr=array();
    $users_arr["records"]=array();
    $users_arr["paging"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $users_item=array(
            "id" => $id,
            "User_ID" => $User_ID,
            "User_Name" => $User_Name,
            "Last_Name" => $Last_Name,
            "First_Name" => $First_Name,
            "Middle_Name" => $Middle_Name,
            "Gender" => $Gender,
            "Email_Address" => $Email_Address,
            "Type_Name" => $Type_Name
        ); 
 
        array_push($users_arr["records"], $users_item);
    }
 
 
    // include paging
    $total_rows=$users->count();
    $page_url="{$home_url}users/read-paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $users_arr["paging"]=$paging;
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($users_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user users does not exist
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>
