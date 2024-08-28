<?php
    session_start(); // Inicia la sesión para el usuario
    
    if (!isset($_SESSION['user_id'])) { // Verifica si el usuario está autenticado
        header('Location: login.php'); // Redirige al login si no está autenticado
        exit();
    }

    require_once '../src/Task.php'; // Incluye el archivo que contiene la clase Task

    $task = new Task(); // Crea una instancia de la clase Task
    $userId = $_SESSION['user_id']; // Obtiene el ID del usuario desde la sesión
    $tasks = $task->getAllByUser($userId); // Obtiene todas las tareas del usuario
?>


<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="/prueba-php/assets/style.css">
    <link rel="stylesheet" href="/prueba-php/assets/status_style.css">
</head>

<body>
    <h2 class="text-4xl sm:text-5xl text-center p-10">Lista de Tareas</h2>

    <div class="flex justify-center gap-10">

        <a href="create_task.php">
            <span class="flex items-center bg-gray-100 p-2 rounded-xl text-black gap-3">
                Nueva Tarea
                <img src="/prueba-php/assets/icons/new.svg" alt="" class="w-5">
            </span>
        </a>

        <a href="logout.php">
            <span>
                <span class="flex items-center bg-gray-100 p-2 rounded-xl text-black gap-3">
                    Cerrar Sesión
                    <img src="/prueba-php/assets/icons/logout.svg" alt="" class="w-5">
                </span>
            </span>
        </a>
    </div>


    <div class="flex justify-center pt-20">
        <div class="relative overflow-x-auto shadow-md rounded-lg md:w-1/2 max-w-[710px] mx-5 sm:mx-0">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 text-center font-semibold">

                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Titulo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descripcion
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($task['title']); ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo htmlspecialchars($task['description']); ?>
                            </td>
                            <td class="px-6 py-4 
                                <?php
                                    if ($task['status'] === 'Pendiente') {
                                        echo 'bg-pending';
                                    } elseif ($task['status'] === 'En_Progreso') {
                                        echo 'bg-in-progress';
                                    } elseif ($task['status'] === 'Completado') {
                                        echo 'bg-completed';
                                    }
                                ?>">
                                
                                <p>
                                    <?php echo htmlspecialchars(str_replace('_', ' ', $task['status'])); ?>
                                </p>

                            </td>
                            <td class="px-6 py-4 flex items-center justify-around">
                                <a href="edit_task.php?id=<?php echo $task['id']; ?>">
                                    <img src="/prueba-php/assets/icons/edit.svg" alt="delete" class="w-5">
                                </a>
                                <a href="delete_task.php?id=<?php echo $task['id']; ?>" onclick="return confirmDelete();">
                                    <img src="/prueba-php/assets/icons/delete.svg" alt="delete" class="w-5">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/prueba-php/assets/dialog.js"></script>
</body>

</html>