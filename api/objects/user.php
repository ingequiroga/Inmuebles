<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "usuario";
 
    // object properties
    public $idUsuario;
    public $Email;
    public $Pass;
    public $IdPersona;
    public $IdRol;
  
    
    
  
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read users
    function read(){
     
        // select all query
        $query = "SELECT *
                FROM
                    " . $this->table_name . "";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    function readOne(){
     
          $query = "SELECT
                   *
                FROM
                    " . $this->table_name . " u
                WHERE
                    p.email = ?
                AND p.pass = ?
                ";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        //$stmt->bindParam(1, $this->id_usuario);
        $stmt->bindParam(1, $this->Email);
        $stmt->bindParam(2, $this->Pass);
     
        // execute query
        $stmt->execute();
        
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->idUsuario = $row['idUsuario'];
        $this->Email = $row['Email'];
        $this->IdPersonao = $row['IdPersona'];
        $this->IdRol = $row['IdRol'];
    }

    // login
     function login(){
     

         $query = "SELECT 
                         idUsuario, Email, IdPersona,IdRol  
                   FROM
                     " . $this->table_name . "
                 WHERE
                     Email= '".$this->Email."'
                 AND 
                     Pass='".$this->Pass."'";
     
    // //     // prepare query
        //echo $query;
     $stmt = $this->conn->prepare($query);
     
    // //     // sanitize
    // //     // $this->Email=htmlspecialchars(strip_tags($this->Email));
    // //     // $this->Pass=htmlspecialchars(strip_tags($this->Pass));
   
     
    // //     // bind values
    // //    // $stmt->bindParam(":email", $this->Email);
    // //   //  $stmt->bindParam(":pass", $this->Pass);
     
    // //     // execute query
      $stmt->execute();
    //   if($stmt->rowCount() > 0){
    //  // echo $stmt->rowCount();
    //   return true;
    //   }
    if($stmt->rowCount() > 0){ 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->idUsuario = $row['idUsuario'];
    $this->Email = $row['Email'];
    $this->IdPersona = $row['IdPersona'];
    $this->IdRol = $row['IdRol'];

    }
      //return $stmt;
         
      }
}