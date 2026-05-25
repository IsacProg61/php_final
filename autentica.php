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
    $query = "SELECT * FROM usuarios WHERE name = :usuario AND password = :contrasena";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $password);
    $stmt->execute();
    
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        session_regenerate_id(true); 
        $_SESSION['usuario'] = $usuario;
        $_SESSION["ultimo_acceso"] = time(); 

        if (isset($_POST["recordar"])){
            $token = bin2hex(random_bytes(16));
            $queryUpdate = "UPDATE usuarios SET token = :token WHERE name = :usuario";
            $stmtUpdate = $pdo->prepare($queryUpdate);
            $stmtUpdate->execute([':token' => $token, ':usuario' => $usuario]);

            setcookie("token", $token, time() + (60*60*24*30), "/", "", false, true); 
            setcookie("usuario", $usuario, time() + (60*60*24*30), "/", "", false, true);
        }
        
        header("Location: first.php"); 
        exit();
    } else {
        header("Location: index.php?error=1");
        exit();
    }
} catch (PDOException $e) {
    header("Location: index.php?error=4");
    exit();
}
?>
