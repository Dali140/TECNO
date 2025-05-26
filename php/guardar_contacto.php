<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "tecno_db");

if ($conexion->connect_error) {
    http_response_code(500);
    echo "Error de conexión: " . $conexion->connect_error;
    exit;
}

// Recibir datos del formulario
$nombre = $_POST['nombre'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$email = $_POST['email'] ?? '';
$comentario = $_POST['comentario'] ?? '';

// Mostrar para depuración
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "POST recibido.<br>";
    echo "Nombre: $nombre<br>";
    echo "Teléfono: $telefono<br>";
    echo "Email: $email<br>";
    echo "Comentario: $comentario<br>";
}

// Validar datos básicos
if (empty($nombre) || empty($email) || empty($comentario)) {
    http_response_code(400);
    echo "Faltan datos obligatorios";
    exit;
}

// Insertar en la base de datos
$sql = "INSERT INTO contactos (nombre, telefono, email, comentario) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $nombre, $telefono, $email, $comentario);

if ($stmt->execute()) {
    echo "Mensaje enviado correctamente";
} else {
    http_response_code(500);
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
