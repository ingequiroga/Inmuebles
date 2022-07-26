<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/proceso.php';
include_once '../objects/subetapa.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$proceso = new Proceso($db);
$subetapa = new SubEtapa($db);
 
// set ID property of record to read
$proceso->IdInmueble = isset($_GET['IdInmueble']) ? $_GET['IdInmueble'] : die();

// read the details of user to be edited
$proceso->readOne();
 

 if($proceso->IdAdquisicion!=null){
     // create array

//     echo "Tiene datos ";
    $proceso_arr = array(
        "IdAdquisicion" =>  $proceso->IdAdquisicion,
        "IdEtapa" => $proceso->IdEtapa,
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
     
            $subetapa_item=array(
                "Indice" => $i,
                "IdAdquisicion" => $IdAdquisicion,
                "IdSubEtapa" => $IdSubEtapa,
                "Value" => $Value,
                "IdTabsubetapa" => $IdTabsubetapa,
                "Comentarios" => $Comentarios,
                "Estatus" => $Estatus, 
                "Descripcion" => $Descripcion
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
?>