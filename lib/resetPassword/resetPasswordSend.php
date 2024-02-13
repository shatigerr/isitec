<?php

include_once(dirname(__FILE__). '/../forms.php');
if($_SERVER["REQUEST_METHOD"]== "GET")
{
    if($_GET["status"] == 1)
    {
        $code = isset($_GET["code"]) ? filter_input(INPUT_GET,"code",FILTER_SANITIZE_STRING) : "";
        $mail = isset($_GET["mail"]) ? filter_input(INPUT_GET,"mail",FILTER_SANITIZE_EMAIL) : "";

        
    }else{
        header("Location: /isitec/");
        die;
    }
}else if($_SERVER["REQUEST_METHOD"]== "POST"){
    
    $mail = isset($_POST["mail"])  ? filter_input(INPUT_POST,"mail",FILTER_SANITIZE_EMAIL) : "";
    $password = isset($_POST["password"])  ? filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING) : "";
    $confirmPassword = isset($_POST["confirmPassword"])>0  ? filter_input(INPUT_POST,"confirmPassword",FILTER_SANITIZE_STRING) : "";
    
    if(verifPassword($password,$confirmPassword) && !emailValidation($mail))
    {
        sendNewPassword($mail,$password);
    }

}


