<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';
require './config/db.php';

if (!isset($_GET['enviar']) || $_GET['enviar'] !== 'true') {
    die('❌ No se ha solicitado el envío de correos.');
}

$smtp_server = "smtp.gmail.com";
$smtp_port = 587;
$email_user = "pruebacjm777@gmail.com";
$email_pass = "mqlbpmkclbeozvut";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la lista de todos los usuarios de género masculino
$sql_usuarios = "SELECT email FROM usuarios WHERE genero = 'femenino'";
$result_usuarios = $conn->query($sql_usuarios);

$usuarios = [];
while ($row = $result_usuarios->fetch_assoc()) {
    $usuarios[] = $row['email'];
}

$mensajes = [];
$mail = new PHPMailer(true);

$hoy = date('Y-m-d');

// Enviar correos a los usuarios masculinos
foreach ($usuarios as $usuarioEmail) {
    // Verificar si ya se envió un correo hoy a este usuario
    $sql_verificar = "SELECT * FROM envios_dia_mujer WHERE usuario_email = '$usuarioEmail' AND fecha_envio = '$hoy'";
    $result_verificar = $conn->query($sql_verificar);

    if ($result_verificar->num_rows > 0) {
        $mensajes[] = "❌ Ya se ha enviado un correo hoy a: <strong>$usuarioEmail</strong>";
        continue; // Saltar al siguiente usuario
    }

    try {
        $mail->isSMTP();
        $mail->Host = $smtp_server;
        $mail->SMTPAuth = true;
        $mail->Username = $email_user;
        $mail->Password = $email_pass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom($email_user, "Notificaciones");
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->SMTPKeepAlive = true;

        // Configurar el correo
        $mail->ClearAllRecipients();
        $mail->clearAttachments();
        $mail->addAddress($usuarioEmail);

        $mail->Subject = "¡Felicidades, querida compañera!";
        // Genera la imagen para el correo
        $imagenCumple = generarImagen("Feliz Día, Compañero");
        $mail->addEmbeddedImage($imagenCumple, 'imagenCumple', 'dia_mujer.png');

        // Cuerpo del correo
        $mail->Body = "
        <html>
       <body style='font-family: Arial, sans-serif; color: #333; padding: 20px;'>
            <p style='font-size: 18px; line-height: 1.5;'>
                Buen día <strong>Compañera</strong>,<br><br>
                <strong>TF Auditores y Asesores</strong> te felicita en este día tan especial.<br><br>
                <span style='font-size: 20px;'>¡FELIZ DÍA DE LA MUJER 💐🌸👩‍💼!</span>
            </p>
            <div style='text-align: center; margin-top: 20px;'>
                <img src='cid:imagenCumple' alt='Feliz Día' style='max-width: 280px; width: 100%; border-radius: 12px;' />
            </div>
        </body>
        </html>
        ";

        $mail->send();
        $mensajes[] = "✅ Correo enviado a: <strong>$usuarioEmail</strong>";

        // Registrar que el correo ha sido enviado
        $sql_insertar = "INSERT INTO envios_dia_mujer (usuario_email, fecha_envio) VALUES ('$usuarioEmail', '$hoy')";
        $conn->query($sql_insertar);

    } catch (Exception $e) {
        $mensajes[] = "❌ Error general en el envío de correos a: <strong>$usuarioEmail</strong>: {$mail->ErrorInfo}";
    }
}

$conn->close();

// Función para generar la imagen
function generarImagen($nombreCompleto) {
    $imagePath = __DIR__ . "/static/img/Dia De La Mujer.png";
    if (!file_exists($imagePath)) {
        return false;
    }

    $image = imagecreatefrompng($imagePath);
    imagesavealpha($image, true);
   
    $imagePathOutput = __DIR__ . "/static/img/dia_mujer_" . str_replace(" ", "_", $nombreCompleto) . ".png";
    imagepng($image, $imagePathOutput);
    imagedestroy($image);

    return $imagePathOutput;
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
