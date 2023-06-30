<?php
class Proceso{

       // database connection and table name
       private $conn;
       private $table_name = "tb_adquisicion";

         // object properties
    public $IdInmueble;
    public $Idadquisicion;
    public $Idtabsubetapa;
    public $PorcProceso;
    public $Estatus;
    public $IdEtapa;
    public $IdProceso;

    public function __construct($db){
        $this->conn = $db;
    }
    

    function readOne(){
     
        $query = 
          "
          SELECT 
          `IdAdquisicion`,`IdEtapa`,IdProceso,`PorcProceso`,Estatus
          FROM tb_adquisicion
          WHERE IdInmueble = ?
          AND IdProceso = ?
          ";    
          
         
          // prepare query statement
          $stmt = $this->conn->prepare( $query );
       
          // bind id of product to be updated
          //$stmt->bindParam(1, $this->id_usuario);
          $stmt->bindParam(1, $this->IdInmueble);
          $stmt->bindParam(2, $this->IdProceso);
    
          
          // execute query
           $stmt->execute();
        
           if($stmt->rowCount() > 0){ 

                  // // get retrieved row
           $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
          
           // // set values to object properties
            $this->IdAdquisicion = $row['IdAdquisicion'];
            $this->IdEtapa = $row['IdEtapa'];
            $this->IdProceso = $row['IdProceso'];
            $this->PorcProceso = $row['PorcProceso'];
            $this->Estatus = $row['Estatus'];

           }
      }

      function createProceso(){
     
        // query to insert record
  
        $query =
        "INSERT INTO 
            tb_adquisicion
            (`IdInmueble`, `IdEtapa`,`IdProceso`,`PorcProceso`) 
        VALUES (:idinmueble,0,:idproceso,0)";

        
        //prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->idinmueble=htmlspecialchars(strip_tags($this->IdInmueble));
        $this->idproceso=htmlspecialchars(strip_tags($this->IdProceso));
        // bind values
        $stmt->bindParam(":idinmueble", $this->idinmueble);
        $stmt->bindParam(":idproceso", $this->IdProceso);
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

    function InsertProceso(){
     
        // query to insert record
  
        $query =
        "INSERT INTO 
            tb_adquisicion
            (`IdInmueble`, `IdEtapa`,`IdProceso`,`PorcProceso`) 
        VALUES (:idinmueble,:idetapa,:idproceso,0)";

        //echo $this->IdEtapa;
        //prepare query
         $stmt = $this->conn->prepare($query);
     
        // // sanitize
         $this->idinmueble=htmlspecialchars(strip_tags($this->IdInmueble));
         $this->IdEtapa=htmlspecialchars(strip_tags($this->IdEtapa));
         $this->IdProceso=htmlspecialchars(strip_tags($this->IdProceso));
        // // bind values
         $stmt->bindParam(":idinmueble", $this->IdInmueble);
         $stmt->bindParam(":idetapa", $this->IdEtapa);
         $stmt->bindParam(":idproceso", $this->IdProceso);

       
        // // execute query
         if($stmt->execute()){
                 return true;
         }
     
        return false;
         
    }

    function CerrarProceso(){
     
        // query to insert record
  
        $query =
        "UPDATE tb_adquisicion 
        set Estatus = 'Cerrado',
        FechaCierre = CURDATE()
        where IdAdquisicion = :idadquisicion";
        
        //prepare query
         $stmt = $this->conn->prepare($query);
     
        // // sanitize
         $this->idadquisicion=htmlspecialchars(strip_tags($this->Idadquisicion));
        
        // // bind values
         $stmt->bindParam(":idadquisicion", $this->Idadquisicion);
        // // execute query
         if($stmt->execute()){
            return true;
         }
     
        return false;
         
    }

    function getmaxproc(){
        $qmax = "SELECT MAX(IdAdquisicion) FROM tb_adquisicion";
    
        $stmt = $this->conn->prepare($qmax);
        
        $stmt->execute();
        
        $max = $stmt->fetchColumn();
    
       return $max;
    }

    // function updateEtapa(){
    //     $query =
    //     "update tb_adquisicion
    //     set IdEtapa = 1, PorcProceso = 0
    //     where IdAdquisicion = 14
    //}

    
}