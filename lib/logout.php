<?php
include_once(dirname(__FILE__). '/../lib/forms.php');
session_start();
setcookie(session_name(),"",time()-240000, "/");
session_destroy();
header("Location: /isitec/index.php");
exit();