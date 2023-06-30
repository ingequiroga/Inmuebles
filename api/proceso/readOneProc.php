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
include_once '../objects/Documento.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$proceso = new Proceso($db);
$subetapa = new SubEtapa($db);
$documento = new Documento($db);
 


$data = json_decode(file_get_contents("php://input"));
if (
    !empty($data->Idinmueble) &&
    !empty($data->IdProceso) 
    ) 
    {
    // read the details of user to be edited
// set ID property of record to read
$proceso->IdInmueble = $data->Idinmueble;
$proceso->IdProceso = $data->IdProceso;

$proceso->readOne();
 


if($proceso->IdAdquisicion!=null){
    // create array

   
   $proceso_arr = array(
       "IdAdquisicion" =>  $proceso->IdAdquisicion,
       "IdEtapa" => $proceso->IdEtapa,
       "IdProceso" => $proceso->IdProceso,
       "Porcentaje" => $proceso->PorcProceso,
       "Estatus" => $proceso->Estatus
    );


    
    $subetapa->IdAdquisicion = $proceso->IdAdquisicion;
    $stmt = $subetapa->readxProc();
    
     $num = $stmt->rowCount();

    if ($num > 0) {
       $subetapas_arr=array();
       $subetapas_arr["datos"]=array();
       $i = 0;
       while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        

           extract($row);
            $documento->IdAdquisicion = $proceso->IdAdquisicion;
            $documento->IdProceso = $proceso->IdProceso;
            $documento->IdSubEtapa = $IdSubEtapa;
           $docs = $documento->readxSubEt();
           
           $documentos_arr=array();
           //$imagenes_arr["imagenes"]=array();
           while ($rowimg =  $docs->fetch(PDO::FETCH_ASSOC) ){
               extract($rowimg);
               $documentos_item=array(
                   "data" => $Documento,
                   "name" => $FileName,
               );

               array_push($documentos_arr,$documentos_item);
           }

           $subetapa_item=array(
               "Indice" => $i,
               "IdAdquisicion" => $IdAdquisicion,
               "IdSubEtapa" => $IdSubEtapa,
               "Value" => $Value,
               "IdTabsubetapa" => $IdTabsubetapa,
               "Comentarios" => $Comentarios,
               "Estatus" => $Estatus, 
               "Descripcion" => $Descripcion,
               "Imagenes"=> $documentos_arr
           );
    
           array_push($subetapas_arr["datos"], $subetapa_item);
           $i=$i+1;
       }
    }

    // set response code - 200 OK
    http_response_code(200);

    // make it json format
    echo json_encode(array("proceso" => $proceso_arr,"subetapas" => $subetapas_arr));
}

else{
//     // set response code - 404 Not found
    http_response_code(404);

//     // tell the user product does not exist
    echo json_encode(array("message" => "Inmueble does not exist."));
}   
}
else{
    //     // set response code - 404 Not found
         http_response_code(404);
     
    //     // tell the user product does not exist
         echo json_encode(array("message" => "Falta agregar informacion."));
     }


?>