<?php
header("Content-Type: application/json");

$conexion = new mysqli("sql200.infinityfree.com", "if0_39080857", "e8Zcudo5ftoX", "if0_39080857_tecno_db");

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
