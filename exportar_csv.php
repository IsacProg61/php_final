<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$stmt = $pdo->query("SELECT id, nombre, categoria, dificultad, tiempo_prep, porciones, descripcion FROM recetario ORDER BY id ASC");
$recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=recetario_' . date('Ymd_His') . '.csv');

$output = fopen('php://output', 'w');
// UTF-8 BOM for Excel to read characters correctly
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
fputcsv($output, array('ID', 'Nombre', 'Categoria', 'Dificultad', 'Tiempo de Preparacion (min)', 'Porciones', 'Descripcion'));

foreach ($recetas as $row) {
    fputcsv($output, $row);
}
fclose($output);
exit();
?>
