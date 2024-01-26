<?php
include_once(dirname(__FILE__). '/../db/config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

    $mail->Username = MAIL_USER;
    $mail->Password = MAIL_PASSWORD;

    function sendVerificacionCode()
    {
        //Enviar dades per email
        $mail->SetFrom(MAIL_USER,'Activa tu cuenta');
        $mail->Subject = 'Correu de test';
        $mail->MsgHTML('Prova');
        $address = 'Nada';
        $mail->AddAddress($address, 'Test');
    }

    function sendModifyPassword()
    {

    }



    

    $result = $mail->Send();
    if(!$result){
        echo 'Error: ' . $mail->ErrorInfo;
    }else{
        echo "Correu enviat";
    }
