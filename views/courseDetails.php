<?php
    include("../lib/homes.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["likes"]))
        {
            $temp =explode(",",$_POST["likes"]);
            selectUserCourseLikeDislike($temp[1],$_SESSION["id"],"liked") 
                ? updateLikeDislike($temp[0],$temp[1],["likes","liked"],$_SESSION["id"],false,-1)
                : updateLikeDislike($temp[0],$temp[1],["likes","liked"],$_SESSION["id"],1,1) ;
                header("Location:/views/courseDetails.php?id=$temp[1]");
                die();
        }elseif(isset($_POST["dislikes"]))
        {
            $temp =explode(",",$_POST["dislikes"]);
            selectUserCourseLikeDislike($temp[1],$_SESSION["id"],"disliked") 
                ? updateLikeDislike($temp[0],$temp[1],["dislikes","disliked"],$_SESSION["id"],false,-1)
                : updateLikeDislike($temp[0],$temp[1],["dislikes","disliked"],$_SESSION["id"],1,1);
                header("Location:/views/courseDetails.php?id=$temp[1]");
                die();
        }elseif(isset($_POST["fav"]))
        {
            $idCourse = filter_input(INPUT_POST,"fav",FILTER_SANITIZE_STRING);
            getFavouriteById($_SESSION["id"],$idCourse)
                ?   deleteFavouriteCourse($_SESSION["id"],$idCourse)
                :   insertFavouriteCourse($_SESSION["id"],$idCourse);
            header("Location:/views/courseDetails.php?id=$idCourse");
        }else{
            insertUserCourse($_SESSION["id"],$_POST["idCourse"]);
            header("Location:/views/courseDetails.php?id=$_POST[idCourse]");
        }
    }elseif($_SERVER["REQUEST_METHOD"] == "GET"){
        $id = $_GET["id"];
        if(userEnrolled($_SESSION["id"],$id))
        {
            $html = getCourseByIdEnrolled($id);
        }else{
            $html = getCourseById($id);
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/myCourseDetails.css">
    <link rel="stylesheet" href="/css/general.css">
    <script src="/js/myCourseDetails.js"></script>
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <main>
        <?php include "../components/sidebar.php" ?>
        <section class="container">
            
            <?= $html ?>
        </section>

    </main>
    
</body>
</html>