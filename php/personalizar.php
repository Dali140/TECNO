<?php
$conexion = new mysqli("sql200.infinityfree.com", "if0_39080857", "e8Zcudo5ftoX", "if0_39080857_tecno_db");
//$conexion = new mysqli("localhost", "root", "", "tecno_db");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'] ?? '';
$salida = $_POST['salida'] ?? '';
$corazon = $_POST['corazon'] ?? '';
$fondo = $_POST['fondo'] ?? '';

if (empty($nombre) || empty($salida) || empty($corazon) || empty($fondo)) {
    echo "Faltan datos";
    exit;
}

// Cambia aquí los nombres de las columnas según tu tabla "perfumes"
$stmt = $conexion->prepare("INSERT INTO perfumes (nombre, nota_salida, nota_corazon, nota_fondo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $salida, $corazon, $fondo);

if ($stmt->execute()) {
    echo "Perfume guardado correctamente";
} else {
    echo "Error al guardar: " . $conn->error;
}

$stmt->close();
$conexion->close();
?>
