<?php
    include("../lib/homes.php");
    if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]))
    {
        $id = $_GET["id"];
    }elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["deleted"]))
        {
            deleteVideoById($_POST["deleted"]) ? header("Location:/views/myCourseDetails.php?id=". $_POST["id"] ."")  : "" ;
        }elseif (isset($_FILES["file"])) {
            $id = $_POST["id"];
            $uploadedFile = $_FILES["file"];

            if (isVideo($uploadedFile)) {
                $uploadDirectory = "../uploads/videos/";
                $targetPath = $uploadDirectory . basename($uploadedFile["name"]);

                if (move_uploaded_file($uploadedFile["tmp_name"], $targetPath)) {
                    // Archivo movido exitosamente
                    // Aquí puedes realizar otras acciones, como insertar la información en la base de datos
                    insertVideo($_POST["title"],$id,$targetPath);
                    header("Location:/views/myCourseDetails.php?id=$id");
                }
            }
        }
    }else{
        header("Location:/");
        die();
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
            
            <?= getMyCourseById($id) ?>
        </section>

    </main>
    <dialog id="dialog">
        <section>
            <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                <div>
                    <div class="Neon Neon-theme-dragdropbox">
                            <input style="z-index: 999; opacity: 0; width: 320px; height: 200px; position: absolute; right: 0px; left: 0px; margin-right: auto; margin-left: auto;" name="file" id="filer_input2" type="file">
                        <div class="Neon-input-dragDrop"><div class="Neon-input-inner"><div class="Neon-input-icon"><i class="fa fa-file-image-o"></i></div><div class="Neon-input-text"><h3>Drag&amp;Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="Neon-input-choose-btn blue">Browse Files</a></div></div>
                    </div>
                </div>
                <div class="form">
                    <input name="title" type="text" placeholder="Video Title">
                    <button type="submit" class="primary">Create Video</button>
                    <button id="cancel" class="secondary" type="button" class="secondary">Cancel</button>
                    <input name="id" type="hidden" value="<?= $id ?>">
                </div>
            </form>
        </section>
    </dialog>
</body>
</html>