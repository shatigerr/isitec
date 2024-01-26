<?php
    include_once("../lib/forms.php");
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $username = strlen($_POST["username"])>0  ? filter_input(INPUT_POST,"username",FILTER_SANITIZE_STRING) : "";
        $fname = strlen($_POST["fname"])>0  ? filter_input(INPUT_POST,"fname",FILTER_SANITIZE_STRING) : "";
        $lname = strlen($_POST["lname"])>0  ? filter_input(INPUT_POST,"lname",FILTER_SANITIZE_STRING) : "";
        $mail = strlen($_POST["mail"])>0  ? filter_input(INPUT_POST,"mail",FILTER_SANITIZE_STRING) : "";
        $password = strlen($_POST["password"])>0  ? filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING) : "";
        $cpasswd = strlen($_POST["cpasswd"])>0  ? filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING) : "";

        $num = validation(verifPassword($password,$cpasswd),emailValidation($mail),userValidation($username));
        if($num < 3)
        {
            header("Location:/isitec/views/register.php?e=$num");
        }else{
            registerUser($_POST);
            header("Location:/isitec/index.php?v=1");
        }
    }else if($_SERVER["REQUEST_METHOD"]=="GET")
    {
        $error = isset($_GET["e"]) ? (int)$_GET["e"] : "";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="../js/formValidation.js"></script>
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>


    <title>Join us!!</title>
</head>
<body>
    
    <?= showModal($error,1) ?>
    <main>

        <form action="<?=$_SERVER['PHP_SELF']; ?>" method="POST">
            
            <div class="container">
                <header>
                    <h1>Join now!!</h1>
                    <p>And learn with us</p>
                </header>

                <div>
                    <label for="username"><i class="fa-solid fa-user"></i></label>
                    <input type="text" placeholder="Username" name="username" id="username">   
                </div>

                <div class="div-names">
                    <input class="input-fname" type="text" placeholder="First name" name="fname" id="fname">   
                    <input class="input-lname" type="text" placeholder="Last name" name="lname" id="lname">   
                </div>

                <div>
                    <label for="mail"><i class="fa-regular fa-envelope"></i></label>
                    <input type="text" placeholder="Mail" name="mail" id="mail">   
                </div>

                
                
                <div>
                    <label for="password"><i class="fa-solid fa-key"></i></label>
                    <input type="password" name="password" placeholder="Password" id="password">
                </div>
                
                <div>
                    <label for="cpasswd"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" placeholder="Confirm password" name="cpasswd" id="cpasswd">   
                </div>
                

                <button id="btn" class="create-btn" type="submit">Create an account <i class="fa-solid fa-user-plus"></i></button>
                <a href="/isitec" class="signup-btn">I already have account <i class="fa-solid fa-arrow-right-to-bracket fa-md"></i> </a> 

            </div>
            

        </form>

        <div class="img-container">
            <!-- imagen -->
            <img class="img" src="../img/aprendiendo.jpg" alt="Estudiando en isitec">
        </div>
        
    </main>
</body>
</html>
