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

    function getUserDataByuserOrMail($data)
    {
        $result=false;
        $sql = "SELECT * FROM users WHERE (mail = :username OR username = :username)";
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
    
    function insertUser($userData,$hash) {
        $check=false;
        try
        {
            $sql = "INSERT INTO users VALUES(null, :email, :username, :password, :name, :lastname, NOW(), null, null, 0, ADDTIME(NOW(),'00:30:00'), :activationCode, null, null)";
            $usuari = $this->conn->prepare($sql);

            $usuari->execute([":email"=>$userData["mail"], ":username"=>$userData["username"], "password"=>$userData["password"], ":name"=>$userData["fname"], ":lastname"=>$userData["lname"], ":activationCode"=>$hash]);
            if($usuari->rowCount()==1 ){
                $check=true;            
            }
        }catch(PDOException $e)
        {
            echo $e;
            $check=false;
        }

        return $check;
    }

    function updateActiveStatus(int $num,string $user)
    {
        
        $sql = "UPDATE users SET active = :active WHERE username = :user";
        try{
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":active"=>$num,":user"=>$user]);
        }catch(PDOExecption $e){
            return false;
        }
        return $usuari->rowCount()==1;

    }

    function updateLastSignIn($user)
    {
        $sql = "UPDATE users SET lastSignIn = NOW() WHERE username = :user";
        try{
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":user"=>$user]);
        }catch(PDOExecption $e){
            return false;
        }
        return $usuari->rowCount()==1;
    }

    function updatePasswordCode($hash,$email)
    {
        $sql = "UPDATE users SET resetPassExpiry = ADDTIME(NOW(),'00:30:00'), resetPassCode=:passcode WHERE mail = :mail";
        try{
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":passcode"=>$hash,":mail"=>$email]);
        }catch(PDOExecption $e){
            return false;
        }
        return $usuari->rowCount()==1; 
    }

    function updatePassword($email,$password)
    {
        $sql = "UPDATE users SET passHash = :pass WHERE mail = :mail";
        try{
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":pass"=>$password,":mail"=>$email]);
        }catch(PDOExecption $e){
            return false;
        }
        return $usuari->rowCount()==1; 
    }

    function verifiyActiveUser($user)
    {
        $sql = "SELECT * FROM users WHERE active = '1' AND (mail = :mail OR username = :mail)";
        try{
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":mail"=>$user]);
        }catch(PDOExecption $e){
            return false;
        }
        return $usuari->rowCount()==1; 
    }

    function insertCourse($data,$id,$imagePath=null)
    {
        $check=false;
        try
        {
            $sql = "INSERT INTO courses VALUES(null, :title, :description, NOW(), 0, 0, :image, :idUser, :tags)";
            $course = $this->conn->prepare($sql);

            $course->execute([":title"=>$data["title"], ":description"=>$data["description"], ":image"=>$imagePath, ":idUser"=>$id, ":tags"=>$data["tags"]]);
            if($course->rowCount()==1 ){
                $check=true;            
            }
        }catch(PDOException $e)
        {
            echo $e;
            $check=false;
        }

        return $check;
    }

    function getCourses($limit = 0){

        $result=false;
        $sql = $limit > 0 ?"SELECT * FROM courses order by publicationDate DESC LIMIT :limite" : "SELECT * FROM courses order by publicationDate DESC" ;
        try
        {
            $usuari = $this->conn->prepare($sql);
            if ($limit > 0) {
                $usuari->bindParam(':limite', $limit, PDO::PARAM_INT);
            }    
            $usuari->execute();
            if($usuari->rowCount()>0 ){
                 
                $result = $usuari->fetchAll(PDO::FETCH_ASSOC);
                
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
        

    }

    function getCourseByAuthor($id)
    {
        $result=false;
        $sql = "SELECT * FROM courses WHERE idUser = :id order by publicationDate DESC";
        try
        {
            
            $usuari = $this->conn->prepare($sql);
            $usuari->execute(["id"=>$id]);
            if($usuari->rowCount()>0 ){
                 
                $result = $usuari->fetchAll(PDO::FETCH_ASSOC);
                
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
    }
}
   