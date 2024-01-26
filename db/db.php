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

    function getUserDataByuserOrMail($data,$type)
    {
        $result=false;;
        if($type == 1)
        {
            $sql = "SELECT * FROM users WHERE username = :username";
        }else if($type == 2)
        {
            $sql = "SELECT * FROM users WHERE mail = :username";
        }
        try
        {
            
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":username"=>$data]);
            if($usuari->rowCount()==1 ){
                $result = $usuari->fetch(PDO::FETCH_ASSOC);
                
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
    }

    
    
    
    function insertUser($userData) {
    
        try
        {
            $sql = "INSERT INTO users VALUES(null, :email, :username, :password, :name, :lastname, NOW(), null, null, 0)";
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":email"=>$userData["mail"], ":username"=>$userData["username"], "password"=>$userData["password"], ":name"=>$userData["fname"], ":lastname"=>$userData["lname"]]);
            if($usuari->rowCount()==1 ){
                $check=false;            
            }
        }catch(PDOException $e)
        {
            $check=false;
        }
    }
}
   