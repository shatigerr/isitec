<?php
    include_once(dirname(__FILE__). '/../lib/forms.php');
    if($_SERVER["REQUEST_METHOD"]=="GET" && !isset($_GET["code"]))
    {
        header("Location:/index.php");
    }else if($_SERVER["REQUEST_METHOD"]== "POST"){
    
        $mail = isset($_POST["mail"])  ? filter_input(INPUT_POST,"mail",FILTER_SANITIZE_EMAIL) : "";
        $password = isset($_POST["password"])  ? filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING) : "";
        $confirmPassword = isset($_POST["confirmPassword"])>0  ? filter_input(INPUT_POST,"confirmPassword",FILTER_SANITIZE_STRING) : "";
        
        if(verifPassword($password,$confirmPassword) && !emailValidation($mail))
        {
            updatePassword($mail,$password);
            header("Location:/index.php");
            die();
        }
    
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/resetPassword.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="mainDiv">
        <div class="cardStyle">
            <form action="<?=$_SERVER['PHP_SELF']; ?>" method="post" name="signupForm" id="signupForm">

                <img src="../img/logoIsitec.png" id="signupLogo" />

                <h1 class="formTitle">
                    Change your password
                </h1>

                <div class="inputDiv">
                    <label class="inputLabel" for="password"><i class="fa-solid fa-lock fa-md"></i></label>
                    <input placeholder="New Password" type="password" id="password" name="password" required>
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="confirmPassword"><i class="fa-solid fa-key fa-md"></i></label>
                    <input placeholder="Confirm New Password" type="password" id="confirmPassword" name="confirmPassword">
                    <input type="hidden" name="mail" value="<?= isset($_GET["mail"]) ? $_GET["mail"] : ""?>">
                </div>

                <div class="buttonWrapper">
                    <button type="submit" id="submitButton"
                        class="submitButton pure-button pure-button-primary">
                        <span>Continue</span>
                        
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>