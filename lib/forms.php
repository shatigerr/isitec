<?php

include_once(dirname(__FILE__). '/../db/db.php');

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

function showError($num)
{
    $err;
    if(is_int($num))
    {
        $err = "<div class='adios'><p><i class='fa-solid fa-circle-exclamation'></i>".ERR[$num]."</p></div>";    
    }else{
        $err = "";
    }
    
    return $err;
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

                $err = "<div class='verif'><p><i class='fa-solid fa-circle-exclamation'></i>User created succcesfully</p></div>";    
            } else if($num == 2)
            {
                $err = "<div class='adios'><p><i class='fa-solid fa-circle-exclamation'></i>Username or password incorrect</p></div>";
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

    $userData["password"] = password_hash($userData["password"],PASSWORD_DEFAULT);
    $db->insertUser($userData);
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

    if($result != false && password_verify($passwd,$result["passHash"]))
    {
        $check = true;
    }

    return $check;
}
