<?php
    session_start(); // Iniciar la sesión para acceder a las variables de sesión

    // Verificar si el usuario está autenticado. Si no lo está, redirigir a la página de login.
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit(); // Terminar la ejecución del script después de la redirección
    }

    require_once '../src/Task.php'; // Incluir la clase Task para manejar las tareas

    // Verificar si la solicitud es de tipo POST (envío de formulario)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $userId = $_SESSION['user_id']; // Obtener el ID del usuario desde la sesión

        $task = new Task(); // Crear una instancia de la clase Task
        // Intentar crear una nueva tarea con los datos proporcionados
        if ($task->create($userId, $title, $description, $status)) {
            // Si la tarea se creó exitosamente, mostrar un mensaje de éxito y redirigir a la página de tareas
            echo '<script type="text/javascript">
                    alert("Tarea creada exitosamente");
                    window.location.href = "tasks.php";
                </script>';
            exit(); // Terminar la ejecución del script después de la redirección
        } else {
            // Si hubo un error al crear la tarea, mostrar un mensaje de error
            echo 'Error al crear la tarea.';
        }
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
    <link rel="stylesheet" href="/prueba-php/assets/style.css">
</head>

<body>

    <div class="md:w-[65%] lg:w-1/2 m-auto">
        <h2 class="text-4xl sm:text-5xl text-center p-10">Crear Nueva Tarea</h2>
        <a href="tasks.php">
            <img src="/prueba-php/assets/icons/return.svg" alt="" class="w-10 object-cover mx-5 sm:mx-10">
        </a>
    </div>

    <form method="POST" action="create_task.php" class="max-w-sm mx-auto pt-32 ">
        <div class="mb-5 mx-5 sm:mx-0">

            <label for="title" class="block mb-2 text-sm font-medium ">Titulo Tarea</label>
            <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />

        </div>

        <div class="mb-5 mx-5 sm:mx-0">

            <label for="text" class="block mb-2 text-sm font-medium ">Descripcion</label>
            <input type="text" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />

        </div>

        <div class="mb-5 mx-5 sm:mx-0">

            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado tarea</label>
            <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="Pendiente">Pendiente</option>
                <option value="En_Progreso">En Progreso</option>
                <option value="Completado">Completada</option>
            </select>

        </div>

        <div class="flex justify-center mx-5 sm:mx-0">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center">Crear Tarea</button>
        </div>

    </form>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>