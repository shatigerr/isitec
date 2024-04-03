<?php 
    include("../lib/homes.php") ;
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $data = explode(",",$_POST["data"]); 
        insertEndedVideo($_SESSION["id"],$data[0],$data[1],);
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/general.css">
    <link rel="stylesheet" href="/css/courseVideo.css">
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="/js/videoEnded.js"></script>
    <title>Document</title>
</head>
<body>
    <main>
        <?= getVideoCourse($_GET["idC"],$_GET["idV"]) ?>
        

    </main>
</body>
</html>