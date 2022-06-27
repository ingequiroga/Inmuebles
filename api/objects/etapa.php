<?php
class Etapa{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_etapas";
 
    // object properties
    public $IdEtapa;
    public $Descripcion;
   
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
     
        // select all query
        $query = 
                "SELECT 
                    `IdEtapa`,`Descripcion` 
                    FROM 
                    " . $this->table_name . " 
                    WHERE `Estatus` = 171";

     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
}