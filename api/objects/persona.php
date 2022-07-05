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