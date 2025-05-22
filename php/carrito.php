<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "TECNO_DB");

if ($conexion->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos."]));
}

// Verificar si se pasó un ID por GET
if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    $sql = "SELECT id, nombre, nota_salida, nota_corazon, nota_fondo, precio FROM perfumes WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $perfume = $resultado->fetch_assoc();
        echo json_encode($perfume);
    } else {
        echo json_encode(["error" => "Perfume no encontrado."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "ID de producto no proporcionado."]);
}

$conexion->close();
?>