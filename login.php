<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$conexion = new mysqli("localhost", "root", "", "TECNO_DB");
if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(["ok" => false, "mensaje" => "Error de conexión a la base de datos"]);
    exit;
}

$datos = json_decode(file_get_contents("php://input"), true);
$email = $conexion->real_escape_string($datos["email"]);
$password = $datos["password"];

$query = "SELECT id, nombre, email, contraseña, rol FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($password, $usuario["contraseña"])) {
        unset($usuario["contraseña"]); // No enviamos la contraseña al cliente
        echo json_encode(["ok" => true, "usuario" => $usuario]);
        exit;
    }
}

echo json_encode(["ok" => false, "mensaje" => "❌ Correo o contraseña incorrectos."]);
