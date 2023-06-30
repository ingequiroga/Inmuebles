<?php
class RecoBanco{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_recuperadorabanco";
 
    // object properties
    public $IdEntidad;
    public $Tipo;
    public $Nombre;
   
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }



    function existeEnt(){

        $query = 
        "SELECT Count(IdEntidad) as num
        FROM tb_recuperadorabanco
        where Tipo = '".$this->Tipo."'
        AND Nombre = '".$this->Nombre."'"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $numelements = $stmt->fetchColumn();
        if($numelements == 0){
            
            return true;
        }
     
         return false;
    }

    function create(){
        $query = 
        "INSERT INTO tb_recuperadorabanco(Tipo,Nombre)
        VALUES(".$this->Tipo.",'".$this->Nombre."')";

        $stmt = $this->conn->prepare($query);

          // execute query
          if($stmt->execute()){
            return true;
        }
     
        return false;     
    }


}