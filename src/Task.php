<?php

    require_once 'Database.php';

    class Task {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance()->getConnection(); // Obtiene la conexión a la base de datos
        }

        // Método para crear una nueva tarea
        public function create($userId, $title, $description, $status) {
            $stmt = $this->db->prepare('INSERT INTO tasks (user_id, title, description, status) VALUES (?, ?, ?, ?)');
            return $stmt->execute([$userId, $title, $description, $status]);
        }

        // Método para obtener todas las tareas de un usuario
        public function getAllByUser($userId) {
            $stmt = $this->db->prepare('SELECT * FROM tasks WHERE user_id = ?');
            $stmt->execute([$userId]);
            return $stmt->fetchAll(); // Devuelve todas las tareas del usuario
        }

        // Método para obtener una tarea específica por ID y usuario
        public function getTaskById($taskId, $userId) {
            $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
            $stmt->execute([$taskId, $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve la tarea como un array asociativo
        }

        // Método para actualizar una tarea existente
        public function update($taskId, $userId, $title, $description, $status) {
            $stmt = $this->db->prepare('UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ? AND user_id = ?');
            return $stmt->execute([$title, $description, $status, $taskId, $userId]);
        }

        // Método para eliminar una tarea
        public function delete($taskId, $userId) {
            $stmt = $this->db->prepare('DELETE FROM tasks WHERE id = ? AND user_id = ?');
            return $stmt->execute([$taskId, $userId]);
        }
    }

?>
