<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/persona.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$persona = new Persona($db);
 
// set ID property of record to read
$persona->idPersona = isset($_GET['Id']) ? $_GET['Id'] : die();

// read the details of user to be edited
$persona->readOne();
 

 if($persona->Nombre!=null){
     // create array

//     echo "Tiene datos ";
    $persona_arr = array(
        "Nombre" =>  $persona->Nombre,
        "Apellido" => $persona->Apellido
     );
 
//     // set response code - 200 OK
     http_response_code(200);
 
//     // make it json format
     echo json_encode($persona_arr);
 }
 
 else{
//     // set response code - 404 Not found
     http_response_code(404);
 
//     // tell the user product does not exist
     echo json_encode(array("message" => "Persona does not exist."));
 }
?>