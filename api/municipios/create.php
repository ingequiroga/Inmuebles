<?php
// required headers
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // The request is using the POST method
    header("HTTP/1.1 200 OK");
    return;

}
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/municipio.php';


$database = new Database();
$db = $database->getConnection();
 
$municipio = new Municipio($db);


 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->idestado) &&
    !empty($data->nombre) 
){
   
 
    // set inmueble property values
    $municipio->IdEstado = $data->idestado;
    $municipio->Nombre = $data->nombre;

    if($municipio->existeMun()){
       if($municipio->create()){
             http_response_code(201);
 
                // tell the user
                echo json_encode(array("message" => "Se agrego el nuevo Municipio." , "error" => false));
         }
 
            // if unable to create the inmueble, tell the user
            else{
        
                // set response code - 503 service unavailable
                http_response_code(503);
        
                // tell the user
                echo json_encode(array("message" => "Unable to create Municipio.", "error" => true));
            }
    }
     else{
 
        // set response code - 503 service unavailable
        http_response_code(200);
 
        // tell the user
        echo json_encode(array("message" => "Ya se registro ese Municipio", "error" => true));
    }
    
  
 }
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create Municipio. Data is incomplete."));
}
?>