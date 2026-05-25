<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body {
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                radial-gradient(at 50% 0%, hsla(225,39%,30%,0.2) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(339,49%,30%,0.2) 0, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
        }
        .navbar {
            display: flex; justify-content: space-between; align-items: center; padding: 20px 50px;
            background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.05); position: sticky; top: 0; z-index: 100;
        }
        .navbar h1 { font-size: 24px; font-weight: 700; background: linear-gradient(to right, #38ef7d, #11998e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .user-info { display: flex; align-items: center; gap: 20px; }
        .btn-logout { background: rgba(255,255,255,0.1); color: var(--text-main); padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; }
        .btn-logout:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 1000px; margin: 60px auto; padding: 0 20px; }
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; }
        
        .menu-card {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px; padding: 40px 30px; text-align: center;
            backdrop-filter: blur(10px); text-decoration: none; color: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
        }
        .menu-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .menu-icon { font-size: 48px; margin-bottom: 20px; }
        .menu-title { font-size: 22px; font-weight: 600; margin-bottom: 10px; }
        .menu-desc { font-size: 14px; color: var(--text-muted); line-height: 1.5; }

        .card-altas:hover { border-color: #10b981; }
        .card-consultas:hover { border-color: #3b82f6; }
        .card-cambios:hover { border-color: #f59e0b; }
        .card-bajas:hover { border-color: #ef4444; }
        .card-descargas:hover { border-color: #8b5cf6; }
        .card-procesamiento:hover { border-color: #ec4899; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Cloude Computing</h1>
        <div class="user-info">
            <span>Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong></span>
            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 36px; font-weight: 700; margin-bottom: 10px;">Panel de Control</h2>
            <p style="color: var(--text-muted); font-size: 18px;">Selecciona una operación a realizar</p>
        </div>

        <div class="dashboard-grid">
            <a href="altas.php" class="menu-card card-altas">
                <div class="menu-icon">✨</div>
                <h3 class="menu-title">Altas</h3>
                <p class="menu-desc">Registra nuevas recetas en la base de datos con toda su información e imagen.</p>
            </a>
            
            <a href="consultas.php" class="menu-card card-consultas">
                <div class="menu-icon">🔍</div>
                <h3 class="menu-title">Consultas</h3>
                <p class="menu-desc">Explora y visualiza todas las recetas existentes de forma detallada.</p>
            </a>
            
            <a href="cambios.php" class="menu-card card-cambios">
                <div class="menu-icon">📝</div>
                <h3 class="menu-title">Cambios</h3>
                <p class="menu-desc">Modifica y actualiza la información de recetas previamente registradas.</p>
            </a>

            <a href="bajas.php" class="menu-card card-bajas">
                <div class="menu-icon">🗑️</div>
                <h3 class="menu-title">Bajas</h3>
                <p class="menu-desc">Elimina recetas de forma segura del sistema.</p>
            </a>

            <a href="descargas.php" class="menu-card card-descargas">
                <div class="menu-icon">📥</div>
                <h3 class="menu-title">Descargas</h3>
                <p class="menu-desc">Exporta y descarga el catálogo completo de recetas en un archivo.</p>
            </a>

            <a href="procesamiento.php" class="menu-card card-procesamiento">
                <div class="menu-icon">⚡</div>
                <h3 class="menu-title">Procesamiento</h3>
                <p class="menu-desc">Analiza ingredientes usando nuestra función serverless avanzada.</p>
            </a>
        </div>
    </div>
</body>
</html>
