<?php
    session_start(); // Iniciar la sesión para acceder a las variables de sesión

    // Verificar si el usuario está autenticado. Si no lo está, redirigir a la página de login.
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit(); // Terminar la ejecución del script después de la redirección
    }

    require_once '../src/Task.php'; // Incluir la clase Task para manejar las tareas

    $task = new Task(); // Crear una instancia de la clase Task
    $taskId = $_GET['id']; // Obtener el ID de la tarea desde la URL
    $userId = $_SESSION['user_id']; // Obtener el ID del usuario desde la sesión

    // Intentar eliminar la tarea con el ID proporcionado y el ID del usuario autenticado
    if ($task->delete($taskId, $userId)) {
        // Si la tarea se eliminó exitosamente, redirigir a la página de tareas
        header('Location: tasks.php');
        exit(); // Terminar la ejecución del script después de la redirección
    } else {
        // Si hubo un error al eliminar la tarea, mostrar un mensaje de error
        echo 'Error al eliminar la tarea.';
    }
?>
