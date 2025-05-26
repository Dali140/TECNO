<?php
header("Content-Type: application/json");
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conexion = new mysqli("sql200.infinityfree.com", "if0_39080857", "e8Zcudo5ftoX", "if0_39080857_tecno_db");
if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

$datos = json_decode(file_get_contents("php://input"), true);

// Verificar que existan los datos necesarios
if (
    !$datos || 
    !isset($datos["datosEnvio"], $datos["numeroOrden"], $datos["session_id"])
) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan datos requeridos"]);
    exit;
}

$envio = $datos["datosEnvio"];
$orden = $datos["numeroOrden"];
$session_id = $datos["session_id"];

$stmt = $conexion->prepare("INSERT INTO InformacionPedidos 
(session_id, nombre, direccion, ciudad, departamento, codigo_postal, pais, telefono, instrucciones, numero_orden)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Error al preparar la consulta"]);
    exit;
}

$stmt->bind_param(
    "ssssssssss",
    $session_id,
    $envio["nombre"],
    $envio["direccion"],
    $envio["ciudad"],
    $envio["Departamento"],
    $envio["codigoPostal"],
    $envio["pais"],
    $envio["telefono"],
    $envio["instrucciones"],
    $orden
);

if ($stmt->execute()) {
    echo json_encode(["ok" => true, "mensaje" => "Pedido guardado correctamente"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error al guardar el pedido"]);
}

$stmt->close();
$conexion->close();
?>
