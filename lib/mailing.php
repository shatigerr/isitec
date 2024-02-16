<?php
include_once dirname(__FILE__) . '/../db/config.php';

use PHPMailer\PHPMailer\PHPMailer;
require_once dirname(__FILE__) . '/../vendor/autoload.php';

function sendVerificacionCode($code, $email)
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
    $mail->SetFrom(MAIL_USER, 'Activate your acount');
    $mail->Subject = 'Isitec acount activation';
    $htmlContent = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Correo corporativo</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                }
                h1 {
                    color: #282d7f;
                }
                p {
                    color: #282d7f;
                    line-height: 1.6;
                }
                button {
                    display: inline-block;
                    outline: 0;
                    border: 0;
                    cursor: pointer;
                    background-color: #282d7f;
                    border-radius: 4px;
                    padding: 12px;
                }
                
                .button {
                    text-decoration: none;
                    font-weight: 700;
                    font-size: 14px;
                    color: white !important;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Hello <span style="color: #282d7f;">' . $email . '</span>,</h1>
                <p>Thank you for registering with our service. We are pleased to welcome you to our community.</p>
                <p>To begin enjoying all the features of our service, simply click the following button to confirm your registration:</p>
                <button><a class="button" href="http://127.0.0.1/isitec/lib/mailCheckAccount.php?code=' . $code . '&mail=' . $email . '">Confirm Registration</a></button>
                <p>If you have any questions or need assistance, feel free to contact us.</p>
                <p>Thank you!</p>
            </div>        
        </body>
        </html>';

    $mail->MsgHTML($htmlContent);

    $address = $email;
    $mail->AddAddress($address);

    $result = $mail->Send();
    if (!$result) {
        echo 'Error: ' . $mail->ErrorInfo;
    } else {
        echo "Correu enviat";
    }

}

function sendModifyPassword($code, $email)
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
    $mail->SetFrom(MAIL_USER, 'Reset your password');
    $mail->Subject = 'Isitec reset password';

    $htmlContent = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Correo corporativo</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f2f2f2;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                }
                h1 {
                    color: #282d7f;
                }
                p {
                    color: #282d7f;
                    line-height: 1.6;
                }
                button {
                    display: inline-block;
                    outline: 0;
                    border: 0;
                    cursor: pointer;
                    background-color: #282d7f;
                    border-radius: 4px;
                    padding: 12px;
                }
                
                .button {
                    text-decoration: none;
                    font-weight: 700;
                    font-size: 14px;
                    color: white !important;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Hello ' . $email . ',</h1>
                <p>We received a request to reset your password. If you made this request, please click the button below to reset your password. If you didn\'t make this request, you can safely ignore this email.</p>
                <button><a class="button" href="http://127.0.0.1/isitec/views/resetPassword.php?code=' . $code . '&mail=' . $email . '&status=1">Reset Password</a></button>
                <p>If the button above doesn\'t work, you can also copy and paste the following link into your web browser:</p>
                <p>If you need further assistance, please contact our support team.</p>
                <p>Thank you!</p>
            </div>
        </body>
        </html>';

    $mail->MsgHTML($htmlContent);

    $address = $email;
    $mail->AddAddress($address);

    $result = $mail->Send();
    if (!$result) {
        echo 'Error: ' . $mail->ErrorInfo;
    }
}
