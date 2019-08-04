<?php

// required headers
header("Access-Control-Allow-Origin: *"); // file can be read by anyone (asterisk * means all) 
header("Content-Type: application/json; charset=UTF-8"); // will return a data in JSON format.

// include database and object files
include_once '../config/database.php'; 
include_once '../objects/Users.php';

// instantiate database and user object 
$database=new Database();
$db=$database->getConnection();

$users=new Users($db);

$stmt=$users->read();

$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // users array
    $users_arr=array();
    $users_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $user_item=array(
            "id" => $id,
            "username" => $username,
            "password" => html_entity_decode($password),
            "emailid" => $emailid,
            "mobileno" => $mobileno,
            "address" => $address,
			"usercreated" => $usercreated
        );
 
        array_push($users_arr["records"], $user_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($users_arr);
}
else
{
	http_response_code(404);
	
	echo json_encode(array("message"=>"No product found"));
}	

?>