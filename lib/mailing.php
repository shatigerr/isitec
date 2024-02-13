<?php
include_once(dirname(__FILE__). '/../db/config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    require_once (dirname(__FILE__). '/../vendor/autoload.php');
    
    

    function sendVerificacionCode($code,$email)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        $mail->Username = MAIL_USER;
        $mail->Password = MAIL_PASSWORD;
        $mail->SetFrom(MAIL_USER,'Activate your acount');
        $mail->Subject = 'Isitec acount activation';
        $mail->MsgHTML("<html><div>
                            <h1>Hello {$email}, activate your account with the following link</h1>
                            <a href='http://127.0.0.1/isitec/lib/mailCheckAccount.php?code={$code}&mail={$email}'>Activate your account!!!</a>
                        <div></html>");
        $address = $email;
        $mail->AddAddress($address);
    
        $result = $mail->Send();
        if(!$result){
        echo 'Error: ' . $mail->ErrorInfo;
        }else{
            echo "Correu enviat";
        }
        
    }

    function sendModifyPassword($code,$email)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        $mail->Username = MAIL_USER;
        $mail->Password = MAIL_PASSWORD;
        $mail->SetFrom(MAIL_USER,'Activate your acount');
        $mail->Subject = 'Isitec acount activation';
        $mail->MsgHTML("<html><div>
                            <h1>Hello {$email}, Confirm your new password with the following link</h1>
                            <a href='http://127.0.0.1/isitec/lib/resetPassword/resetPasswordSend.php?code={$code}&mail={$email}&status=1'>Activate your account!!!</a>
                        <div></html>");
        $address = $email;
        $mail->AddAddress($address);
    
        $result = $mail->Send();
        if(!$result){
        echo 'Error: ' . $mail->ErrorInfo;
        }else{
            echo "Correu enviat";
        }
    }
    

    
