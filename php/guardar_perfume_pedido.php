<?php
$conexion = new mysqli("localhost", "root", "", "tecno_db");
$datos = json_decode(file_get_contents("php://input"), true);

$stmt = $conexion->prepare("INSERT INTO pedidos_perfumes
(session_id, numero_orden, nombre, nota_salida, nota_corazon, nota_fondo, precio)
VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
  "ssssssd",
  $datos["session_id"], $datos["numero_orden"], $datos["nombre"],
  $datos["nota_salida"], $datos["nota_corazon"], $datos["nota_fondo"], $datos["precio"]
);
$stmt->execute();
echo "ok";
?>
