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
        "numcredito" => $inmueble->NumCredito,
        "namedeudor" => $inmueble->NombreDeudor,
        "lastdeudor" => $inmueble->ApellidosDeudor,
        "tipodquisicion" => $inmueble->TipoAdquisicion,
        "idreoban" => $inmueble->IdReoBan,
        "numfolioreal" => $inmueble->NumFolioReal,
        "cuentacat" => $inmueble->CuentaCat,
        "estatusinm" => $inmueble->EstatusInm,
        "comentarioregpub" => $inmueble->ComentarioRegPub,
        "idestado" => $inmueble->IdEstado,
        "idmunicipio" => $inmueble->IdMunicipio,
        "calle" => $inmueble->Calle,
        "codigopostal" => $inmueble->CodigoPostal,
        "m2superficie" => $inmueble->M2superficie,
        "m2construccion" => $inmueble->M2construccion,
        "montoDeuda" => $inmueble->MontoDeuda,
        "montoMin" => $inmueble->MontoMin,
        "montoVenta" => $inmueble->MontoVenta,
        "numexpediente" => $inmueble->NumExpediente,
        "comentarioexpjudicial" => $inmueble->ComentarioExpJudicial,
        "NomRec" => $inmueble->NomRec,
        "idetapa" => $inmueble->IdEtapa,
        "Etapa" => $inmueble->Etapa,
        "NomEstado" => $inmueble->NomEstado,
        "NomMunic" =>  $inmueble->NomMunic,  
        "Colonia"=>$inmueble->Colonia,
        "Banos"=>$inmueble->Banos,
        "Cochera"=>$inmueble->Cochera,
        "Dormitorios"=>$inmueble->Dormitorios,
        "DescripcionAdicional"=>$inmueble->DescripcionAdicional,
        "NumInterior"=>$inmueble->NumInterior,
        "NumExt"=>$inmueble->NumExt,
        "TipoInmueble"=>$inmueble->TipoInmueble
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