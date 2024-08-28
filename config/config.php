<?php
    // Definir constantes para la configuración de la base de datos
    define('DB_HOST', 'localhost'); // Servidor de la base de datos
    define('DB_NAME', 'todo_list_db'); // Nombre de la base de datos
    define('DB_USER', 'root'); // Usuario de la base de datos
    define('DB_PASS', ''); // Contraseña del usuario de la base de datos (dejar vacía si no se requiere)

    // Función para obtener la conexión a la base de datos
    function getDbConnection() {
        try {
            // Crear un string de conexión para PDO usando las constantes definidas
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

            // Opciones de configuración para PDO
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lanzar excepciones en caso de error
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Obtener resultados en formato de array asociativo
            ];

            // Retornar una nueva instancia de PDO con los parámetros de conexión y opciones
            return new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Manejar cualquier error en la conexión a la base de datos
            die('Database connection failed: ' . $e->getMessage());
        }
    }
?>
