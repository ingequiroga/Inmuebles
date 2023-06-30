<?php
class Catalogo{
 
    // database connection and table name
    private $conn;
    private $table_name = "catalogosdet";
 
    // object properties
    public $IdMae;
    public $IdDet;
    public $Descripcion;
   
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
function readById(){
        // select all query
        $query = 
                "SELECT 
                    `CatD_Descripcion` 
                    FROM 
                    " . $this->table_name . " 
                    WHERE `CatD_Estatus` = 171
                    AND `CatD_Id` = '".$this->IdDet."'";

        // prepare query statement
        //echo $query;
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->Descripcion = $row['CatD_Descripcion'];
        }
    }
}