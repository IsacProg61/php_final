<?php
// Verificar si viene de un logout para evitar redirección
$esLogout = isset($_GET['logout']) && $_GET['logout'] == 'true';

if (!$esLogout && (isset($_COOKIE["usuario"]) && isset($_COOKIE["token"]))) {
    require 'conexion.php';
    
    $query = "SELECT name, token FROM usuarios WHERE name = :usuario";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['usuario' => $_COOKIE["usuario"]]);
    $registro = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        $usuarioreal = $registro["name"];
        $tokenreal = $registro["token"];
        
        if (($_COOKIE["usuario"] == $usuarioreal) && ($_COOKIE["token"] == $tokenreal)) {
            session_start();
            $_SESSION['usuario'] = $usuarioreal;
            header("Location: first.php");
            exit();
        }
    }
    
    // Si llegamos aquí, las cookies son inválidas
    setcookie("usuario", "", time() - 3600, "/");
    setcookie("token", "", time() - 3600, "/");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Modern Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%); background-size: 400% 400%; animation: gradientBG 15s ease infinite; color: #fff; overflow: hidden; flex-direction: column; gap: 20px;}
        @keyframes gradientBG { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        
        .messages-wrapper { width: 100%; max-width: 420px; z-index: 10; }
        .message { padding: 15px; border-radius: 12px; margin-bottom: 10px; font-size: 14px; font-weight: 600; text-align: center; animation: fadeIn 0.3s ease; }
        .message.error { background: rgba(255, 0, 0, 0.15); border: 1px solid rgba(255, 135, 135, 0.3); color: #ff8787; }
        .message.success { background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #34d399; }
        
        .login-wrapper { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); padding: 50px 40px; border-radius: 24px; width: 100%; max-width: 420px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1); transition: transform 0.4s ease, box-shadow 0.4s ease; }
        .login-wrapper:hover { transform: translateY(-5px); box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), inset 0 0 0 1px rgba(255, 255, 255, 0.2); }
        .login-wrapper h2 { text-align: center; margin-bottom: 40px; font-weight: 600; font-size: 32px; letter-spacing: 0.5px; color: #ffffff; text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        .form-group { margin-bottom: 25px; position: relative; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 400; color: rgba(255, 255, 255, 0.8); letter-spacing: 0.5px; }
        .form-group input[type="text"], .form-group input[type="password"] { width: 100%; padding: 16px; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 12px; color: #fff; font-size: 16px; transition: all 0.3s ease; }
        .form-group input:focus { outline: none; border-color: #fff; background: rgba(255, 255, 255, 0.15); box-shadow: 0 0 15px rgba(255, 255, 255, 0.2); }
        .form-group input::placeholder { color: rgba(255, 255, 255, 0.4); }
        
        .options { margin-bottom: 25px; display: flex; align-items: center; }
        .options label { font-size: 14px; color: rgba(255, 255, 255, 0.8); cursor: pointer; display: flex; align-items: center; gap: 8px; }
        
        .btn-submit { width: 100%; padding: 16px; background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%); border: none; border-radius: 12px; color: #fff; font-size: 17px; font-weight: 600; letter-spacing: 1px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(79, 172, 254, 0.4); }
        .btn-submit:hover { transform: translateY(-2px) scale(1.02); box-shadow: 0 12px 25px rgba(79, 172, 254, 0.6); }
        .btn-submit:active { transform: translateY(1px) scale(0.98); box-shadow: 0 4px 10px rgba(79, 172, 254, 0.3); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <div class="messages-wrapper">
        <?php
            if (isset($_GET['error']) && $_GET['error'] == 1): 
                echo '<div class="message error">Usuario o contraseña incorrectos</div>';
            endif; 
            
            if (isset($_GET['error']) && $_GET['error'] == 2): 
                echo '<div class="message error">Error sesión expirada u obsoleta</div>';
            endif;

            if (isset($_GET['error']) && $_GET['error'] == 3): 
                echo '<div class="message error">No se puede estar sin permiso :(</div>';
            endif;

            if (isset($_GET['logout']) && $_GET['logout'] == 'true'): 
                echo '<div class="message success">Sesión cerrada correctamente</div>';
            endif;
        ?>
    </div>

    <div class="login-wrapper">
        <h2>Bienvenido</h2>
        <form action="autentica.php" method="POST">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
            </div>
            
            <div class="options">
                <label class="remember">
                    <input type="checkbox" name="recordar">
                    Mantener sesión iniciada
                </label>
            </div>

            <button type="submit" class="btn-submit">Iniciar Sesión</button>
        </form>
    </div>

</body>
</html>
