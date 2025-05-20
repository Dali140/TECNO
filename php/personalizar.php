<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "tecno_db");

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoge los datos enviados por POST
$nombre = $_POST['nombre'] ?? '';
$salida = $_POST['salida'] ?? '';
$corazon = $_POST['corazon'] ?? '';
$fondo = $_POST['fondo'] ?? '';

// Validación simple
if (empty($nombre) || empty($salida) || empty($corazon) || empty($fondo)) {
    echo "Todos los campos son obligatorios.";
    exit;
}

// Prepara la consulta para guardar en la tabla perfumes
$stmt = $conn->prepare("INSERT INTO perfumes (nombre, nota_salida, nota_corazon, nota_fondo) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nombre, $salida, $corazon, $fondo);

if ($stmt->execute()) {
    echo "¡Perfume guardado correctamente!";
} else {
    echo "Error al guardar el perfume: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
