<?php
// Permitir peticiones desde el navegador
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "TECNO_DB");
if ($conexion->connect_error) {
    http_response_code(500);
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// Leer datos JSON enviados desde fetch
$datos = json_decode(file_get_contents("php://input"), true);

// Validación básica
if (!isset($datos["nombre"], $datos["email"], $datos["password"])) {
    http_response_code(400);
    echo "❌ Faltan datos obligatorios.";
    exit;
}

$nombre = $conexion->real_escape_string($datos["nombre"]);
$email = $conexion->real_escape_string($datos["email"]);
$password = password_hash($datos["password"], PASSWORD_DEFAULT); // Hashear contraseña

// Verificar si el email ya está registrado
$verificar = $conexion->query("SELECT id FROM usuarios WHERE email = '$email'");
if ($verificar->num_rows > 0) {
    http_response_code(409); // Conflicto
    echo "❌ Este correo ya está registrado.";
    exit;
}

// Insertar usuario nuevo
$sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sss", $nombre, $email, $password);

if ($stmt->execute()) {
    echo "✅ Registro exitoso. Ya puedes iniciar sesión.";
} else {
    http_response_code(500);
    echo "❌ Error al registrar usuario.";
}

$stmt->close();
$conexion->close();
?>
