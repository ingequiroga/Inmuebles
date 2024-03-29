<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/estado.php';
 

$database = new Database();
$db = $database->getConnection();
 
// initialize object
$estado = new Estado($db);
 

$stmt = $estado->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // estado array
    $estado_arr=array();
    $estado_arr["datos"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $estado_item=array(
            "IdEstado" => $IdEstado,
            "Nombre" => $Nombre
        );
 
        array_push($estado_arr["datos"], $estado_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($estado_arr);
}
// no products found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No states found.")
    );
}