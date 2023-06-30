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
 
// instantiate product object
include_once '../objects/inmueble.php';
 

$database = new Database();
$db = $database->getConnection();
 
$inmueble = new Inmueble($db);

 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->IdInmueble) &&
    !empty($data->numcredito) &&
    !empty($data->namedeudor) &&
    !empty($data->lastdeudor) &&
    !empty($data->tipodquisicion) &&
    !empty($data->idreoban) 
){
    
    //set inmueble property values
    $inmueble->IdInmueble = $data->IdInmueble;
    $inmueble->NumCredito = $data->numcredito;
    $inmueble->NameDeudor = $data->namedeudor;
    $inmueble->LastDeudor = $data->lastdeudor;
    $inmueble->TipoAdquisicion = $data->tipodquisicion;
    $inmueble->IdReoBan = $data->idreoban;
    $inmueble->CuentaCat = $data->cuentacat;
    $inmueble->NumFolioReal = $data->numfolioreal;
    $inmueble->IdEtapa = $data->idetapa;
    $inmueble->IdEstado = $data->idestado;
    $inmueble->IdMunicipio = $data->idmunicipio;
    $inmueble->Calle = $data->calle;
    $inmueble->CodigoPostal = $data->codigopostal;
    $inmueble->M2superficie = $data->m2superficie;
    $inmueble->M2construccion = $data->m2construccion;
    $inmueble->MontoDeuda = $data->montoDeuda;
    $inmueble->MontoMin = $data->montoMin;
    $inmueble->MontoVenta = $data->montoVenta;
    $inmueble->NumExpediente = $data->numexpediente;
    $inmueble->ComentarioRegPub = $data->comentarioregpub;
    $inmueble->ComentarioExpJudicial = $data->comentarioexpjudicial;
    $inmueble->EstatusInm = $data->estatusinm;

    $inmueble->Colonia = $data->Colonia;
    $inmueble->Banos = $data->Banos;
    $inmueble->Cochera = $data->Cochera;
    $inmueble->Dormitorios = $data->Dormitorios;
    $inmueble->DescripcionAdicional = $data->DescripcionAdicional;
    $inmueble->NumInterior = $data->NumInterior;
    $inmueble->NumExt = $data->NumExt;
    $inmueble->TipoInmueble = $data->TipoInmueble;


   
    // create the product
    if($inmueble->update()){
        
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Se Actualizo el Inmueble." , "error" => false));
    }
 
    // if unable to create the inmueble, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to update inmueble.", "error" => true));
    }
 }
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update inmueble. Data is incomplete."));
}
?>