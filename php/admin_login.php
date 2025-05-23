<?php
header("Content-Type: application/json");

$conexion = new mysqli("localhost", "root", "", "tecno_db");
if ($conexion->connect_error) {
    echo json_encode(["ok" => false, "mensaje" => "Error de conexión"]);
    exit;
}

$datos = json_decode(file_get_contents("php://input"), true);
$nombre = $conexion->real_escape_string($datos["nombre"]);
$password = $datos["password"];

$sql = "SELECT id, nombre, contraseña, rol FROM usuarios WHERE nombre = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();
    if ($usuario["rol"] === "admin" && password_verify($password, $usuario["contraseña"])) {
        unset($usuario["contraseña"]);
        echo json_encode(["ok" => true, "usuario" => $usuario]);
        exit;
    }
}

echo json_encode(["ok" => false, "mensaje" => "Credenciales inválidas"]);
?>
