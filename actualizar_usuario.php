<?php
include('../happybirthday/config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $email = trim($_POST["email"]);
    $fecha_nacimiento = trim($_POST["fecha_nacimiento"]);

    // Validación de datos
    if (empty($nombre) || empty($apellido) || empty($email) || empty($fecha_nacimiento)) {
        echo "<script>
                Swal.fire('Error', 'Todos los campos son obligatorios.', 'error').then(() => window.history.back());
              </script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                Swal.fire('Error', 'Correo electrónico no válido.', 'error').then(() => window.history.back());
              </script>";
        exit;
    }

    // Actualizar en la BD
    $query = "UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, fecha_nacimiento = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $nombre, $apellido, $email, $fecha_nacimiento, $id);

    if ($stmt->execute()) {
        echo "<script>
                Swal.fire('Éxito', 'Usuario actualizado correctamente.', 'success').then(() => window.location.href = 'lista_usuarios.php');
              </script>";
    } else {
        echo "<script>
                Swal.fire('Error', 'No se pudo actualizar.', 'error').then(() => window.history.back());
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
