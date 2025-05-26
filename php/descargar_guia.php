<?php
require("fpdf/fpdf.php");

$conexion = new mysqli("sql200.infinityfree.com", "if0_39080857", "e8Zcudo5ftoX", "if0_39080857_tecno_db");
//$conexion = new mysqli("localhost", "root", "", "tecno_db");

$orden = $_GET['orden'] ?? '';

if (!$orden) {
    die("Número de orden no especificado.");
}

$pedido = $conexion->query("SELECT * FROM InformacionPedidos WHERE numero_orden = '$orden'")->fetch_assoc();
$perfumes = $conexion->query("SELECT * FROM pedidos_perfumes WHERE numero_orden = '$orden'");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, "Guía de Pedido #$orden", 0, 1, 'C');
$pdf->Ln(5);

// Datos del cliente
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Nombre: " . $pedido['nombre'], 0, 1);
$pdf->Cell(0, 10, "Dirección: " . $pedido['direccion'], 0, 1);
$pdf->Cell(0, 10, "Ciudad: " . $pedido['ciudad'] . ", " . $pedido['departamento'], 0, 1);
$pdf->Cell(0, 10, "Código Postal: " . $pedido['codigo_postal'], 0, 1);
$pdf->Cell(0, 10, "País: " . $pedido['pais'], 0, 1);
$pdf->Cell(0, 10, "Teléfono: " . $pedido['telefono'], 0, 1);
$pdf->Ln(10);

// Lista de perfumes
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, "Perfumes Personalizados", 0, 1);
$pdf->SetFont('Arial', '', 12);

while ($p = $perfumes->fetch_assoc()) {
    $pdf->Cell(0, 10, "• " . $p['nombre'] . " - $" . number_format($p['precio'], 2), 0, 1);
    $pdf->Cell(0, 8, "   Nota de salida: " . $p['nota_salida'], 0, 1);
    $pdf->Cell(0, 8, "   Nota de corazón: " . $p['nota_corazon'], 0, 1);
    $pdf->Cell(0, 8, "   Nota de fondo: " . $p['nota_fondo'], 0, 1);
    $pdf->Ln(2);
}

$pdf->Output();
?>
