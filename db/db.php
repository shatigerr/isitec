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

    function getCourseByUserEnrolled($id,$limit = null)
    {
        $result=false;
        $sql = $limit != null ? "SELECT * FROM usercourse WHERE idUser = :id LIMIT 4" : "SELECT * FROM usercourse WHERE idUser = :id" ;
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

    function getCourseById($id,$op=1){
        $result = false;

        $sql = $op == 1 ? "SELECT * FROM COURSES WHERE idCourse = :id"  : "SELECT c.*, v.id, v.name,v.video FROM COURSES c LEFT JOIN Videos v ON c.idCourse = v.idCourse WHERE c.idCourse = :id";
        try
        {
            $course = $this->conn->prepare($sql);
            $course->execute([":id"=>$id]);
            if($course->rowCount()>0){
                 
                $result = $course->fetchAll(PDO::FETCH_ASSOC);       
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
    }

    function getCountVideosWatched($idCourse,$idUser){
        //SELECT * FROM userVideo ;
        $result = false;
        $sql = "SELECT COUNT(*) as total FROM userVideo where iduser = :idU AND idCourse = :idC";
        try
        {
            $course = $this->conn->prepare($sql);
            $course->execute([":idU"=>$idUser,"idC"=>$idCourse]);
            if($course->rowCount()==1){
                 
                $result = $course->fetch(PDO::FETCH_ASSOC);       
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result["total"];
    }

    function getCourseVideos($idCourse){
        $result = false;
        $sql = "SELECT * FROM Videos WHERE idCourse = :id";
        try
        {
            $course = $this->conn->prepare($sql);
            $course->execute([":id"=>$idCourse]);
            if($course->rowCount()>0){
                 
                $result = $course->fetchAll(PDO::FETCH_ASSOC);       
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
    }

    function getVideoById($id){
        $result = false;
        $sql = "SELECT * FROM Videos WHERE id = :id";
        try
        {
            $course = $this->conn->prepare($sql);
            $course->execute([":id"=>$id]);
            if($course->rowCount()==1){
                 
                $result = $course->fetch(PDO::FETCH_ASSOC);       
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
    }
    function deleteOne($table, $id)
    {
        $arr = ["courses" => "idCourse", "videos" => "id"];
        $result = false;
        
        // Concatenamos los nombres de tabla y columna en la consulta SQL
        $sql = "DELETE FROM $table WHERE {$arr[$table]} = :id";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([":id" => (int)$id]);
            
            if ($stmt->rowCount() == 1) {
                $result = true;
            }
        } catch (PDOException $e) {
            echo "$e";
            $result = false;
        }

        return $result;
    }

    function insertOne($table, $data) {
        $result = false;
        
        // Verifica si la tabla y los datos no están vacíos
        if (!empty($table) && !empty($data)) {
            // Construye la consulta SQL dinámicamente
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_fill(0, count($data), '?'));
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            
            try {
                // Prepara la consulta SQL
                $stmt = $this->conn->prepare($sql);
    
                // Ejecuta la consulta con los valores de los datos
                $result = $stmt->execute(array_values($data));
    
                // Verifica si la inserción fue exitosa
                if ($result) {
                    // Retorna el ID del último registro insertado
                    $result = $this->conn->lastInsertId();
                }
            } catch(PDOException $e) {
                // Manejo de errores (puedes personalizar según tus necesidades)
                echo "Error: " . $e->getMessage();
            }
        }
        
        return $result;
    }

    function userEnrolled($idCourse,$idUser)
    {
        $result = false;
        $sql = "SELECT * FROM UserCourse WHERE idCourse = :idC AND idUser = :idU";
        try
        {
            $idC = intval($idCourse);
            $course = $this->conn->prepare($sql);
            $course->execute([":idC"=> $idC ,":idU" => $idUser]);
            if($course->rowCount()==1){
                
                $result = true;
            }
        }catch(PDOException $e)
        {
            echo $e;
            $result=false;
        }

        return $result;
    }

    function updateCourseLikesDislikes($currLikes,$idCourse,$type,$sum)
    {
        $sql = "UPDATE Courses SET $type = :likes WHERE idCourse = :id";
        try{
            $plus = (int)$currLikes+$sum;
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":likes"=>$plus,":id"=>(int)$idCourse]);
        }catch(PDOExecption $e){
            return false;
        }
        return $usuari->rowCount()==1; 
    }

    function updateUserCourseLikeDislike($type,$value,$idUser,$idCourse){ 
        $sql = "UPDATE userCourse SET $type = :likes WHERE idCourse = :idC AND idUser = :idU";
        try{
            $usuari = $this->conn->prepare($sql);
            $usuari->execute([":likes"=>$value,":idC"=>(int)$idCourse,":idU"=>$idUser]);
        }catch(PDOExecption $e){
            return false;
        }
        return $usuari->rowCount()==1;
    }

    function selectUserCourseLikeDislike($idCourse,$idUser,$type)
    {
        $result = false;
        $sql = "SELECT * FROM userCourse WHERE idCourse = :idC AND idUser = :idU";
        try
        {
            $course = $this->conn->prepare($sql);
            $course->execute([":idC"=>(int)$idCourse,":idU"=>$idUser]);
            if($course->rowCount()==1){
                 
                $userCourse = $course->fetch(PDO::FETCH_ASSOC);
                if($userCourse[$type])
                {
                    $result = true;
                }       
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
    }

    function getMorseLikedCourses($limit = null)
    {
        $result = false;
        $sql = $limit == null ? "SELECT * FROM courses ORDER BY likes DESC" : "SELECT * FROM courses ORDER BY likes DESC limit $limit";
        
        try
        {
            $course = $this->conn->prepare($sql);
            $course->execute();
            if($course->rowCount()>0){
                 
                $result = $course->fetchAll(PDO::FETCH_ASSOC);
                
                       
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
    }

    function getCoursesBySearch($search)
    {
        $result = false;
        $sql = "SELECT * FROM courses WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search OR LOWER(tags) LIKE :search" ;
        $search = '%' . strtolower($search) . '%'; // Agrega los porcentajes y convierte a minúsculas
        
        try
        {
            $course = $this->conn->prepare($sql);
            $course->execute([":search"=>$search]);
            if($course->rowCount()>0){
                 
                $result = $course->fetchAll(PDO::FETCH_ASSOC);
                
                       
            }
        }catch(PDOException $e)
        {
            $result=false;
        }

        return $result;
    }

    
}
   