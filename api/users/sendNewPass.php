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

// instantiate product object
include_once '../objects/solicitudPass.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$solicitud= new SolicitudPass($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
 if(
    !empty($data->email)
 ){ 
//      // set product user values
      $user->Email = $data->email;
      $user->sendEmailRecover();
      if($user->idUsuario != null){

         $user->Pass = randomPass();
         $newPass = $user->Pass;
        if ($user->changePass()) {

                   http_response_code(201);
               
                   //         // tell the user
                     echo json_encode(array("message" => "Se Restablecio el password.","pass" => $newPass,"error" => false));
                 
            }
            else{
         
                //     // set response code - 503 service unavailable
                     http_response_code(503);
             
                //     // tell the user
                    echo json_encode(array("message" => "Unable to create solicitud.","error" => true));
                  }
      }
      else{
           http_response_code(200);
   
           // tell the user
           echo json_encode(array("message" => "El correo solicitado no esta registrado.","error" => true));
      }
 }
 else{
 
     // set response code - 400 bad request
     http_response_code(400);
 
     // tell the user
     echo json_encode(array("message" => "No se pudo restablecer el password."));
 }

 function randomPass() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


