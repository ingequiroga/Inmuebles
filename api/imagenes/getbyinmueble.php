<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/imagen.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$imagen = new Imagen($db);
 
// set ID property of record to read
$imagen->IdInmueble = isset($_GET['IdInmueble']) ? $_GET['IdInmueble'] : die();

// read the details of user to be edited
$stmtimagen=$imagen->readonebyinmueble();
$numimagenes=$stmtimagen->rowCount();

if ($numimagenes > 0) {
    $imagen_arr=array();
    $imagen_arr["imgresp"]=array();

    while ($row = $stmtimagen->fetch(PDO::FETCH_ASSOC)) { 
        extract($row);
        $imagen_item=array(
            "data"=>$Image,
            "name"=> $FileName
        );
        array_push($imagen_arr["imgresp"],$imagen_item);
    }
     
//     // set response code - 200 OK
http_response_code(200);
 
//     // make it json format
     echo json_encode(array("imagenes"=>$imagen_arr,"message" => "","error" =>false));
 
}  
 
 else{
//     // set response code - 404 Not found
     http_response_code(200);
 
//     // tell the user product does not exist
     echo json_encode(array("imagenes"=>[],"message" => "No se encontraron imagenes.","error" => true));
 }
?>