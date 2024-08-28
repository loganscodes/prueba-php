<?php
    session_start(); // Inicia la sesión para manejar la autenticación del usuario

    // Verifica si el usuario está autenticado. Si no está, redirige a la página de inicio de sesión
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit(); // Termina la ejecución del script después de la redirección
    }

    require_once '../src/Task.php'; // Incluye la clase Task para manejar las operaciones de tareas

    $task = new Task(); // Crea una instancia de la clase Task
    $taskId = $_GET['id']; // Obtiene el ID de la tarea desde la URL
    $userId = $_SESSION['user_id']; // Obtiene el ID del usuario desde la sesión

    // Obtiene los detalles de la tarea específica utilizando el ID y el ID del usuario
    $taskDetails = $task->getTaskById($taskId, $userId); // Asegúrate de que este método obtenga solo la tarea con el ID dado

    // Verifica si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtiene los datos del formulario
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        // Intenta actualizar la tarea con los nuevos datos
        if ($task->update($taskId, $userId, $title, $description, $status)) {
            // Si la actualización es exitosa, muestra un mensaje de éxito y redirige a la página de tareas
            echo '<script type="text/javascript">
                    alert("Tarea editada");
                    window.location.href = "tasks.php";
                </script>';
            exit(); // Termina la ejecución del script después de redirigir
        } else {
            // Si ocurre un error al actualizar, muestra un mensaje de error
            echo 'Error al actualizar la tarea.';
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="/prueba-php/assets/style.css">
</head>
<body>
    <div class="md:w-[65%] lg:w-1/2 m-auto">
        <h2 class="text-4xl sm:text-5xl text-center p-10">Editar Tarea</h2>
        <a href="tasks.php">
            <img src="/prueba-php/assets/icons/return.svg" alt="" class="w-10 object-cover mx-5 sm:mx-10">
        </a>
    </div>

    <form method="POST" action="edit_task.php?id=<?php echo $taskId; ?>" class="max-w-sm mx-auto pt-32">
        <div class="mb-5 mx-5 sm:mx-0">
            <label for="title" class="block mb-2 text-sm font-medium">Titulo Tarea</label>
            <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" value="<?php echo htmlspecialchars($taskDetails['title']); ?>" required>
        </div>

        <div class="mb-5 mx-5 sm:mx-0">
            <label for="description" class="block mb-2 text-sm font-medium">Descripcion</label>
            <textarea name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"><?php echo htmlspecialchars($taskDetails['description']); ?></textarea>
        </div>

        <div class="mb-5 mx-5 sm:mx-0">
            <label for="status" class="block mb-2 text-sm font-medium">Estado tarea</label>
            <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="Pendiente" <?php echo $taskDetails['status'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                <option value="En_Progreso" <?php echo $taskDetails['status'] == 'En_Progreso' ? 'selected' : ''; ?>>En Progreso</option>
                <option value="Completado" <?php echo $taskDetails['status'] == 'Completado' ? 'selected' : ''; ?>>Completado</option>
            </select>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center">Editar tarea</button>
        </div>
    </form>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
