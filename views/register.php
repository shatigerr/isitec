<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/register.css">

    <title>Document</title>
</head>
<body>
    <main>
        
        
        
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

        <div class="img-container">
            <!-- imagen -->
            <img class="img" src="../img/ciudad.jpg" alt="Estudiando en isitec">
        </div>
    </main>
</body>
</html>
