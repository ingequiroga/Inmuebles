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
include_once '../objects/municipio.php';

$database = new Database();
$db = $database->getConnection();

$municipio = new Municipio($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// echo $data->email;
// echo $data->pass;
// make sure data is not empty
 if(
     !empty($data->estado)
 ){ 
//      // set product user values
      $municipio->IdEstado = $data->estado;
      $stmtMunicipio = $municipio->readxestado();
      $num = $stmtMunicipio->rowCount();

     // echo $num;
       if ($num > 0) {
    //     // etapa array
          $municipio=array();
          $municipio_arr["municipios"]=array();

      while ($row = $stmtMunicipio->fetch(PDO::FETCH_ASSOC)){
    //      // extract row
    //      // this will make $row['name'] to
    //      // just $name only
           extract($row);
  
          $municipio_item=array(
              "Id" => $IdMunicipio,
              "Nombre" => $Nombre,
          );
  
          array_push($municipio_arr["municipios"], $municipio_item);
      }
      http_response_code(200);
 
      // show products data in json format
      //echo json_encode($municipio_arr);
      echo json_encode(
        array("error" => "No products found.",$municipio_arr)
    );
      }   
      else {

        http_response_code(404);
 
        // tell the user no products found
        echo json_encode(
            array("message" => "No products found.")
        );
      }
 }
 else{
 
     // set response code - 400 bad request
     http_response_code(400);
 
     // tell the user
     echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
 }