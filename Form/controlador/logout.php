<?php
session_start();
// Destruir todas las variables de sesión
$_SESSION = array();
session_destroy();

// Redirigir de vuelta a la ventana de acceso
header("Location: ../vista/acceso.php");
exit();