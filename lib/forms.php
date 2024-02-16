<?php
include_once(dirname(__FILE__). '/../db/db.php');
include_once('mailing.php');

$db = new DB();


const ERR = [
    "Passwords doesn't match",
    "E-mail already exists or incorrect format",
    "This username already exists"
];

function verifPassword(string $passwd,string $passwd2)
{
    $check = false;
    if(strlen($passwd)>0 && strlen($passwd2)>0 && $passwd == $passwd2){
        $check = true;
    }

    return $check;
}

function emailValidation(string $email)
{
    $check = false;
    global $db;
    if(preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$email) && $db->mailExists($email)){
        $check = true;
        
    }

    return $check;
}


function userValidation(string $user)
{

    global $db;
    return $db->userNamExists($user)  && strlen($user)>0;

}

function validation(bool $passwordVal,bool $mailVal,bool $userVal)
{
    $num=3;
    if(!$passwordVal)
    {
        $num = 0;
    }else if(!$mailVal){
        $num = 1;
    }else if(!$userVal){
        $num = 2;
    }
    return $num; 
}

function showModal($num,$type)
{
    $err;
    if(is_int($num))
    {
        if($type == 1)
        {
            $err = "<div class='adios'><p><i class='fa-solid fa-circle-exclamation'></i>".ERR[$num]."</p></div>";    
        }else if($type == 2)
        {
            if($num == 1){

                $err = "<div class='verif'><p><i class='fa-solid fa-check'></i>Activation code sent through email</p></div>";    
            } else if($num == 2)
            {
                $err = "<div class='adios'><p><i class='fa-solid fa-circle-exclamation'></i>Username or password incorrect or</p></div>";
            }else if($num == 3){
                $err = "<div class='adios'><p><i class='fa-solid fa-circle-exclamation'></i>Isitec account not activated or doesn't exist</p></div>";
            }
        }
        
    }else{
        $err = "";
    }
    
    return $err;
}

function registerUser($userData)
{
    global $db;
    $random_number = rand(100, 1000 - 1) * 73;
    $random_hash = hash('sha256', $random_number);  

    $userData["password"] = password_hash($userData["password"],PASSWORD_DEFAULT);
    
    $db->insertUser($userData,$random_hash);
    
    sendVerificacionCode($random_hash,$userData["mail"]);
}

function loginUser($username,$passwd)
{
    global $db;
    $check = false;
    $result;
    if(preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$username))
    {
        $result = $db->getUserDataByuserOrMail($username,2);
        
    }else{
        $result = $db->getUserDataByuserOrMail($username,1);
    }
    //FALTA CONTROLAR USUARIO ACTIVO
    if($result != false && $result["active"] == "1" && password_verify($passwd,$result["passHash"]))
    {
        $check = true;
    }

    return $check;
}

function updateLogin($user)
{
    global $db;
    $db->updateLastSignIn($user);
}

function updateLogOut($user) 
{
    global $db;
    $db->updateActiveStatus(0, $user);
}

function activateAccount($mail, $hash)
{
    global $db;
    $results = $db->getUserDataByuserOrMail($mail, 2);

    if ($results["activationDate"] > date('Y-m-j H:i:s') && $results["activationCode"] == $hash)
    {
        $db->updateActiveStatus(1, $results["username"]);
    }
}

function sendPasswordCode($email)
{
    global $db;
    $random_number = rand(100, 1000 - 1) * 73;
    $random_hash = hash('sha256', $random_number);
    $db->updatePasswordCode($random_hash,$email);
    sendModifyPassword($random_hash,$email);
}

function updatePassword($email,$password)
{
    //Contolar la hora!!!!!!!
    global $db;
    
    $user = $db->getUserDataByuserOrMail($email,2);
    if($user["resetPassExpiry"]> date('Y-m-j H:i:s'))
    {

        $passwd = password_hash($password,PASSWORD_DEFAULT);
        $db->updatePassword($email,$passwd);
    }
}

function verifActiveUser($user) {
    global $db;
    $check = false;
    if (emailValidation($user) || !userValidation($user)) {
        $check = $db->verifiyActiveUser($user);   
    }

    return $check;
}
