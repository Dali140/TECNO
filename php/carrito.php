<?php
header('Content-Type: application/json');

$conexion = new mysqli("localhost", "root", "", "tecno_db");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    echo json_encode(["error" => "Error de conexión"]);
    exit;
}

$sql = "SELECT id, nombre, nota_salida, nota_corazon, nota_fondo FROM perfumes ORDER BY id DESC LIMIT 1";
$resultado = $conexion->query($sql);

if ($resultado && $fila = $resultado->fetch_assoc()) {
    // Puedes asignar un precio fijo si no está en la base
    $fila["precio"] = 599950;
    echo json_encode($fila);
} else {
    echo json_encode(["error" => "No se encontró ningún perfume"]);
}

$conexion->close();
?>
