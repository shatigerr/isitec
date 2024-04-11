<?php
    include '../lib/homes.php';
    session_start();

    $myCourses = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $search = isset($_POST["search"]) ? filter_input(INPUT_POST,"search",FILTER_SANITIZE_STRING) : "";
        $myCourses = getFavouriteCourses($_SESSION["id"],$search);
    }else{
        $myCourses = getFavouriteCourses($_SESSION["id"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/courses.css">
    <link rel="stylesheet" href="/css/general.css">
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Search for new Courses!!</title>
</head>
<body>
        <main>
            <?php include("../components/sidebar.php") ?>
            <section class="container">
                <header class="section_main_info_header">
                    <form method="POST" class="section_main_info_form">
                        <div class="i_container">
                            <i class="fa-solid fa-magnifying-glass fa-sm"></i>
                        </div>
                        <input name="search" type="text" placeholder="Search for a course!!">
                    </form>
                </header>
                
                <h3>Favourite Courses</h3>
                
                <section class="all_courses">
                    <?= $myCourses ?>
                </section>

            </section>
        </main>
</body>
