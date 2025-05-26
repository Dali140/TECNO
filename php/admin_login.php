<?php
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conexion = new mysqli("sql200.infinityfree.com", "if0_39080857", "e8Zcudo5ftoX", "if0_39080857_tecno_db");

if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Conexión fallida: ' . $conexion->connect_error]);
    exit;
}

// Recibe datos POST
$nombre = trim($_POST['nombre'] ?? '');
$contrasena = trim($_POST['contrasena'] ?? '');

file_put_contents("debug_login.txt",
    "POST nombre: [$nombre]\nPOST contraseña: [$contrasena]\n",
    FILE_APPEND
);

if (empty($nombre) || empty($contrasena)) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos']);
    exit;
}

// Ajusta el nombre de la tabla si es necesario
$stmt = $conexion->prepare("SELECT id, nombre, rol, contraseña FROM usuarios WHERE nombre = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Error en consulta: ' . $conexion->error]);
    exit;
}
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
file_put_contents("debug_login.txt",
    "Resultado SQL: " . print_r($user, true) . "\n",
    FILE_APPEND
);

if ($user) {
    $verifica = password_verify($contrasena, $user['contraseña']) ? "SI" : "NO";
    file_put_contents("debug_login.txt",
        "Hash: [{$user['contraseña']}]\nComparando con: [$contrasena]\nVerifica: $verifica\n",
        FILE_APPEND
    );
}
file_put_contents("debug_login.txt",
    "Resultado SQL: " . print_r($user, true) . "\n",
    FILE_APPEND
);

if ($user && password_verify($contrasena, $user['contraseña'])) {
    unset($user['contraseña']);
    echo json_encode(['success' => true, 'user' => $user]);
} else {
    echo json_encode(['success' => false, 'error' => 'Usuario o contraseña incorrectos']);
}

$stmt->close();
$conexion->close();
?>