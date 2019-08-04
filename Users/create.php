<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate users object
include_once '../objects/Users.php';
 
$database = new Database();
$db = $database->getConnection();
 
$users = new Users($db); //connection to the database
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->username) &&
    !empty($data->password) &&
    !empty($data->emailid) &&
    !empty($data->mobileno) &&
	!empty($data->address)
){
 
    // set users property values
    $users->username = $data->username;
    $users->password = $data->password;
    $users->emailid = $data->emailid;
    $users->mobileno = $data->mobileno;
    $users->address = $data->address;
 
    // create the users
    if($users->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "user was created."));
    }
 
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create user."));
    }
}
 
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}
?>