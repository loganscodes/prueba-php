<?php
    session_start(); // Inicia la sesión para poder manipularla

    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión actual

    header('Location: login.php'); // Redirige al usuario a la página de inicio de sesión
exit(); // Termina la ejecución del script
