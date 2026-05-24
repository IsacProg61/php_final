<?php
session_start();
require "conexion.php";

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['contrasena'] ?? '';

if (empty($usuario) || empty($password)) {
    header("Location: index.php?error=1");
    exit();
}

try {
    // IMPORTANTE: Ajusta los nombres de las columnas ('usuario' y 'contrasena') según tu base de datos en PostgreSQL
    // En el ejemplo de la clase usabas 'user' y 'pass'. Si es así, usa la siguiente línea en su lugar:
    // $query = "SELECT * FROM usuarios WHERE \"user\" = :usuario AND pass = :contrasena";
    
    $query = "SELECT * FROM usuarios WHERE name = :usuario AND password = :contrasena";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $password);
    $stmt->execute();
    
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        // Autenticación exitosa
        $_SESSION['usuario'] = $usuario;
        
        // Redirigir a la página principal después de iniciar sesión
        // Si no tienes bienvenida.php, cámbialo por el archivo que corresponda.
        header("Location: first.php"); 
        exit();
    } else {
        // Autenticación fallida
        header("Location: index.php?error=1");
        exit();
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>
