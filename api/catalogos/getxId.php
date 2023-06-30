<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/catalogo.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare user object
$catalogo = new Catalogo($db);


// set ID property of record to read
$catalogo->IdDet = isset($_GET['IdDet']) ? $_GET['IdDet'] : die();

// read the details of user to be edited

$catalogo->readById();
if($catalogo->Descripcion!=null){
    $catalogo_arr = array(
        "Descripcion" => $catalogo->Descripcion
    );

       // set response code - 200 OK
       http_response_code(200);
 
       // make it json format
       echo json_encode($catalogo_arr);

}
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Catalogo does not exist."));
}
?>