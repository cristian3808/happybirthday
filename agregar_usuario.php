<?php
include('../happybirthday/config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $email = trim($_POST["email"]);
    $fecha_nacimiento = trim($_POST["fecha_nacimiento"]);

    // Validaciones básicas
    if (empty($nombre) || empty($apellido) || empty($email) || empty($fecha_nacimiento)) {
        echo "<script>
                alert('Todos los campos son obligatorios.');
                window.history.back();
              </script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                alert('Correo electrónico no válido.');
                window.history.back();
              </script>";
        exit;
    }
    
    $query = "INSERT INTO usuarios (nombre, apellido, email, fecha_nacimiento) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $fecha_nacimiento);

    if ($stmt->execute()) {
        echo "<script>
                alert('Usuario agregado correctamente.');
                window.location.href = 'crud.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al agregar usuario: " . $stmt->error . "');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('Método no permitido.');
            window.history.back();
          </script>";
}
?>
