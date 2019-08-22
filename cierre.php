<?php
session_start();


$_SESSION = array();


// Finalmente, destruir la sesión.
session_destroy();

header("location:index.html");


?>
