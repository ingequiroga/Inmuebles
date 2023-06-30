<?php
class Estado{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_estados";
 
    // object properties
    public $IdEstado;
    public $Nombre;
   
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
     
        // select all query
        $query = 
                "SELECT 
                    `IdEstado`,`Nombre` 
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