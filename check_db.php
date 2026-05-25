<?php
require 'conexion.php';
try {
    $stmt = $pdo->query("SELECT column_name FROM information_schema.columns WHERE table_name = 'usuarios'");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Columns: " . implode(", ", $columns) . "\n";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
