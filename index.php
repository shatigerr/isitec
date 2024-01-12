<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/login.css">
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>

    <title>Login</title>
</head>
<body>
    <main>
        
            <div class="img-container">
                <!-- imagen -->
                <img class="img" src="./img/estudianteisitec.jpg" alt="Estudiando en isitec">
            </div>
            
            <form action="./index.php" method="POST">
                <div class="container">
                    <div>
                        <label for="username"><i class="fa-regular fa-envelope"></i></label>
                        <input type="text" placeholder="Mail" name="username" id="username">   
                    </div>

                    <div>
                        <label for="password"><i class="fa-solid fa-key"></i></label>
                        <input type="text" name="password" placeholder="Password" id="password">
                    </div>

                    <div>
                        <button type="submit">Login</button>
                        <button type="submit">Sing up</button>
                    </div>
                </div>
            

            </form>
    </main>
</body>
</html>