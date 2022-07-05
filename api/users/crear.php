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
include_once '../objects/user.php';

include_once '../objects/persona.php';

$database = new Database();
$db = $database->getConnection();
 
$user= new User($db);
$persona = new Persona($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->nombre) &&
    !empty($data->apellido)&&
    !empty($data->puesto)
){

	 // set product property values
   
    $persona->Nombre = $data->nombre;
    $persona->Apellido = $data->apellido;
    $persona->Puesto = $data->puesto;

    $user->Email = $data->email;
    $user->Pass = $data->pass;
    $user->IdRol = $data->idrol;

    $user->readOne();
    //echo $user->idUsuario;
     if ( $user->idUsuario==null) {
      
       if($persona->create()){
         $upersona = $persona->getmax();
         $user->IdPersona = $upersona;

          if($user->create())
            {
    //          // set response code - 201 created
              http_response_code(201);
     
    //         // tell the user
              echo json_encode(array("message" => "User was created.","error" => false));

            }
           else{
 
    //      // set response code - 503 service unavailable
          http_response_code(503);
 
    //      // tell the user
         echo json_encode(array("message" => "Unable to create examen.","error" => true));
         }   
     }
    // // if unable to create the product, tell the user
     else{
 
    //     // set response code - 503 service unavailable
         http_response_code(503);
 
    //     // tell the user
        echo json_encode(array("message" => "Unable to create examen.","error" => true));
      }

     }else{
       http_response_code(200);
     
    //   // tell the user
        echo json_encode(array("message" => "El correo electronico ya fue registrado","error" => true));
     }
   
  }

// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create examen. Data is incomplete.","error" => true));
}
?>
 
 