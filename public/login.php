<?php
    session_start(); // Inicia la sesión para manejar la autenticación del usuario

    require_once '../src/User.php'; // Incluye la clase User para manejar la autenticación de usuarios

    // Verifica si se ha enviado el formulario mediante el método POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtiene los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User(); // Crea una instancia de la clase User
        $loggedInUser = $user->login($username, $password); // Intenta iniciar sesión con las credenciales proporcionadas

        // Verifica si el inicio de sesión fue exitoso
        if ($loggedInUser) {
            $_SESSION['user_id'] = $loggedInUser['id']; // Almacena el ID del usuario en la sesión
            echo '<script type="text/javascript">
                    alert("Inicio de Sesión correcto");
                    window.location.href = "tasks.php"; // Redirige a la página de tareas
                </script>';
            exit(); // Termina la ejecución del script después de redirigir
        } else {
            // Muestra un mensaje de error si el nombre de usuario o la contraseña son incorrectos
            echo '<script type="text/javascript">
                    alert("Nombre de usuario o contraseña incorrectos")
                </script>';
        }
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/prueba-php/assets/style.css">
    <title>Iniciar Sesión</title>
</head>

<body>


    <div class="md:w-[65%] lg:w-1/2 m-auto">
        <h1 class="text-4xl sm:text-5xl text-center pt-16 font-bold">Todo List</h1>
        <h2 class="text-4xl sm:text-5xl text-center p-5">Inicio de Sesión</h2>
    </div>



    <form method="POST" action="login.php" class="max-w-sm mx-auto pt-32">
        <div class="mb-5">

            <label for="username" class="block mb-2 text-sm font-medium ">UserName</label>
            <input type="text" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="username" required />

        </div>

        <div class="mb-5">

            <label for="password" class="block mb-2 text-sm font-medium ">Password</label>
            <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="password" required />

        </div>

        <div class="flex justify-center gap-10">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Iniciar Sesión</button>

            <a href="register.php" class="text-white bg-yellow-700 hover:bg-yellow-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Registrarse</a>
        </div>

    </form>


    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>