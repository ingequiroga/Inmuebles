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
    !empty($data->idreoban) &&
    !empty($data->procInicial)  
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
<<<<<<< Updated upstream

   
 
    // create the product
    if($inmueble->create()){
 
        // set response code - 201 created
        http_response_code(201);
=======
    $inmueble->estatusinm = $data->estatusinm;
    $proceso->IdProceso = $data->procInicial;
    $subetapa->IdProceso = $data->procInicial;

    $inmueble->Colonia = $data->Colonia;
    $inmueble->Banos = $data->Banos; 
    $inmueble->Cochera = $data->Cochera; 
    $inmueble->Dormitorios = $data->Dormitorios; 
    $inmueble->DescripcionAdicional = $data->DescripcionAdicional; 
    $inmueble->NumInterior = $data->NumInterior; 
    $inmueble->NumExt = $data->NumExt; 
    $inmueble->TipoInmueble = $data->TipoInmueble;

    


  
    if($inmueble-> existnc()){
       if($inmueble->create()){
            $uinmueble = $inmueble->getmaxInm();
            // echo $uinmueble;
            $proceso->IdInmueble = $uinmueble;
            
            $proceso->createProceso();
            $uproceso = $proceso->getmaxproc();
            $subetapa->Idadquisicion = $uproceso;

            $stmt = $subetapa->getxidProc();
            $num = $stmt->rowCount();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $subetapa->Idtabsubetapa = $IdTabsubetapa;
                $subetapa->createSubEtapas();
            }
             http_response_code(201);
>>>>>>> Stashed changes
 
                // tell the user
                echo json_encode(array("idinmueble"=>$proceso->IdInmueble,"message" => "Se agrego el nuevo Inmueble." , "error" => false));
             }
 
            // if unable to create the inmueble, tell the user
            else{
        
                // set response code - 503 service unavailable
                http_response_code(503);
        
                // tell the user
                echo json_encode(array("idinmueble"=>0,"message" => "Unable to create inmueble.", "error" => true));
            }
    }
     else{
 
        // set response code - 503 service unavailable
        http_response_code(200);
 
        // tell the user
        echo json_encode(array("idinmueble"=>0,"message" => "Ya se registro ese numero de crédito", "error" => true));
    }
    
  
 }
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("idinmueble"=>0,"message" => "Unable to create inmueble. Data is incomplete."));
}
?>