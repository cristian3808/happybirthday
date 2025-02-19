<?php
include('../happybirthday/config/db.php');

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    $query = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if (!$usuario) {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Usuario no encontrado.',
                    icon: 'error'
                }).then(() => {
                    window.history.back();
                });
              </script>";
        exit;
    }

    $stmt->close();
} else {
    echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'ID de usuario no válido.',
                icon: 'error'
            }).then(() => {
                window.history.back();
            });
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.4/dist/sweetalert2.min.js"></script>
</head>
<body class="bg-gray-100 p-5">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Editar Usuario</h2>
        <form id="editUserForm" action="actualizar_usuario.php" method="POST">
            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

            <label class="block text-sm font-medium">Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" class="w-full p-2 border mb-2" required>

            <label class="block text-sm font-medium">Apellido:</label>
            <input type="text" name="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" class="w-full p-2 border mb-2" required>

            <label class="block text-sm font-medium">Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" class="w-full p-2 border mb-2" required>

            <label class="block text-sm font-medium">Fecha de Nacimiento:</label>
            <input type="date" name="fecha_nacimiento" value="<?= $usuario['fecha_nacimiento'] ?>" class="w-full p-2 border mb-2" required>

            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2" onclick="window.history.back()">Cancelar</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </form>
    </div>
</body>
</html>
