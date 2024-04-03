<?php
include "../lib/homes.php";

if (!isset($_COOKIE["PHPSESSID"])) {

    header("Location:/index.php");
} else {
    session_start();
    $user = getUserData($_SESSION["username"]);
    $_SESSION["mail"] = $user["mail"];
    $_SESSION["id"] = $user["iduser"];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="/css/general.css">
    
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <main>
        <!-- SIDEBAR -->
        
        <?php include "../components/sidebar.php" ?>

        <!-- FIN SIDEBAR -->

        <section class="section_main_info">
            <header class="section_main_info_header">
                <form action="#" class="section_main_info_form">
                    <div class="i_container">
                        <i class="fa-solid fa-magnifying-glass fa-sm"></i>
                    </div>
                    <input type="text" placeholder="Search for a course!!">
                </form>

                <p class="p-date"><?=date("d M Y, l")?></p>
            </header>

            <section class="section_main_info_card">
                <div class="section_main_info_card_div">
                    <h2>Welcome <?= $_SESSION["username"] ?></h2>
                    <p>Search any type of Courses and learn where and when you want with flexible online learning platforms. Explore a wide range of subjects, available at your convenience. Start your learning journey today!</p>
                    <button class="primary">Start now</button>
                </div>
                <div class="section_main_info_card_div">
                    <img src="/img/chica-en-ordenador-unscreen.gif" alt="">
                </div>
            </section>
            <section class="section_main_info_new_courses">
                <header>
                    <h4>New Courses</h4>
                    <a href="#">View All</a>
                </header>

                <section>
                <?= getNewCourses(); ?>                    
                </section>

            </section>

        </section>

        <section class="section_container_profile">
            <header>
                <img src="../img/aprendiendo_1.webp" alt="">
                <h2><?= $_SESSION["username"] ?></h2>
                <p><?= $_SESSION["mail"] ?></p>
                <button class="primary">Edit profile</button>
            </header>

            <section>
                <?= getCourseAndProgress($_SESSION["id"]) ?>
                <!-- <div class="card_container">
                    <progress max="100" value="10"></progress>
                    <a href="#" class="progress_card">
                        <div class="title">
                            <h5>Title</h5>
                        </div>
                        <div class="progress">
                            <p>30/70</p>
                        </div>
                    </a>
                </div>
                <div class="card_container">
                    <progress max="100" value="10"></progress>
                    <a href="#" class="progress_card">
                        <div class="title">
                        
                            <h5>React - </h5>
                        </div>
                        <div class="progress">
                            <p>30/70</p>
                        </div>
                    </a>
                </div>
                <div class="card_container">
                    <progress max="100" value="10"></progress>
                    <a class="progress_card">
                        <div class="title">
                            <h5>The complete 2024 web bootcamp</h5>
                        </div>
                        <div class="progress">
                            <p>30/70</p>
                    </div>
                    </a>
                </div>
                <div class="card_container">

                    <progress max="100" value="10"></progress>
                    <a class="progress_card">
                        <div class="title">
                            <h5>Master de programacion de videojuegos con unity 2021 C#</h5>
                        </div>
                        <div class="progress">
                            <p class="">30/70</p>
                        </div>
                    </a>
                </div>
            </section> -->
        </section>
    </main>
</body>
</html>
