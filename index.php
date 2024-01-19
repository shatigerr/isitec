<?php
    include_once("./lib/forms.php");
    $verif;
    if($_SERVER["REQUEST_METHOD"]=="GET")
    {
        $verif = isset($_GET["v"]) ? (int)$_GET["v"] : "";
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


    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    

    <title>Login</title>
</head>
<body>
    <?= showModal($verif,2) ?>
    <main>

        <div class="img-container">
            <!-- imagen -->
            <img class="img" src="./img/estudianteisitec.jpg" alt="Estudiando en isitec">
        </div>
        
        <form action="./index.php" method="POST">
            <div class="container">
                <header>
                    <h1>Welcome to Isitec</h1>
                    <p>Where learning tech is now isi</p>
                </header>

                <div>
                    <label for="username"><i class="fa-regular fa-envelope"></i></label>
                    <input type="text" placeholder="Mail" name="username" id="username">   
                </div>

                <div>
                    <label for="password"><i class="fa-solid fa-key"></i></label>
                    <input type="text" name="password" placeholder="Password" id="password">
                </div>

                <div>
                    <button class="login-btn" type="submit">Login <i class="fa-solid fa-arrow-right-to-bracket fa-md"></i></button>
                    <a href="./views/register.php" class="signup-btn">Sing up <i class="fa-solid fa-user-plus"></i></a>
                </div>
            </div>
            

        </form>
    </main>
</body>
</html>