<?php

include_once("config.php");

class DB{
    private $conn;
    
    public function __construct(){
        
        $this->conn = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_DATABASE."", DB_USER, DB_PASSWORD);
        
    }

    function userNamExists($name)
    {
        $check=true;
        
        try
        {
    
            $sql = "SELECT * FROM users WHERE username = :username";
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":username"=>$name]);
            if($usuari->rowCount()==1 ){
                $check=false;            
                
            }
        }catch(PDOException $e)
        {
            $check=false;
        }

        return $check;
    }
    
    function mailExists($mail)
    {
        $check=true;
        
        try
        {
    
            $sql = "SELECT * FROM users WHERE mail = :mail";
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":mail"=>$mail]);
            if($usuari->rowCount()==1 ){
                $check=false;            
                
            }
        }catch(PDOException $e)
        {
            $check=false;
        }

        return $check;
    }
    
}
   