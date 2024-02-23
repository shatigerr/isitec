<?php
    if(!isset($_COOKIE["PHPSESSID"]))
    {
        
        header("Location:/index.php");
    }else{
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <form action="./../lib/logout.php" method="post">
        <button>Log out</button>
    </form>
</body>
</html>