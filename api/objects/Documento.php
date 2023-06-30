<?php
class Documento{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_documentos";
 
    // object properties
    public $Documento;
    public $IdAdquisicion;
    public $IdProceso;
    public $IdSubEtapa;
    public $FileName;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function ifexist(){
        $q = "SELECT count(IdDocumento)
        from tb_documentos
        where FileName = '". $this->FileName ."' 
        AND IdSubEtapa = '".$this->IdSubEtapa."'";
     
        $stmt = $this->conn->prepare($q);
        
        $stmt->execute();
        
        $max = $stmt->fetchColumn();
    
       return $max;
    } 

          // create Documento
    function create(){
     
        // query to insert record
        $query =

        "INSERT INTO tb_documentos (Documento,IdAdquisicion,IdProceso,IdSubEtapa,FileName)
        VALUES(:Documento,:idadquisicion,:idproceso,:idsubetapa,:filename)";

        
        //prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->Documento=htmlspecialchars(strip_tags($this->Documento));
        $this->idadquisicion=htmlspecialchars(strip_tags($this->IdAdquisicion));
        $this->Idproceso=htmlspecialchars(strip_tags($this->IdProceso));
        $this->idsubetapa=htmlspecialchars(strip_tags($this->IdSubEtapa));
        $this->filename=htmlspecialchars(strip_tags($this->FileName));

        // bind values
        $stmt->bindParam(":Documento", $this->Documento);
        $stmt->bindParam(":idadquisicion", $this->idadquisicion);
        $stmt->bindParam(":idproceso", $this->IdProceso);
        $stmt->bindParam(":idsubetapa", $this->idsubetapa);
        $stmt->bindParam(":filename", $this->filename);
     
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

    function readxSubEt(){
 
         $query = 
                    "SELECT 
                    Documento,FileName 
                    FROM tb_documentos
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
}