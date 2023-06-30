<?php
// required headers
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
 
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/inmueble.php';
 
// instantiate database and inmueble object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$inmueble = new Inmueble($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

$inmueble->NumCredito = $data->numcredito;
$inmueble->Estado = $data->estado;
$inmueble->Municipio = $data->municipio;
 
// read inmuebles will be here
// query inmuebles
$stmt = $inmueble->search();
$num = $stmt->rowCount();
 
// check if more than 0 record found
 if($num>0){
 
    // inmuebles array
    $inmuebles_arr=array();
    $inmuebles_arr["datos"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $inmueble_item=array(
            "IdInmueble" => $IdInmueble,
            "NumCredito" => $NumCredito,
            "Estado" => $Estado,
            "Municipio" => $Municipio,
            "Proceso" => $proceso,
            "IdProceso" => $IdProceso,
            "Estatus" => $Estatus
        );
 
        array_push($inmuebles_arr["datos"], $inmueble_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($inmuebles_arr);
}
//no products found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}