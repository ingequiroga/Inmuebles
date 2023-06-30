<?php
class Municipio{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_municipios";
 
    // object properties
    public $IdMunicipio;
    public $Nombre;
    public $IdEstado;
   
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
     
        // select all query
        $query = 
                "SELECT 
                `IdMunicipio`,`Nombre`,`IdEstado` 
                FROM 
                " . $this->table_name . " 
                WHERE `Estatus` = 171";

     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function readxestado(){
     
        // select all query
               
         $query = "SELECT 
         IdMunicipio,Nombre  
        FROM
            " . $this->table_name . "
        WHERE
            IdEstado= '".$this->IdEstado."'
        AND 
            `Estatus`=171";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function existeMun(){

        $query = 
        "SELECT Count(IdMunicipio) as num
        FROM tb_municipios
        where IdEstado = '".$this->IdEstado."'
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
        "INSERT INTO tb_municipios(IdEstado,Nombre)
        VALUES(".$this->IdEstado.",'".$this->Nombre."')";

        $stmt = $this->conn->prepare($query);

          // execute query
          if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }


}