<?php
    if(!isset($_COOKIE["PHPSESSID"]))
    {
        header("Location:/isitec/index.php");
    }else{
        session_start();
    }
?>