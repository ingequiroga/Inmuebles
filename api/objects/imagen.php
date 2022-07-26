<?php
class Imagen{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_imagenes";
 
    // object properties
    public $Image;
    public $IdAdquisicion;
    public $IdEtapa;
    public $IdSubEtapa;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


          // create Images
    function create(){
     
        // query to insert record
        $query =

        "INSERT INTO tb_imagenes (Image,IdAdquisicion,IdEtapa,IdSubEtapa)
        VALUES(:Image,:idadquisicion,:idetapa,:idsubetapa)";

        
        //prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Image=htmlspecialchars(strip_tags($this->Image));
        $this->idadquisicion=htmlspecialchars(strip_tags($this->IdAdquisicion));
        $this->idetapa=htmlspecialchars(strip_tags($this->IdEtapa));
        $this->idsubetapa=htmlspecialchars(strip_tags($this->IdSubEtapa));

        // bind values
        $stmt->bindParam(":Image", $this->Image);
        $stmt->bindParam(":idadquisicion", $this->idadquisicion);
        $stmt->bindParam(":idetapa", $this->idetapa);
        $stmt->bindParam(":idsubetapa", $this->idsubetapa);
     
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }
}