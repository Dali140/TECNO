<?php
header("Content-Type: application/json");

$conexion = new mysqli("localhost", "root", "", "tecno_db");
if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

$result = $conexion->query("SELECT nombre, telefono, email, fecha, comentario FROM contactos ORDER BY fecha DESC");

$contactos = [];
while ($fila = $result->fetch_assoc()) {
    $contactos[] = $fila;
}

echo json_encode($contactos);
$conexion->close();
?>
