<?php
class Persona{

// database connection and table name
private $conn;
private $table_name = "persona";

    // object properties
    public $idPersona;
    public $Nombre;
    public $Apellido;
    public $Puesto;

 
    // constructor with $db as database connection
public function __construct($db){
        $this->conn = $db;
}

function readOne(){
     
    $query = 
      "
      SELECT Nombre,Apellido 
      FROM persona
      WHERE IdPersona = ?
      ";        
   
      // prepare query statement
      $stmt = $this->conn->prepare( $query );
   
      // bind id of product to be updated
      //$stmt->bindParam(1, $this->id_usuario);
      $stmt->bindParam(1, $this->idPersona);

     
      // execute query
       $stmt->execute();
       if($stmt->rowCount() > 0){ 
              // // get retrieved row
       $row = $stmt->fetch(PDO::FETCH_ASSOC);

       //echo $row['idUsuario'];
   
       // // set values to object properties
        $this->Nombre = $row['Nombre'];
        $this->Apellido = $row['Apellido'];
        
       }
  }


function create(){

// query to insert record
$query = "INSERT INTO
            " . $this->table_name . "
        SET
            Nombre=:nombre, Apellido=:apellido, Puesto=:puesto ";

// prepare query
$stmt = $this->conn->prepare($query);

// sanitize
$this->Nombre=htmlspecialchars(strip_tags($this->Nombre));
$this->Apellido=htmlspecialchars(strip_tags($this->Apellido));
$this->Puesto=htmlspecialchars(strip_tags($this->Puesto));

// bind values
$stmt->bindParam(":nombre", $this->Nombre);
$stmt->bindParam(":apellido", $this->Apellido);
$stmt->bindParam(":puesto", $this->Puesto);

//echo $query;
// execute query
if($stmt->execute()){
    return true;
}

return false;
}

function getmax(){
        
    $qmax = "SELECT MAX(IdPersona) FROM persona";
    
     $stmt = $this->conn->prepare($qmax);
     
     $stmt->execute();
     
     $max = $stmt->fetchColumn();
 
    return $max;
}

}