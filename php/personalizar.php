<?php
$conn = new mysqli("localhost", "root", "", "tecno_db");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
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
$stmt = $conn->prepare("INSERT INTO perfumes (nombre, nota_salida, nota_corazon, nota_fondo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $salida, $corazon, $fondo);

if ($stmt->execute()) {
    echo "Perfume guardado correctamente";
} else {
    echo "Error al guardar: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
