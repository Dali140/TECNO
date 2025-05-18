<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "perfumes"); // 'perfumes' es el nombre de tu base de datos

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtiene los valores enviados por POST
$salida = $_POST['salida'] ?? '';
$corazon = $_POST['corazon'] ?? '';
$fondo = $_POST['fondo'] ?? '';

// Valida que estén completos (puedes mejorar la validación)
if ($salida && $corazon && $fondo) {
    // Prepara y ejecuta la consulta
    $stmt = $conexion->prepare("INSERT INTO perfumes_personalizados (nota_salida, nota_corazon, nota_fondo) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $salida, $corazon, $fondo);

    if ($stmt->execute()) {
        echo "Guardado correctamente";
    } else {
        echo "Error al guardar";
    }
    $stmt->close();
} else {
    echo "Faltan datos";
}

$conexion->close();
?>
