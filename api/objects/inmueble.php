<?php
class Inmueble{
 
    // database connection and table name
    private $conn;
    private $table_name = "inmueble";
 
    // object properties
    public $IdInmueble;
    public $NumCredito;
    public $NameDeudor;
    public $LastDeudor;
    public $TipoAdquisicion;
    public $IdReoBan;
    public $CuentaCat;
    public $NumFolioReal;
    public $IdEtapa;
    public $IdEstado;
    public $IdMunicipio;
    public $Calle;
    public $CodigoPostal;
    public $M2superficie;
    public $M2construccion;
    public $MontoDeuda;
    public $MontoMin;
    public $MontoVenta;
    public $NumExpediente;
    public $ComentarioRegPub;
    public $ComentarioExpJudicial;
    public $EstatusInm;

    public $Etapa;
    public $Estado;
    public $Municipio;

    public $NombreDeudor;
    public $ApellidosDeudor;
    public $NomRec;
    public $NomEstado;
    public $NomMunic;
  
    //Proceso
    public $Idadquisicion;
    public $Idtabsubetapa;


  
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function readOne(){
     
    $query = 
      "
      SELECT 
      `NombreDeudor`,`ApellidosDeudor`,`NumCredito`,rcb.nombre as NomRec,inm.`IdEtapa`, et.Descripcion as Etapa, 
      inm.`IdEstado`,est.Nombre as NomEstado, inm.`IdMunicipio`,mun.Nombre as NomMunic,inm.Calle, inm.CodigoPostal, inm.M2superficie, inm.M2construccion, 
      inm.EstatusInmueble 
      FROM `inmuebles`.`inmueble` inm 
      INNER JOIN tb_recuperadorabanco rcb ON inm. IdReoBan = rcb.IdEntidad 
      INNER JOIN tb_etapas et ON et.IdEtapa = inm.IdEtapa
      INNER JOIN tb_estados est ON inm.IdEstado = est.IdEstado
      INNER JOIN tb_municipios mun ON mun.IdMunicipio = inm.IdMunicipio
      WHERE inm.IdInmueble = ?
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
        $this->NombreDeudor = $row['NombreDeudor'];
        $this->ApellidosDeudor = $row['ApellidosDeudor'];
        $this->NumCredito = $row['NumCredito'];
        $this->NomRec = $row['NomRec'];
        $this->IdEtapa = $row['IdEtapa'];
        $this->Etapa = $row['Etapa'];
        $this->IdEstado = $row['IdEstado'];
        $this->NomEstado = $row['NomEstado'];
        $this->IdMunicipio = $row['IdMunicipio'];
        $this->NomMunic = $row['NomMunic'];
        $this->Calle = $row['Calle'];
        $this->CodigoPostal = $row['CodigoPostal'];
        $this->M2superficie = $row['M2superficie'];
        $this->M2construccion = $row['M2construccion'];
        $this->EstatusInm = $row['EstatusInmueble'];
       }
  }

    // read products
    function read(){
     
        // select all query
        $query = 
                "SELECT 
                    `IdInmueble`,`NumCredito`,es.Nombre as Estado, mun.Nombre as Municipio, eta.Descripcion as Etapa 
                    FROM 
                    " . $this->table_name . " inm 
                    Inner JOIN tb_estados es ON inm.IdEstado = es.IdEstado
                    INNER JOIN tb_municipios mun ON inm.IdMunicipio = mun.IdMunicipio
                    INNER JOIN tb_etapas eta ON inm.IdEtapa = eta.IdEtapa";

     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

          // create product
    function create(){
     
        // query to insert record
        $query =
        "INSERT INTO 
            " . $this->table_name . "
            (`NumCredito`, `NombreDeudor`, `ApellidosDeudor`,`TipoAdquisicion`, `IdReoBan`, `CuentaCat`, 
        `NumFolioReal`, `IdEtapa`, `IdEstado`, `IdMunicipio`, `Calle`, `CodigoPostal`, `M2superficie`, `M2construccion`, 
        `MontoDeuda`, `MontoMin`, `MontoVenta`,`NumExpediente`, `ComentarioRegPub`, `ComentarioExpJudicial`,`EstatusInmueble`) 
        VALUES (:numcredito,:namedeudor,:lastdeudor,:tipodquisicion,:idreoban,:cuentacat,:numfolioreal,:idetapa,
        :idestado,:idmunicipio,:calle,:codigopostal,:m2superficie,:m2construccion,:montoDeuda,:montoMin,:montoVenta,
        :numexpediente,:comentarioregpub,:comentarioexpjudicial,:estatusinm)";

        
        //prepare query
        $stmt = $this->conn->prepare($query);
     
        // sanitize
        $this->numcredito=htmlspecialchars(strip_tags($this->numcredito));
        $this->namedeudor=htmlspecialchars(strip_tags($this->namedeudor));
        $this->lastdeudor=htmlspecialchars(strip_tags($this->lastdeudor));
        $this->tipodquisicion=htmlspecialchars(strip_tags($this->tipodquisicion));
        $this->idreoban=htmlspecialchars(strip_tags($this->idreoban));
        $this->cuentacat=htmlspecialchars(strip_tags($this->cuentacat));
        $this->numfolioreal=htmlspecialchars(strip_tags($this->numfolioreal));
        $this->idetapa=htmlspecialchars(strip_tags($this->idetapa));
        $this->idestado=htmlspecialchars(strip_tags($this->idestado));
        $this->idmunicipio=htmlspecialchars(strip_tags($this->idmunicipio));
        $this->calle=htmlspecialchars(strip_tags($this->calle));
        $this->codigopostal=htmlspecialchars(strip_tags($this->codigopostal));
        $this->m2superficie=htmlspecialchars(strip_tags($this->m2superficie));
        $this->m2construccion=htmlspecialchars(strip_tags($this->m2construccion));
        $this->montoDeuda=htmlspecialchars(strip_tags($this->montoDeuda));
        $this->montoMin=htmlspecialchars(strip_tags($this->montoMin));
        $this->montoVenta=htmlspecialchars(strip_tags($this->montoVenta));
        $this->numexpediente=htmlspecialchars(strip_tags($this->numexpediente));
        $this->comentarioregpub=htmlspecialchars(strip_tags($this->comentarioregpub));
        $this->comentarioexpjudicial=htmlspecialchars(strip_tags($this->comentarioexpjudicial));
        $this->estatusinm=htmlspecialchars(strip_tags($this->estatusinm));
     
        // bind values
        $stmt->bindParam(":numcredito", $this->numcredito);
        $stmt->bindParam(":namedeudor", $this->namedeudor);
        $stmt->bindParam(":lastdeudor", $this->lastdeudor);
        $stmt->bindParam(":tipodquisicion", $this->tipodquisicion);
        $stmt->bindParam(":idreoban", $this->idreoban);
        $stmt->bindParam(":cuentacat", $this->cuentacat);
        $stmt->bindParam(":numfolioreal", $this->numfolioreal);
        $stmt->bindParam(":idetapa", $this->idetapa);
        $stmt->bindParam(":idestado", $this->idestado);
        $stmt->bindParam(":idmunicipio", $this->idmunicipio);
        $stmt->bindParam(":calle", $this->calle);
        $stmt->bindParam(":codigopostal", $this->codigopostal);
        $stmt->bindParam(":m2superficie", $this->m2superficie);
        $stmt->bindParam(":m2construccion", $this->m2construccion);
        $stmt->bindParam(":montoDeuda", $this->montoDeuda);
        $stmt->bindParam(":montoMin", $this->montoMin);
        $stmt->bindParam(":montoVenta", $this->montoVenta);
        $stmt->bindParam(":numexpediente", $this->numexpediente);
        $stmt->bindParam(":comentarioregpub", $this->comentarioregpub);
        $stmt->bindParam(":comentarioexpjudicial", $this->comentarioexpjudicial);
        $stmt->bindParam(":estatusinm", $this->estatusinm);
     
     
        // execute query
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }

  
   

    function getmaxInm(){
        $qmax = "SELECT MAX(IdInmueble) FROM inmueble";
    
        $stmt = $this->conn->prepare($qmax);
        
        $stmt->execute();
        
        $max = $stmt->fetchColumn();
    
       return $max;
    }

   


}