<?php
header("Content-Type: application/json");

$host = "sql200.infinityfree.com";
$user = "if0_39080857";
$password = "e8Zcudo5ftoX";
$db = "if0_39080857_tecno_db";

$conexion = new mysqli($host, $user, $password, $db);
//$conexion = new mysqli("localhost", "root", "", "tecno_db");

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
