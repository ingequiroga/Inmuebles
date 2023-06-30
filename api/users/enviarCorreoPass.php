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
    !empty($data->email) &&
    !empty($data->link)&&
    !empty($data->clave)
 ){ 
//      // set product user values
      $user->Email = $data->email;

      $solicitud->email = $data->email;
      $solicitud->clave = $data->clave;
      $solicitud->expira = $data->expira;
      
      $user->sendEmailRecover();
      if($user->IdPersona != null){

        if ($solicitud->create()) {
      
                   $link = $data->link;  
                   $to = $user->Email;
                   $subject = "Recuperar Password";
          
                  $message = "
                  <html>
                  <head>
                  <title>Recuperar Password</title>
                  </head>
                  <body>
                  <p>Hacer click para recuperar password!</p>
                      <a href=". $link .">Recuperar</a>
                  </body>
                  </html>
                  ";
          
                  // Always set content-type when sending HTML email
                  $headers = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          
                  // More headers
                  $headers .= 'From: <admin@intradiespi.com>' . "\r\n";
                  $headers .= 'Cc: ingequiroga1@gmail.com' . "\r\n";
          
                  mail($to,$subject,$message,$headers);
          
                   http_response_code(201);
               
                   //         // tell the user
                     echo json_encode(array("message" => "Se envio correo electronico.","error" => false));
                 
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