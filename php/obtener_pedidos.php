<?php
header("Content-Type: application/json");

$conexion = new mysqli("localhost", "root", "", "tecno_db");

if ($conexion->connect_error) {
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

$resultado = $conexion->query("SELECT * FROM InformacionPedidos ORDER BY fecha DESC");

$pedidos = [];

while ($fila = $resultado->fetch_assoc()) {
    $pedidos[] = $fila;
}

echo json_encode($pedidos);
?>
