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
            <form action="../lib/resetPassword/resetPasswordSend.php" method="post" name="signupForm" id="signupForm">

                <img src="../img/logoIsitec.png" id="signupLogo" />

                <h1 class="formTitle">
                    Change your password
                </h1>

                <div class="inputDiv">
                    <label class="inputLabel" for="password"><i class="fa-solid fa-envelope fa-md"></i></label>
                    <input placeholder="Mail" type="email" id="password" name="mail" required>
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="password"><i class="fa-solid fa-lock fa-md"></i></label>
                    <input placeholder="New Password" type="password" id="password" name="password" required>
                </div>

                <div class="inputDiv">
                    <label class="inputLabel" for="confirmPassword"><i class="fa-solid fa-key fa-md"></i></label>
                    <input placeholder="Confirm New Password" type="password" id="confirmPassword" name="confirmPassword">
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