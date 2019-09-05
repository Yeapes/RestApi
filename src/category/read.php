<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
include_once '../config/database.php';
include_once '../objects/allcategories.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$category = new Category($db);
 
// read products will be here

// query products
$stmt = $category->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $categories_arr=array();
    $categories_arr["categories"]=array();
 
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $category_item=array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            
        );
 
        array_push($categories_arr["categories"], $category_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($categories_arr);
}else{

    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}
 
