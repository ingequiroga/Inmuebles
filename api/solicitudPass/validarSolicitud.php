<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // The request is using the POST method
    header("HTTP/1.1 200 OK");
    return;

}
// include database and object files
include_once '../config/database.php';
include_once '../objects/solicitudPass.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$solicitud = new SolicitudPass($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->clave) &&
    !empty($data->expira) 
){

    $solicitud->clave = $data->clave;

    $solicitud->obtenerClave();
    if($solicitud->id != null){
        if ($data->expira > $solicitud->expira) {
            http_response_code(200);
 
            // tell the user product does not exist
            echo json_encode(array("message" => "El link ya no es válido.","error" => true));
        } else {
            http_response_code(200);
 
            // make it json format
            echo json_encode(array("message" => "El link es válido.","error" => false));
        }
    }else{
        http_response_code(200);
 
        // tell the user product does not exist
        echo json_encode(array("message" => "El link ya no es válido.","error" => true));
    }

}
else{
 
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "No se pudo restablecer el password."));
}
?>