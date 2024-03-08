<?php
    include_once("./lib/forms.php");
    $err="";
    $verif="";
    if($_SERVER["REQUEST_METHOD"]=="GET")
    {
        if(isset($_COOKIE["PHPSESSID"]))
        {
            header("Location:/views/home.php");
        }
        $verif = isset($_GET["v"]) ? (int)$_GET["v"] : "";
    }else if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if (isset($_POST["login"]))
        {
            loginProcess();
        }
        else if (isset($_POST["send"])) {
            
            $email = strlen($_POST["email"])>0  ? filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING) : "";
            if(!emailValidation($email))
            {
                sendPasswordCode($email);   
            }else{
                $err = "EMAIL DOESN'T EXISTS";
            }
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="./js/modal.js" ></script>
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    

    <title>Login</title>
</head>
<body>
    <?= showModal($verif,2) ?>
    <main id="main">

        <div class="img-container">
            <!-- imagen -->
            <img class="img" src="./img/estudianteisitec_1.webp" alt="Estudiando en isitec">
        </div>
        
        <form action="./index.php" method="POST">
            <div class="container">
                <header>
                    <h1>Welcome to Isitec</h1>
                    <p>Where learning tech is now isi</p>
                </header>

                <div>
                    <label for="username"><i class="fa-regular fa-envelope"></i></label>
                    <input type="text" placeholder="Mail or username" name="username" id="username">   
                </div>

                <div>
                    <label for="password"><i class="fa-solid fa-key"></i></label>
                    <input type="password" name="password" placeholder="Password" id="password">    
                </div>
                <div class="reset-password-container">
                    <a id="a" class="a-reset-password" >Change or reset password</a>
                </div>

                <div>
                    <button class="login-btn" type="submit" name="login">Login <i class="fa-solid fa-arrow-right-to-bracket fa-md"></i></button>
                    <a href="./views/register.php" class="signup-btn">Sing up <i class="fa-solid fa-user-plus"></i></a>
                </div>
                <div>
                    <img class="logo" src="./img/logoIsitec_1.webp" alt="">
                    
                </div>
            </div>
            

        </form>
    </main>

    <dialog id="dialog">
        <div>
            <form id="dialog-Form" action="./index.php" method="POST">
                <div class="dialog-top">
                    <h3>Enter your Email</h3>
                    <input id="popInput" placeholder="Email" name="email" type="email">
                    <?= $err ?>
                </div>
                <div id="popButtonsContainer" class="dialog-bot">
                    <button id="send" name="send" type="submit">Send<i class="fa-regular fa-paper-plane"></i></button>
                    <button id="cancel">Close<i class="fa-regular fa-circle-xmark"></i></button>
                </div>
            </form>
        </div>
    </dialog>
</body>
</html>