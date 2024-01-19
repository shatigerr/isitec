<?php

include_once("../db/db.php");

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
