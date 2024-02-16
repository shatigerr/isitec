<?php
    include_once(dirname(__FILE__). '/../lib/forms.php');

    if($_SERVER["REQUEST_METHOD"]=="GET")
    {
        $mail = strlen($_GET["mail"]) > 0  ? filter_input(INPUT_GET,"mail",FILTER_SANITIZE_STRING) : "";
        $hash = strlen($_GET["code"]) > 0  ? filter_input(INPUT_GET,"code",FILTER_SANITIZE_STRING) : "";
    }else if (isset($_POST["btAccept"]))
    {
        $data = explode("#",$_POST["data"]);
        activateAccount($data[0], $data[1]);

        header("Location:/isitec/index.php");
    }
    else if(isset($_POST["btDecline"]))
    {
        header("Location:/isitec/index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/modal.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Activate your acount</title>
</head>

<body>
    <div class="modal">
        <article class="modal-container">
            <header class="modal-container-header">
                <h1 class="modal-container-title">
                    <img src="../img/logoIsitec.png" alt="">
                    Terms and Services
                </h1>
                
            </header>
            <section class="modal-container-body rtf">

                <h2>Terms and Conditions for Account Activation</h2>

                <p>By activating your account on ISITEC, you agree to the following terms and
                    conditions:</p>

                <ol>
                    <li><strong>Account Information:</strong> You must provide accurate and up-to-date information
                        during the activation process. Do not use false or misleading information.</li>

                    <li><strong>Account Responsibility:</strong> You are responsible for maintaining the security of
                        your account and password. Do not share your credentials with third parties, and notify us of
                        any unauthorized activity immediately.</li>

                    <li><strong>Proper Use:</strong> The activated account must be used appropriately and comply with
                        all applicable laws and regulations. Misuse, illegal, or fraudulent use of the account is not
                        allowed.</li>

                    <li><strong>Verification:</strong> We may require verification of your identity during the
                        activation process. Provide necessary information promptly to avoid delays in accessing your
                        account.</li>

                    <li><strong>Notifications:</strong> We may send important notifications and communications to the
                        email address provided during activation. It is your responsibility to regularly check your
                        email for relevant information.</li>

                    <li><strong>Modifications:</strong> We reserve the right to modify these terms and conditions at any
                        time. You will be notified of significant changes, and continued use of the account after such
                        changes will constitute your acceptance of the modifications.</li>

                    <li><strong>Account Termination:</strong> We reserve the right to terminate or suspend your account
                        if you violate these terms and conditions or if there are suspicious activities associated with
                        your account.</li>
                </ol>

                <p>By activating your account, you acknowledge that you have read, understood, and agreed to these terms
                    and conditions. If you have any questions or concerns, please contact our support team.</p>

            </section>
            <footer class="modal-container-footer">
                <form action="<?=$_SERVER['PHP_SELF']; ?>" method="POST">
                    <button name="btDecline" class="button is-ghost">Decline</button>
                    <button name="btAccept" class="button is-primary">Accept</button>
                    <input name="data" type="hidden" value='<?= $_GET["mail"]. "#" . $_GET["code"] ?>' />
                </form>
            </footer>
        </article>
    </div>
</body>

</html>