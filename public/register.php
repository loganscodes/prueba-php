<?php
    require_once '../src/User.php'; // Incluye el archivo User.php que contiene la clase User

    // Verifica si la solicitud es de tipo POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username']; // Obtiene el nombre de usuario del formulario
        $password = $_POST['password']; // Obtiene la contraseña del formulario

        $user = new User(); // Crea una instancia de la clase User
        // Intenta registrar el nuevo usuario
        if ($user->register($username, $password)) {
            // Muestra un mensaje de éxito y redirige a la página de inicio de sesión
            echo '<script type="text/javascript">
                    alert("Usuario creado, por favor inicia sesion.");
                    window.location.href = "login.php";
                </script>';
        } else {
            // Muestra un mensaje de error si el nombre de usuario ya existe
            echo '<script type="text/javascript">
                    alert("El Username ya existe, selecciona otro")
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
    <title>Registro</title>
</head>
<body>

    <div class="md:w-[65%] lg:w-1/2 m-auto">
        <h2 class="text-4xl sm:text-5xl text-center p-10">Registro de Usuario</h2>
        <a href="login.php">
            <img src="/prueba-php/assets/icons/return.svg" alt="" class="w-10 object-cover mx-5 sm:mx-10">
        </a>
    </div>

    <form method="POST" action="register.php" class="max-w-sm mx-auto pt-32">
            <div class="mb-5 mx-5 sm:mx-0">

                <label for="username" class="block mb-2 text-sm font-medium ">UserName</label>
                <input type="text" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="username" required />

            </div>

            <div class="mb-5 mx-5 sm:mx-0">

                <label for="password" class="block mb-2 text-sm font-medium ">Password</label>
                <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="password" required />

            </div>

            <div class="flex justify-center">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center">Registrar</button>
            </div>

        </form>



    <script src="https://cdn.tailwindcss.com"></script>

</body>
</html>
