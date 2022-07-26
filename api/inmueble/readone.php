<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/inmueble.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$inmueble = new Inmueble($db);
 
// set ID property of record to read
$inmueble->IdInmueble = isset($_GET['IdInmueble']) ? $_GET['IdInmueble'] : die();

// read the details of user to be edited
$inmueble->readOne();
 

 if($inmueble->NombreDeudor!=null){
     // create array

//     echo "Tiene datos ";
    $inmueble_arr = array(
        "IdInmueble" =>  $inmueble->IdInmueble,
        "NombreDeudor" => $inmueble->NombreDeudor,
        "ApellidosDeudor" => $inmueble->ApellidosDeudor,
        "IdEtapa" => $inmueble->IdEtapa,  
        "Etapa" => $inmueble->Etapa,
        "IdEstado" => $inmueble->IdEstado,
        "NomEstado" => $inmueble->NomEstado,
        "IdMunicipio" => $inmueble->IdMunicipio,
        "NomMunic" =>  $inmueble->NomMunic,
        "Calle" => $inmueble->Calle,
        "CodigoPostal" => $inmueble->CodigoPostal,
        "M2superficie" => $inmueble->M2superficie,
        "M2construccion" => $inmueble->M2construccion,
        "M2construccion" => $inmueble->M2construccion,
        "EstatusInm" => $inmueble->EstatusInm,
        
     );
 
//     // set response code - 200 OK
     http_response_code(200);
 
//     // make it json format
     echo json_encode($inmueble_arr);
 }
 
 else{
//     // set response code - 404 Not found
     http_response_code(404);
 
//     // tell the user product does not exist
     echo json_encode(array("message" => "Inmueble does not exist."));
 }
?>