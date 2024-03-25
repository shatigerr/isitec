<?php
    include_once "../db/db.php";

    $db = new DB();
    function insertCourse($data,$id,$imagePath=null){
        global $db;

        $db->insertCourse($data,$id,$imagePath);

    }

    function imageVerification($file)
    {
        // Verificar si el archivo existe y es un archivo
        
            // Obtener la información del archivo
            $fileInfo = pathinfo($file);

            // Obtener la extensión del archivo
            $fileExtension = strtolower($fileInfo['extension']);

            // Lista de extensiones de archivo de imagen permitidas
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

            // Verificar si la extensión del archivo está en la lista de extensiones permitidas
            if (in_array($fileExtension, $allowedExtensions)) {
                // Es un archivo de imagen válido
                return true;
            } else {
                // La extensión del archivo no está permitida
                return false;
            }
        
    }
