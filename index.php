<?php
include('config/db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input_usuario = $_POST['usuario'] ?? '';
    $input_password = $_POST['password'] ?? '';
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE usuario = ?");
    $stmt->bind_param("s", $input_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($input_password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['usuario'] = $input_usuario;
            $_SESSION['userid'] = $user['id'];
            header("Location: crud.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Cristian Alejandro Jiménez Mora">
        <link rel="icon" href="/static/img/TF.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>TF Formatos RRHH</title>
        <style>
            .background-color {
                background-color: #E1EEE2;
                background-size: cover;
                background-position: center;
            }
            .overlay {
                background: rgba(255, 255, 255, 0.8);
            }
            .disabled-button {
                opacity: 0.5;
                cursor: not-allowed;
            }
        </style>
    </head>
    <body class="flex flex-col items-center min-h-screen background-color">
    <header class="text-gray-600 body-font w-full bg-white">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                <a href="https://tfauditores.com/">
                    <img src="/static/img/TF.png" alt="Logo-TF" class="h-20">
                </a>
            </nav>
        </div>
    </header>
        <div class="overlay p-10 rounded-lg shadow-xl max-w-md text-center mt-20 sm:mt-16 md:mt-16">
            <h2 class="text-3xl font-bold mb-6 text-gray-700">¡Bienvenido a TF!</h2>
            <p class="mb-8 text-gray-600">Por favor ingresa tu usuario y contraseña para continuar.</p>

            <!-- Mostrar errores si existen -->
            <?php if (isset($error)) { ?>
                <div class="text-red-600 mb-4"><?php echo $error; ?></div>
            <?php } ?>

            <form method="POST" action="index.php">
                <div class="mb-4">
                    <label for="usuario" class="block text-left text-gray-700 font-semibold">Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Tu usuario" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required minlength="5" maxlength="13">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-left text-gray-700 font-semibold">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required minlength="6" maxlength="10">
                </div>
                <div class="flex gap-4 justify-center">
                    <button type="submit" class="bg-green-600 hover:bg-lime-500 text-white font-bold py-3 px-6 rounded-lg shadow-md transform transition hover:scale-105 duration-200 w-full md:w-auto">
                        Iniciar sesión
                    </button>
                </div>
            </form>
        </div>
        <footer class="bg-white text-gray-600 body-font fixed bottom-0 w-full">
            <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
                <p id="year" class="text-sm text-gray-700 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© <span id="current-year"></span> TF AUDITORES</p>
                <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                    <a href="https://www.facebook.com/people/TF-Auditores-y-Asesores-SAS-BIC/100065088457000/" class="text-gray-700 hover:text-blue-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/tfauditores/" class="ml-3 text-gray-700 hover:text-pink-500">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/uas/index?session_redirect=https%3A%2F%2Fwww.linkedin.com%2Fcompany%2F10364571%2Fadmin%2Fdashboard%2F" class="ml-3 text-gray-700 hover:text-blue-300">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </footer>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const currentYear = new Date().getFullYear();
                document.getElementById('current-year').textContent = currentYear;
            });
        </script>
    </body>
</html>

