<?php
if (!isset($_COOKIE["PHPSESSID"])) {

    header("Location:/index.php");
} else {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <main>
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-logo_container">
                <img src="../img/logoIsitec_1.webp" alt="">
            </div>
            <nav>
                <ul>
                    <li><i class="fa-solid fa-house-chimney fa-lg"></i></li>
                    <li><i class="fa-solid fa-book fa-lg"></i></li>
                    <li><i class="fa-solid fa-heart fa-lg"></i></li>
                    <li><i class="fa-solid fa-graduation-cap fa-lg"></i></li>
                    <li><i class="fa-solid fa-gear fa-lg"></i></li>
                </ul>
            </nav>

            <form class="sidebar_form" action="./../lib/logout.php" method="post">
                <button class="primary"><i class="fa-solid fa-headset fa-xl"></i></button>
                <button class="secondary">Log out</button>
            </form>
        </aside>

        <!-- FIN SIDEBAR -->

        <section class="section_main_info">
            <header class="section_main_info_header">
                <form action="#" class="section_main_info_form">
                    <div class="i_container">
                        <i class="fa-solid fa-magnifying-glass fa-sm"></i>
                    </div>
                    <input type="text" placeholder="Search for a course!!">
                </form> 

                <p><?= date("d M Y, l") ?></p>
            </header>
            
            <section class="section_main_info_card">
                <div class="section_main_info_card_div">
                    <h2>Welcome Username</h2>
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
                    <div>
                        <h5>Python course for beginners!</h5>
                        <p>This python course is perfect for ...</p>
                        <button>Enter Course</button>
                    </div>

                    <div>
                        <h5>Python course for beginners!</h5>
                        <p>This python course is perfect for ...</p>
                        <button>Enter Course</button>
                    </div>

                    <div>
                        <h5>Python course for beginners!</h5>
                        <p>This python course is perfect for ...</p>
                        <button>Enter Course</button>
                    </div>
                </section>

            </section>
    
        </section>
        
        <section class="section_container_profile">
            <h2>Adios</h2>
        </section>
    </main>
</body>
</html>
