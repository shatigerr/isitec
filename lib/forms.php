<?php


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
    if(preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$email)){
        $check = true;
        
    }

    return $check;
}


function userValidation(string $user)
{
    $check = false;
    

    return $check;
}


