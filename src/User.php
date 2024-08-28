<?php

    require_once 'Database.php';

    class User {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance()->getConnection(); // Obtiene la conexión a la base de datos
        }

        // Método para registrar un nuevo usuario
        public function register($username, $password) {
            // Comprobar si el nombre de usuario ya existe
            $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute([$username]);
            $existingUser = $stmt->fetch();

            if ($existingUser) {
                // Usuario ya existe
                return false;
            }

            // Si no existe, proceder con el registro
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Encriptar la contraseña
            $stmt = $this->db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            return $stmt->execute([$username, $hashedPassword]); // Insertar el nuevo usuario
        }

        // Método para iniciar sesión de un usuario
        public function login($username, $password) {
            $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['password'])) {
                // Verificar la contraseña
                return $user;
            }
            return false; // Credenciales incorrectas
        }
    }

?>
