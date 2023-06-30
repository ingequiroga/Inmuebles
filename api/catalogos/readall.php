<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once '../config/database.php';

// instantiate estado object
include_once '../objects/estado.php';
// instantiate etapa object
include_once '../objects/etapa.php';

 
// instantiate database and inmueble object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$estado = new Estado($db);
$etapa = new Etapa($db);
 
// read estado will be here
// query estado
$stmtEstado = $estado->read();
$numEstado = $stmtEstado->rowCount();

$stmtEtapa = $etapa->read();
$numEtapa = $stmtEtapa->rowCount();
 
$catalogo_arr=array();
$catalogo_arr["datos"]=array();
// check if more than 0 record found
if($numEstado>0 || $numEtapa>0 ){
    if ($numEstado>0) {
       // estado array
        $estado_arr=array();
        $estado_arr["estados"]=array();

        // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmtEstado->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $estado_item=array(
            "Id" => $IdEstado,
            "Nombre" => $Nombre,
        );
        array_push($estado_arr["estados"], $estado_item);
    }
        array_push($catalogo_arr["datos"], $estado_arr["estados"]);
    }

    if ($numEtapa>0) {
        // etapa array
         $etapa=array();
         $etapa_arr["etapas"]=array();

     while ($row = $stmtEtapa->fetch(PDO::FETCH_ASSOC)){
         // extract row
         // this will make $row['name'] to
         // just $name only
         extract($row);
  
         $etapa_item=array(
             "Id" => $IdEtapa,
             "Nombre" => $Descripcion,
         );
  
         array_push($etapa_arr["etapas"], $etapa_item);
     }
     array_push($catalogo_arr["datos"], $etapa_arr["etapas"]);
     }
<<<<<<< Updated upstream
=======

     if ($numMunicipio>0) {
        // etapa array
         $municipio=array();
         $municipio_arr["municipios"]=array();

     while ($row = $stmtMunicipio->fetch(PDO::FETCH_ASSOC)){
         // extract row
         // this will make $row['name'] to
         // just $name only
         extract($row);
  
         $municipio_item=array(
             "Id" => $IdMunicipio,
             "Nombre" => $Nombre,
             "IdEstado" => $IdEstado
         );
  
         array_push($municipio_arr["municipios"], $municipio_item);
     }
     array_push($catalogo_arr["datos"], $municipio_arr["municipios"]);
     }
>>>>>>> Stashed changes
    
 
    
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($catalogo_arr);
}
// no products found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}