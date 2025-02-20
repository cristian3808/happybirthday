<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar PHPMailer
require '../happybirthday/vendor/phpmailer/phpmailer/src/Exception.php';
require '../happybirthday/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../happybirthday/vendor/phpmailer/phpmailer/src/SMTP.php';

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "cumpleaniostf";
$smtp_server = "smtp.gmail.com";
$smtp_port = 587;
$email_user = "pruebasoftwarerc@gmail.com";
$email_pass = "abkgbjoekgsvhtnj";

// Conectar a la base de datos
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la fecha actual
$hoy = date('m-d');

// Obtener los cumpleañeros
$sql_cumpleaneros = "SELECT nombre, apellido, email FROM usuarios WHERE DATE_FORMAT(fecha_nacimiento, '%m-%d') = '$hoy'";
$result_cumpleaneros = $conn->query($sql_cumpleaneros);

$cumpleaneros = [];
if ($result_cumpleaneros->num_rows > 0) {
    while ($row = $result_cumpleaneros->fetch_assoc()) {
        $cumpleaneros[] = $row;
    }
}

// Si no hay cumpleañeros, no enviamos correos
if (empty($cumpleaneros)) {
    echo "No hay cumpleaños hoy.";
    exit;
}

// Obtener la lista de todos los usuarios
$sql_usuarios = "SELECT email FROM usuarios";
$result_usuarios = $conn->query($sql_usuarios);

$usuarios = [];
if ($result_usuarios->num_rows > 0) {
    while ($row = $result_usuarios->fetch_assoc()) {
        $usuarios[] = $row['email'];
    }
}

$mensajes = [];

// Enviar un correo a cada cumpleañero y a todos los usuarios
foreach ($cumpleaneros as $cumpleanero) {
    $nombreCompleto = $cumpleanero['nombre'] . ' ' . $cumpleanero['apellido'];
    $emailCumpleanero = $cumpleanero['email'];

    // Enviar el correo al cumpleañero
    $mensaje = enviarCorreo($emailCumpleanero, $nombreCompleto);
    $mensajes[] = $mensaje;

    // Enviar el mismo correo a todos los demás usuarios
    foreach ($usuarios as $usuarioEmail) {
        if ($usuarioEmail !== $emailCumpleanero) { // Evitar enviarle dos veces al cumpleañero
            $mensaje = enviarCorreo($usuarioEmail, $nombreCompleto);
            $mensajes[] = $mensaje;
        }
    }
}

$conn->close();

// Función para enviar correos
function enviarCorreo($destinatario, $nombre) {
    global $smtp_server, $smtp_port, $email_user, $email_pass;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = $smtp_server;
        $mail->SMTPAuth = true;
        $mail->Username = $email_user;
        $mail->Password = $email_pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($email_user, "Notificaciones");
        $mail->addAddress($destinatario);

        // Ruta de la imagen
        $imagen_path = str_replace('\\', '/', __DIR__ . '/static/img/Tarjeta Cumpleaños TF.gif');

        // Verificar que la imagen existe antes de incrustarla
        if (!file_exists($imagen_path)) {
            return "❌ Error: La imagen no se encontró en $imagen_path";
        }

        // Agregar imagen incrustada
        $mail->AddEmbeddedImage($imagen_path, 'logoimg');

        // Configuración del mensaje
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "¡Feliz Cumpleaños, $nombre! 🎉";
        $mail->Body = "
            <h3 style='text-align: center; font-style: italic;'>¡Felicidades, $nombre!</h3>
            <div style='text-align: center;'>
                <img src='cid:logoimg' alt='Imagen de cumpleaños' style='display: block; margin: 0 auto; max-width: 100%; width: 300px;'>
            </div>
        ";

        $mail->send();
        return "✅ Correo enviado a $destinatario";
    } catch (Exception $e) {
        return "❌ Error enviando correo a $destinatario: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Envío</title>
</head>
<body>
    <h2>Resultado del envío de correos</h2>
    <ul>
        <?php foreach ($mensajes as $mensaje) { echo "<li>$mensaje</li>"; } ?>
    </ul>
</body>
</html>
