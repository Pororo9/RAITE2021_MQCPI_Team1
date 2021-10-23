<?php
include_once '../config/authorize.php';
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$users = new User($db);

// query products
$stmt = $users->readall();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $users_arr=array();
    $users_arr["records"]=array();
 
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
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($users_arr);
}

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no user found
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>
