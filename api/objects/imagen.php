<?php
class Imagen{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_imagenes";
 
    // object properties
    public $Image;
    public $IdInmueble;
    public $FileName;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function ifexist(){
        $q = "SELECT count(IdImagen)
        from tb_imagenes
        where FileName = '". $this->FileName ."' 
        AND IdSubEtapa = '".$this->IdSubEtapa."'";
     
        $stmt = $this->conn->prepare($q);
        
        $stmt->execute();
        
        $max = $stmt->fetchColumn();
    
       return $max;
    } 

          // create Images
    function create(){
     
        // query to insert record
        $query =

        "INSERT INTO tb_imagenes (Image,FileName,IdInmueble)
        VALUES(:Image,:filename,:IdInmueble)";

        
        //prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Image=htmlspecialchars(strip_tags($this->Image));
        $this->filename=htmlspecialchars(strip_tags($this->FileName));
        $this->IdInmueble=htmlspecialchars(strip_tags($this->IdInmueble));

        // bind values
        $stmt->bindParam(":Image", $this->Image);
        $stmt->bindParam(":filename", $this->filename);
        $stmt->bindParam(":IdInmueble", $this->IdInmueble);
     
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

    function readxSubEt(){
 
         $query = 
                    "SELECT 
                    Image,FileName 
                    FROM tb_imagenes
                    where IdAdquisicion = '". $this->IdAdquisicion ."'
                    AND IdProceso = '". $this->IdProceso ."'
                    AND IdSubEtapa = '". $this->IdSubEtapa."'";


 
         // prepare query statement
         $stmt = $this->conn->prepare($query);
      
         //echo $query;
         // execute query
         $stmt->execute();
      
         return $stmt;
     }

     function readonebyinmueble(){
        $query = 
                    "SELECT 
                    Image,FileName 
                    FROM tb_imagenes
                    where IdInmueble = '". $this->IdInmueble ."'";

         // prepare query statement
         $stmt = $this->conn->prepare($query);
      
         //echo $query;
         // execute query
         $stmt->execute();
      
         return $stmt;
     }

     function borrarImagenes(){
        $query = 
            "Delete
            From tb_imagenes
            WHERE IdInmueble = :IdInmueble";

            //prepare query
         $stmt = $this->conn->prepare($query);

          // sanitize
         $this->IdInmueble=htmlspecialchars(strip_tags($this->IdInmueble));
          // bind values
        $stmt->bindParam(":IdInmueble", $this->IdInmueble);
       
        // execute query
        if($stmt->execute()){
            return true;
        }
         
            return false;

        
     }

    }

