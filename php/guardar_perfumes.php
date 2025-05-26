<?php
header("Content-Type: application/json");
$conexion = new mysqli("sql200.infinityfree.com", "if0_39080857", "e8Zcudo5ftoX", "if0_39080857_tecno_db");
if ($conexion->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

$datos = json_decode(file_get_contents("php://input"), true);

if (!isset($datos["perfumes"]) || !isset($datos["numeroOrden"])) {
    http_response_code(400);
    echo json_encode(["error" => "Datos incompletos"]);
    exit;
}

$perfumes = $datos["perfumes"];
$orden = $datos["numeroOrden"];

$stmt = $conexion->prepare("INSERT INTO pedidos_perfumes (numero_orden, nombre, nota_salida, nota_corazon, nota_fondo, precio) VALUES (?, ?, ?, ?, ?, ?)");

foreach ($perfumes as $p) {
    $stmt->bind_param("sssssd", 
        $orden, 
        $p["nombre"], 
        $p["salida"], 
        $p["corazon"], 
        $p["fondo"], 
        $p["precio"]
    );
    $stmt->execute();
}

$stmt->close();
$conexion->close();

echo json_encode(["ok" => true, "mensaje" => "Perfumes guardados"]);
?>
