<?php
require 'conexion.php';
try {
    $pdo->exec("ALTER TABLE usuarios ADD COLUMN IF NOT EXISTS token VARCHAR(255)");
    echo "Column 'token' added successfully.";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
