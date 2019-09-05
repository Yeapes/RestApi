<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
include_once '../config/database.php';
include_once '../objects/product.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);
 
// read products will be here

// query products
$response = $product->create();

if($response){
 
    // set response code - 200 OK
    http_response_code(200);
   echo json_encode($response);
   
}else{

    http_response_code(404);
    echo json_encode(
        array("message" => "Not Created!!!")
    );
}
 
