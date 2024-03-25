<?php 
    include_once "../lib/createCourses.php";

    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $title = isset($_POST["title"]) ? filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING) : "";
        $description = isset($_POST["title"]) ? filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING) : "";
        $tags = isset($_POST["tags"]) ? filter_input(INPUT_POST, "tags", FILTER_SANITIZE_STRING) : "";
        $uploadDirectory = "../uploads/img/"; 
        if (isset($_FILES["file"])) {
            // Asigna el archivo a una variable para mayor claridad
            $uploadedFile = $_FILES["file"];
            
            // Verifica si el archivo es una imagen válida
            if (imageVerification($uploadedFile["name"])) {
                // El archivo es una imagen válida, puedes realizar acciones adicionales aquí
                $uploadDirectory = "../uploads/img/";
                // Obtiene el nombre del archivo
                $fileName = basename($uploadedFile["name"]);
                // Define la ruta completa de destino
                $uploadFilePath = $uploadDirectory . $fileName;
                // Mueve el archivo a la carpeta de destino
                move_uploaded_file($uploadedFile["tmp_name"], $uploadFilePath);
                $uploadFilePath = "/uploads/img/" . $fileName;
                insertCourse($_POST,$_SESSION["id"],$uploadFilePath);
            }
        }else insertCourse($_POST,$_SESSION["id"]);
        
    

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/createCourse.css">
    <script src="../js/tags.js" ></script>
    <script src="https://kit.fontawesome.com/b8504978d2.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <main>
        <?php include "../components/sidebar.php" ?> 
        <section>
            <form method="POST" enctype="multipart/form-data">
                <div>
                    <div class="Neon Neon-theme-dragdropbox">
                            <input style="z-index: 999; opacity: 0; width: 320px; height: 200px; position: absolute; right: 0px; left: 0px; margin-right: auto; margin-left: auto;" name="file" id="filer_input2" type="file">
                        <div class="Neon-input-dragDrop"><div class="Neon-input-inner"><div class="Neon-input-icon"><i class="fa fa-file-image-o"></i></div><div class="Neon-input-text"><h3>Drag&amp;Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="Neon-input-choose-btn blue">Browse Files</a></div></div>
                    </div>
                </div>
                <div class="form">
                    <input name="title" type="text" placeholder="Course Title">
                    <textarea  name="description" placeholder="Description"></textarea>
                    <div class="tags-input"> 
                        <ul id="tags"></ul> 
                        <input type="text" id="input-tag" placeholder="Enter tag name" /> 
                    </div> 
                    <button class="primary">Create course</button>
                    <input name="tags" id="hide" type="hidden">
                </div>
            </form>
        </section>
    </main>

</body>
</html>