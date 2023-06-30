<?php
class SolicitudPass{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_solicitudpassword";
 
    // object properties
    public $id;
    public $clave;
    public $email;
    public $expira;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    function readOne(){
     
          $query = "SELECT
                   idUsuario,Email,IdPersona,IdRol
                FROM
                    " . $this->table_name . " 
                WHERE
                    email = ?
                ";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        //$stmt->bindParam(1, $this->id_usuario);
        $stmt->bindParam(1, $this->Email);

       
        // execute query
         $stmt->execute();
         if($stmt->rowCount() > 0){ 
                // // get retrieved row
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         //echo $row['idUsuario'];
     
         // // set values to object properties
          $this->idUsuario = $row['idUsuario'];
          $this->Email = $row['Email'];
          $this->IdPersonao = $row['IdPersona'];
          $this->IdRol = $row['IdRol'];
          $this->IdRol = $row['IdRol'];

         }
    }

  
function create(){
        $fechaactual = getdate();
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    clave=:clave, email=:email, expira=:expira";
     
        // prepare query
        $stmt = $this->conn->prepare($query);


        // sanitize
        $this->clave=htmlspecialchars(strip_tags($this->clave));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->expira=htmlspecialchars(strip_tags($this->expira));   

        
    
        // bind values
        $stmt->bindParam(":clave", $this->clave);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":expira", $this->expira);
       
     
        // execute query
        if($stmt->execute()){
             
      
            return true;
        }
     
        return false;
    }

    function obtenerClave(){
     
        $query = "SELECT 
                        idSolicitud,clave, expira
                  FROM
                    " . $this->table_name . "
                WHERE
                    clave= '".$this->clave."'
              ";

    $stmt = $this->conn->prepare($query);
   
     $stmt->execute();
   if($stmt->rowCount() > 0){ 
   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   $this->id = $row['idSolicitud'];
   $this->clave = $row['clave'];
   $this->expira = $row['expira'];
   $this->email = $row['email'];

   }
   
        
     }



}