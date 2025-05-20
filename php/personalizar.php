<?php
//  guardar_perfume.php

//  1.  Database Connection (as before)
$conn = new mysqli("localhost", "root", "", "tecno_db");
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

//  2.  Get and Sanitize Data (as before)
$nombre = isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre'])) : '';
$salida = isset($_POST['salida']) ? htmlspecialchars(trim($_POST['salida'])) : '';
$corazon = isset($_POST['corazon']) ? htmlspecialchars(trim($_POST['corazon'])) : '';
$fondo = isset($_POST['fondo']) ? htmlspecialchars(trim($_POST['fondo'])) : '';

//  3.  Validation (as before)
$errors = [];
if (empty($nombre)) {
    $errors[] = "El nombre del perfume es obligatorio.";
}
if (empty($salida)) {
    $errors[] = "La nota de salida es obligatoria.";
}
if (empty($corazon)) {
    $errors[] = "La nota de corazón es obligatoria.";
}
if (empty($fondo)) {
    $errors[] = "La nota de fondo es obligatoria.";
}

if (!empty($errors)) {
    echo "Error: " . implode("<br>", $errors);
    exit;
}

//  4.  Prepare and Execute Query (as before)
$stmt = $conn->prepare("INSERT INTO perfumes (nombre, nota_salida, nota_corazon, nota_fondo) VALUES (?, ?, ?, ?)");
if ($stmt === false) {
    die("Error preparing the SQL statement: " . $conn->error);
}
$stmt->bind_param("ssss", $nombre, $salida, $corazon, $fondo);

if ($stmt->execute()) {
    echo "Perfume guardado correctamente.";
    //  5.  (Optional) You could send a simple success message
    //  echo "success";  //  Or "OK" or a JSON object
} else {
    echo "Error al guardar el perfume: " . $stmt->error;
}

//  6.  Close (as before)
$stmt->close();
$conn->close();
?>