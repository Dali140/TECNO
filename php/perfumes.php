<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "tecno_db");

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoge los datos del POST
$salida = $_POST['salida'] ?? '';
$corazon = $_POST['corazon'] ?? '';
$fondo = $_POST['fondo'] ?? '';

// Verifica que no estén vacíos
if(empty($salida) || empty($corazon) || empty($fondo)){
    echo "Faltan datos";
    exit;
}

// OJO: Aquí usamos los nombres EXACTOS de las columnas de tu tabla
$stmt = $conn->prepare("INSERT INTO perfumes_personalizados (nota_salida, nota_corazon, nota_fondo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $salida, $corazon, $fondo);

if ($stmt->execute()) {
    echo "Perfume guardado correctamente";
} else {
    echo "Error al guardar: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
