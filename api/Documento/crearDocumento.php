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
include_once '../objects/Documento.php';


$database = new Database();
$db = $database->getConnection();
 

$documento = new Documento($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->IdAdquisicion) &&
    !empty($data->IdProceso)&&
    !empty($data->IdSubEtapa)
){

	 // set product property values
   
    $documento->IdAdquisicion = $data->IdAdquisicion;
    $documento->IdProceso = $data->IdProceso;
    $documento->IdSubEtapa = $data->IdSubEtapa;
    $documento->Docuemento = $data->Documento;
    $documento->FileName = $data->FileName;

    $num = $documento->ifexist();
  
    if ($num > 0) {
        http_response_code(201);

        //     // tell the user
            echo json_encode(array("message" => "el documento ya existe","error" => true));
        
   
     }
   // // if unable to create the product, tell the user
    else{
             if($documento->create()){

            // set response code - 201 created
             http_response_code(201);
    
            // tell the user
             echo json_encode(array("message" => "Document was created.","error" => false));
             }
             else{
                http_response_code(503);

                //     // tell the user
                    echo json_encode(array("message" => "El documento ya existe","error" => true));
             }
   
     }

    }

  //}
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to add Image. Data is incomplete.","error" => true));
}
?>
 
 