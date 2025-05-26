<?php
header("Content-Type: application/json");

$host = "sql200.infinityfree.com";
$user = "if0_39080857";
$password = "e8Zcudo5ftoX";
$db = "if0_39080857_tecno_db";

$conexion = new mysqli($host, $user, $password, $db);
//$conexion = new mysqli("localhost", "root", "", "tecno_db");

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
