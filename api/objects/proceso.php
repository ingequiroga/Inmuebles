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

    public function __construct($db){
        $this->conn = $db;
    }
    

    function readOne(){
     
        $query = 
          "
          SELECT 
          `IdAdquisicion`,`IdEtapa`,`PorcProceso`,Estatus
          FROM inmuebles.tb_adquisicion
          WHERE IdInmueble = ?
          ";    
          
       
          // prepare query statement
          $stmt = $this->conn->prepare( $query );
       
          // bind id of product to be updated
          //$stmt->bindParam(1, $this->id_usuario);
          $stmt->bindParam(1, $this->IdInmueble);
    
         
          // execute query
           $stmt->execute();
           if($stmt->rowCount() > 0){ 
                  // // get retrieved row
           $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
           //echo $row['idUsuario'];
       
           // // set values to object properties
            $this->IdAdquisicion = $row['IdAdquisicion'];
            $this->IdEtapa = $row['IdEtapa'];
            $this->PorcProceso = $row['PorcProceso'];
            $this->Estatus = $row['Estatus'];

           }
      }

      function createProceso(){
     
        // query to insert record
  
        $query =
        "INSERT INTO 
            tb_adquisicion
            (`IdInmueble`, `IdEtapa`, `PorcProceso`) 
        VALUES (:idinmueble,1,0)";

        
        //prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->idinmueble=htmlspecialchars(strip_tags($this->IdInmueble));
        // bind values
        $stmt->bindParam(":idinmueble", $this->idinmueble);
        // execute query
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

    
}