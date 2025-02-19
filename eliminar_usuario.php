<?php
include('../happybirthday/config/db.php');

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "<script>
                Swal.fire({
                    title: 'Eliminado',
                    text: 'El usuario ha sido eliminado correctamente.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'lista_usuarios.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo eliminar el usuario.',
                    icon: 'error'
                }).then(() => {
                    window.history.back();
                });
              </script>";
    }

    $stmt->close();
    $conn->close();
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
}
?>
