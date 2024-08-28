<?php

    class Database {
        private static $instance = null; // Instancia única de la clase
        private $connection; // Conexión a la base de datos

        private function __construct() {
            require_once __DIR__ . '/../config/config.php'; // Incluye el archivo de configuración
            $this->connection = getDbConnection(); // Obtiene la conexión a la base de datos
        }

        // Método para obtener la instancia única de la clase
        public static function getInstance() {
            if (!self::$instance) {
                self::$instance = new Database(); // Crea una nueva instancia si no existe
            }
            return self::$instance; // Devuelve la instancia
        }

        // Método para obtener la conexión a la base de datos
        public function getConnection() {
            return $this->connection; // Devuelve la conexión
        }
    }

?>
