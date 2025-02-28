<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';
require './config/db.php';

$smtp_server = "smtp.gmail.com";
$smtp_port = 587;
$email_user = "pruebasoftwarerc@gmail.com";
$email_pass = "abkgbjoekgsvhtnj";

// Conectar a la base de datos
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$hoy = date('m-d');

// Obtener los cumpleañeros
$sql_cumpleaneros = "SELECT nombre, apellido, email FROM usuarios WHERE DATE_FORMAT(fecha_nacimiento, '%m-%d') = '$hoy'";
$result_cumpleaneros = $conn->query($sql_cumpleaneros);

$cumpleaneros = [];
while ($row = $result_cumpleaneros->fetch_assoc()) {
    $cumpleaneros[] = $row;
}

if (empty($cumpleaneros)) {
    echo "No hay cumpleaños hoy.";
    exit;
}

// Obtener la lista de todos los usuarios
$sql_usuarios = "SELECT email FROM usuarios";
$result_usuarios = $conn->query($sql_usuarios);

$usuarios = [];
while ($row = $result_usuarios->fetch_assoc()) {
    $usuarios[] = $row['email'];
}

$mensajes = [];

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
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->SMTPKeepAlive = true; // Mantiene la conexión SMTP abierta

    foreach ($cumpleaneros as $cumpleanero) {
        $nombreCompleto = $cumpleanero['nombre'] . ' ' . $cumpleanero['apellido'];
        $emailCumpleanero = $cumpleanero['email'];
        $imagenGenerada = generarImagen($nombreCompleto);

        if (!file_exists($imagenGenerada)) {
            $mensajes[] = "❌ Error: La imagen no se generó correctamente para $nombreCompleto.";
            continue;
        }

        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        $mail->addAddress($emailCumpleanero);

        $otrosCorreos = [];
        foreach ($usuarios as $usuarioEmail) {
            if ($usuarioEmail !== $emailCumpleanero) {
                $mail->addBCC($usuarioEmail);
                $otrosCorreos[] = $usuarioEmail;
            }
        }

        $mail->Subject = "¡Feliz Cumpleaños, $nombreCompleto!";
        $mail->AddEmbeddedImage($imagenGenerada, 'logoimg');
        $mail->Body = "<div style='text-align: center;'>
                        <img src='cid:logoimg' alt='Imagen de cumpleaños' style='display: block; margin: 0 auto; max-width: 500px; width: 100%;'>
                      </div>";

        $mail->send();
        $mensajes[] = "✅ Correo enviado a: <strong>$emailCumpleanero</strong> | Otros: " . implode(", ", $otrosCorreos);
    }

} catch (Exception $e) {
    $mensajes[] = "❌ Error general en el envío de correos: {$mail->ErrorInfo}";
}

$conn->close();

// Función para generar la imagen con el nombre del cumpleañero
function generarImagen($nombreCompleto) {
    $imagePath = __DIR__ . "/static/img/fondoimg.png";
    if (!file_exists($imagePath)) {
        return false;
    }

    $fontPath = __DIR__ . "/arial/arial.ttf"; // Asegúrate de tener la fuente Arial
    if (!file_exists($fontPath)) {
        return false;
    }

    $image = imagecreatefrompng($imagePath);
    imagesavealpha($image, true);
    $black = imagecolorallocate($image, 0, 0, 0);

    $fontSize = 44;
    $smallFontSize = 20;
    $lineHeight = $fontSize + 12;
    $smallLineHeight = $smallFontSize + 6;

    $textLines = [
        $nombreCompleto,       
        "", 
        "TF AUDITORES Y",
        "ASESORES SAS BIC",
        "", 
        "celebra contigo este día",
        "especial.",
        "", 
        "Te deseamos un año",
        "lleno de alegría, éxito y",
        "que todas tus metas y",
        "propósitos se cumplan.",
        "", 
        "¡Gracias por ser parte",
        "de nuestro equipo!"
    ];

    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    $startY = round(($imageHeight - (count($textLines) * $lineHeight)) / 2 + 220);

    foreach ($textLines as $i => $line) {
        $y = $line === "" ? round($startY + ($i * $smallLineHeight)) : round($startY + ($i * $lineHeight));

        $textBox = imagettfbbox($fontSize, 0, $fontPath, $line);
        $textWidth = abs($textBox[2] - $textBox[0]);
        $x = round(($imageWidth - $textWidth) / 2 + 30);

        if ($line !== "") {
            imagettftext($image, $fontSize, 0, $x, $y, $black, $fontPath, $line);
        }
    }

    $imagePathOutput = __DIR__ . "/static/img/cumple_" . str_replace(" ", "_", $nombreCompleto) . ".png";
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
