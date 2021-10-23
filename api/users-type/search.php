<?php
include_once '../config/authorize.php';
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/user-type.php';
 
// instantiate database and user object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$userstype = new UserType($db);
 
// get keywords
$keywords=isset($_GET["id"]) ? $_GET["id"] : "";
 
// query userstype
$stmt = $userstype->search($keywords);
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // userstype array
    $userstype_arr=array();
    $userstype_arr["records"]=array();
 
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
            "Type_Code" => $Type_Code,
            "Type_Name" => $Type_Name,
            "Type_Description" => $Type_Description
        ); 
 
        array_push($userstype_arr["records"], $userstype_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show userstype data
    echo json_encode($userstype_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no userstype found
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>
