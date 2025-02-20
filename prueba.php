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

    // Generar la imagen personalizada
    $imagenGenerada = generarImagen($nombreCompleto);

    // Enviar el correo al cumpleañero
    $mensaje = enviarCorreo($emailCumpleanero, $nombreCompleto, $imagenGenerada);
    $mensajes[] = $mensaje;

    // Enviar el mismo correo a todos los demás usuarios
    foreach ($usuarios as $usuarioEmail) {
        if ($usuarioEmail !== $emailCumpleanero) { // Evitar enviarle dos veces al cumpleañero
            $mensaje = enviarCorreo($usuarioEmail, $nombreCompleto, $imagenGenerada);
            $mensajes[] = $mensaje;
        }
    }
}

$conn->close();

// Función para generar la imagen con el nombre del cumpleañero
function generarImagen($nombreCompleto) {
    $imagePath = __DIR__ . "/static/img/sisabe.png";
    if (!file_exists($imagePath)) {
        die("Error: La imagen no se encuentra.");
    }

    $fontPath = __DIR__ . "/arial/arial.ttf"; // Asegúrate de tener la fuente Arial
    if (!file_exists($fontPath)) {
        die("Error: No se encontró la fuente.");
    }

    $image = imagecreatefrompng($imagePath);
    imagesavealpha($image, true);
    $black = imagecolorallocate($image, 0, 0, 0);

    // Tamaño de fuente principal y para espacios
    $fontSize = 44;
    $smallFontSize = 20; // Usaremos una fuente más pequeña para espacios
    $lineHeight = $fontSize + 12; 
    $smallLineHeight = $smallFontSize + 6; // Espacio más pequeño

    // Texto con espacios ajustados
    $textLines = [
        $nombreCompleto,       
        "", // Espacio pequeño
        "TF AUDITORES Y",
        "ASESORES SAS BIC",
        "", // Espacio pequeño
        "celebra contigo este día",
        "especial.",
        "", // Espacio pequeño
        "Te deseamos un año",
        "lleno de alegría, éxito y",
        "que todas tus metas y",
        "propósitos se cumplan.",
        "", // Espacio pequeño
        "¡Gracias por ser parte",
        "de nuestro equipo!"
    ];

    // Obtener dimensiones de la imagen
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);

    // Calcular posición inicial
    $startY = round(($imageHeight - (count($textLines) * $lineHeight)) / 2 + 220);

    foreach ($textLines as $i => $line) {
        if ($line === "") { 
            // Si es un espacio, usar una fuente más pequeña
            $y = round($startY + ($i * $smallLineHeight));
        } else {
            // Texto normal
            $y = round($startY + ($i * $lineHeight));
        }

        $textBox = imagettfbbox($fontSize, 0, $fontPath, $line);
        $textWidth = abs($textBox[2] - $textBox[0]);
        $x = round(($imageWidth - $textWidth) / 2 + 30); // Mover 30px a la derecha

        if ($line !== "") {
            imagettftext($image, $fontSize, 0, $x, $y, $black, $fontPath, $line);
        }
    }

    // Guardar la imagen generada
    $imagePathOutput = __DIR__ . "/static/img/cumple_" . str_replace(" ", "_", $nombreCompleto) . ".png";
    imagepng($image, $imagePathOutput);
    imagedestroy($image);

    return $imagePathOutput;
}



// Función para enviar correos
function enviarCorreo($destinatario, $nombre, $imagenPath) {
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

        // Verificar que la imagen existe antes de adjuntarla
        if (!file_exists($imagenPath)) {
            return "❌ Error: La imagen generada no se encontró en $imagenPath";
        }

        // Adjuntar imagen generada
        $mail->AddEmbeddedImage($imagenPath, 'logoimg');

        // Configuración del mensaje
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "¡Feliz Cumpleaños, $nombre!";
        $mail->Body = "
            <div style='text-align: center;'>
                <img src='cid:logoimg' alt='Imagen de cumpleaños' style='display: block; margin: 0 auto; max-width: 500px; width: 100%;'>
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
