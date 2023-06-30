<?php
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
include_once '../objects/imagen.php';


$database = new Database();
$db = $database->getConnection();
 

$imagen = new Imagen($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->IdInmueble) 
){

	 // set product property values
   
    $imagen->IdInmueble = $data->IdInmueble;

  
             if($imagen->borrarImagenes()){

            // set response code - 201 created
             http_response_code(201);
    
            // tell the user
             echo json_encode(array("message" => "Proceso terminado correctamente.","error" => false));
             }
             else{
                http_response_code(503);

                //     // tell the user
                    echo json_encode(array("message" => "Proceso fallo","error" => true));
             }
   
     

    }

  //}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to clear Images. Data is incomplete.","error" => true));
}
?>
 
 