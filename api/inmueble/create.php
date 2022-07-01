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
include_once '../objects/inmueble.php';
 
$database = new Database();
$db = $database->getConnection();
 
$inmueble = new Inmueble($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->numcredito) &&
    !empty($data->deudor) &&
    !empty($data->tipodquisicion) &&
    !empty($data->idreoban)
){
   
 
    // set inmueble property values
    $inmueble->numcredito = $data->numcredito;
    $inmueble->deudor = $data->deudor;
    $inmueble->tipodquisicion = $data->tipodquisicion;
    $inmueble->idreoban = $data->idreoban;
    $inmueble->cuentacat = $data->cuentacat;
    $inmueble->numfolioreal = $data->numfolioreal;
    $inmueble->idetapa = $data->idetapa;
    $inmueble->idestado = $data->idestado;
    $inmueble->idmunicipio = $data->idmunicipio;
    $inmueble->calle = $data->calle;
    $inmueble->codigopostal = $data->codigopostal;
    $inmueble->m2superficie = $data->m2superficie;
    $inmueble->m2construccion = $data->m2construccion;

    $inmueble->montoDeuda = $data->montoDeuda;
    $inmueble->montoMin = $data->montoMin;
    $inmueble->montoVenta = $data->montoVenta;

    $inmueble->numexpediente = $data->numexpediente;
    $inmueble->comentarioregpub = $data->comentarioregpub;
    $inmueble->comentarioexpjudicial = $data->comentarioexpjudicial;

   
 
    // create the product
    if($inmueble->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "inmueble was created." , "error" => false));
    }
 
    // if unable to create the inmueble, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create inmueble.", "error" => true));
    }
 }
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create inmueble. Data is incomplete."));
}
?>