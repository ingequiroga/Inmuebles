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

// make sure data is not empty
 if(
     !empty($data->email)
 ){ 
//      // set product user values
      $user->Email = $data->email;
      $user->sendEmailRecover();
      
      //echo $user->IdPersona;
      if($user->IdPersona != null){
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
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: ingequiroga1@gmail.com' . "\r\n";

        mail($to,$subject,$message,$headers);

        http_response_code(201);
     
        //         // tell the user
        echo json_encode(array("message" => "Se envio correo."));
       
     }
     else{
         // set response code - 503 service unavailable
         http_response_code(200);
 
         // tell the user
         echo json_encode(array("message" => "no se encontro el email solicitado."));
     }

 }
 else{
 
     // set response code - 400 bad request
     http_response_code(400);
 
     // tell the user
     echo json_encode(array("message" => "No se pudo restablecer el password."));
 }