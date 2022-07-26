<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // The request is using the POST method
    header("HTTP/1.1 200 OK");
    return;

}

// get database connection
include_once '../config/database.php';
 
// instantiate subetapa object
include_once '../objects/subetapa.php';

$database = new Database();
$db = $database->getConnection();
 
$subetapa= new SubEtapa($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->IdAdquisicion) &&
    !empty($data->IdSubEtapa)&&
    !empty($data->IdEtapa)
){

	 // set product property values
   
    $subetapa->Idadquisicion = $data->IdAdquisicion;
    $subetapa->IdSubEtapa = $data->IdSubEtapa;
    $subetapa->Estatus = $data->Estatus;
    $subetapa->Comentarios = $data->Comentarios;
  
      
    if($subetapa->UpdateSubEtapas()){


              // set response code - 201 created
              http_response_code(201);
     
            // tell the user
              echo json_encode(array("message" => "Se Modifico Sub Etapa.","error" => false));


     }
    // // if unable to create the product, tell the user
     else{
 
    //     // set response code - 503 service unavailable
         http_response_code(503);
 
    //     // tell the user
        echo json_encode(array("message" => "No se pudo modificar la sub etapa.","error" => true));
      }


   
  }
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create solicitud. Data is incomplete.","error" => true));
}
?>
 
 