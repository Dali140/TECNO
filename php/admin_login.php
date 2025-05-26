<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);

$host = "sql200.infinityfree.com";
$user = "if0_39080857";
$password = "e8Zcudo5ftoX";
$db = "if0_39080857_tecno_db";

$conexion = new mysqli($host, $user, $password, $db);

if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión']);
    exit;
}

$nombre = trim($_POST['nombre'] ?? '');
$contrasena = trim($_POST['contrasena'] ?? '');

// Busca el usuario por nombre
$stmt = $conexion->prepare("SELECT id, nombre, contrasena, rol FROM usuarios WHERE nombre = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Si guardaste las contraseñas como MD5 (ejemplo anterior):
    if ($row['contrasena'] === md5($contrasena)) {
        echo json_encode([
            'success' => true,
            'user' => [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'rol' => $row['rol']
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Contraseña incorrecta']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Usuario no encontrado']);
}

$stmt->close();
$conexion->close();
?>