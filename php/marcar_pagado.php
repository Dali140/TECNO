<?php
$conexion = new mysqli("localhost", "root", "", "tecno_db");

if ($conexion->connect_error) {
    http_response_code(500);
    exit("Error de conexión");
}

$datos = json_decode(file_get_contents("php://input"), true);
$session_id = $conexion->real_escape_string($datos["session_id"]);

$sql = "UPDATE carritos SET pagado = 1 WHERE session_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $session_id);
$stmt->execute();

echo "ok";
?>
