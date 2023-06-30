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
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/proceso.php';
include_once '../objects/subetapa.php';
include_once '../objects/imagen.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$proceso = new Proceso($db);
$subetapa = new SubEtapa($db);
$imagen = new Imagen($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->Idinmueble) &&
    !empty($data->IdProceso) &&
    !empty($data->Idadquisicion)
){
    $proceso->IdInmueble = $data->Idinmueble;
    $proceso->IdProceso = $data->IdProceso;
    $proceso->IdEtapa = $data->IdEtapa;
    $proceso->Idadquisicion = $data->Idadquisicion;

    if ($proceso->CerrarProceso()) {

        if($proceso->InsertProceso()){
            $uproceso = $proceso->getmaxproc();
            $subetapa->IdProceso = $data->IdProceso;
            $subetapa->Idadquisicion = $uproceso;
            $stmt = $subetapa->getxidProc();
            $num = $stmt->rowCount();
            //echo $num;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $subetapa->Idtabsubetapa = $IdTabsubetapa;
                $subetapa->createSubEtapas();
            }
            http_response_code(200);
             
            //     // tell the user product does not exist
                 echo json_encode(array("message" => "Se Finalizo correctamente el proceso"));
        }
        else{
            //     // set response code - 404 Not found
                 http_response_code(404);
             
            //     // tell the user product does not exist
                 echo json_encode(array("message" => "Error al Insertar."));
             }

    }
    else{
        //     // set response code - 404 Not found
             http_response_code(404);
         
        //     // tell the user product does not exist
             echo json_encode(array("message" => "No se puede cerrar el proceso."));
         }

   
}

 else{
//     // set response code - 404 Not found
     http_response_code(404);
 
//     // tell the user product does not exist
     echo json_encode(array("message" => "Inmueble does not exist."));
 }
?>