<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "cumpleaniostf";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
