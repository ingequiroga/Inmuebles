<?php
class SubEtapa{

       // database connection and table name
       private $conn;
       private $table_name = "tb_subetapas";

         // object properties
    public $Idadquisicion;
    public $Idtabsubetapa;

    public $IdSubEtapa;
    public $idEtapa;
    public $Comentarios;
    public $Estatus;
    public $FechaCompletado;

    public function __construct($db){
        $this->conn = $db;
    }

    function readxProc(){
       //echo $this->IdAdquisicion;
        // select all query
        $query = 
                "SELECT 
                 su.IdSubEtapa,su.Value, su.IdAdquisicion,su.IdTabsubetapa,su.Comentarios,su.Estatus,ts.Descripcion  
                 FROM inmuebles.tb_subetapas su
                 INNER JOIN tb_tab_subetapas ts ON su.IdTabsubetapa = ts.IdTabsubetapa
                 where IdAdquisicion = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->IdAdquisicion);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
 
    

      function createSubEtapas(){
     
        // query to insert record
        //echo $this->Idtabsubetapa;
        $query =
        "INSERT INTO 
            tb_subetapas
            (`Value`,`IdAdquisicion`,`IdTabsubetapa`) 
            VALUES (0,:idadquisicion,:idtabsubetapa)";
 
        
        //prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->idadquisicion=htmlspecialchars(strip_tags($this->Idadquisicion));
        $this->idtabsubetapa=htmlspecialchars(strip_tags($this->Idtabsubetapa));
        // bind values
        $stmt->bindParam(":idadquisicion", $this->idadquisicion);
        $stmt->bindParam(":idtabsubetapa", $this->idtabsubetapa);
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }   

    function UpdateSubEtapas(){
        $query = 
        "UPDATE tb_subetapas
            set Comentarios = :comentarios, Estatus = :estatus, FechaCompletado = CURDATE()
            where IdAdquisicion = :idadquisicion
            AND IdSubEtapa = :idsubetapa";

         //prepare query
         $stmt = $this->conn->prepare($query);
     
         // sanitize
         $this->idadquisicion=htmlspecialchars(strip_tags($this->Idadquisicion));
         $this->idsubetapa=htmlspecialchars(strip_tags($this->IdSubEtapa));
         $this->comentarios=htmlspecialchars(strip_tags($this->Comentarios));
         $this->estatus=htmlspecialchars(strip_tags($this->Estatus));

         $stmt->bindParam(":idadquisicion", $this->Idadquisicion);
         $stmt->bindParam(":idsubetapa", $this->IdSubEtapa);
         $stmt->bindParam(":comentarios", $this->Comentarios);
         $stmt->bindParam(":estatus", $this->Estatus);

         // execute query
         if($stmt->execute()){
             return true;
         }


    }





    
}