<?php
setcookie(session_name(),"",time()-240000, "/");
session_destroy();
header("Location: /isitec/index.php");