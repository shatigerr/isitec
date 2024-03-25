<?php
    include '../lib/homes.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/myCourse.css">
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <main>
        <?php include "../components/sidebar.php" ?>

        <section class="container">
            <section class="nav">
                <h3>Your courses</h3>
                <a href="/views/createCourse.php"><button class="primary">Create Course</button></a>
            </section>
            <section class="card_container">
                    <?= getNewCourses($_SESSION["id"]); ?>
            </section>
        </section>
    </main>
</body>
</html>