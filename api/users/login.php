<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');
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

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// echo $data->email;
// echo $data->pass;
// make sure data is not empty
 if(
     !empty($data->email) &&
     !empty($data->pass) 
 ){ 
//      // set product user values
      $user->Email = $data->email;
      $user->Pass = $data->pass;
      $user->login();

      //echo $user->IdPersona;
      if($user->IdPersona != null){
        
        $user_arr = array(
            "idUsuario" =>  $user->idUsuario,
            "Email" => $user->Email,
            "IdPersona" => $user->IdPersona,
            "IdRol" => $user->IdRol,
            "message" => "Acceso concedido",
            "error" => false
        );
         // set response code - 201 created
         http_response_code(201);
 
//         // tell the user
        echo json_encode($user_arr);
     }
     else{

        $user_arr = array(
            "idUsuario" =>  '',
            "Email" => '',
            "IdPersona" => '',
            "IdRol" => '',
            "message" => "usuario o pass incorrectos.",
            "error" => true
     
        );
         // set response code - 503 service unavailable
         //http_response_code(503);
 
         // tell the user
         echo json_encode($user_arr);
        // echo json_encode(array("message" => "usuario o pass incorrectos."));
     }

 }
 else{
 
     // set response code - 400 bad request
     http_response_code(400);
 
     // tell the user
     echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
 }