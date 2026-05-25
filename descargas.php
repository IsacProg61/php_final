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
    <title>Descargas - Mi Recetario</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #8b5cf6; --primary-hover: #7c3aed; --bg-color: #0f172a; --card-bg: rgba(30, 41, 59, 0.7); --text-main: #f8fafc; --text-muted: #94a3b8; }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-color); background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,0.2) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,0.2) 0, transparent 50%); color: var(--text-main); min-height: 100vh; padding-bottom: 50px;}
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 50px; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); position: sticky; top: 0; z-index: 100;}
        .navbar h1 { font-size: 24px; font-weight: 700; background: linear-gradient(to right, #a78bfa, #8b5cf6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-back { background: rgba(255,255,255,0.1); color: var(--text-main); padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 800px; margin: 80px auto; padding: 0 20px; }
        
        .card { background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 50px; text-align: center; backdrop-filter: blur(10px); }
        .icon { font-size: 64px; margin-bottom: 20px; }
        .title { font-size: 28px; font-weight: 700; margin-bottom: 15px; }
        .desc { font-size: 16px; color: var(--text-muted); margin-bottom: 40px; line-height: 1.5; }
        
        .btn-download { display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: var(--primary); color: white; border: none; padding: 15px 30px; border-radius: 12px; font-weight: 600; font-size: 18px; cursor: pointer; transition: all 0.3s; text-decoration: none; }
        .btn-download:hover { background: var(--primary-hover); transform: translateY(-3px); box-shadow: 0 10px 25px rgba(139, 92, 246, 0.4); }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Mi Recetario - Descargas</h1>
        <a href="first.php" class="btn-back">⬅ Volver al Menú</a>
    </nav>

    <div class="container">
        <div class="card">
            <div class="icon">📥</div>
            <h2 class="title">Exportar Datos del Sistema</h2>
            <p class="desc">Descarga una copia completa de tu catálogo de recetas en formato CSV.<br>Este archivo puede ser abierto en Excel o Google Sheets para su análisis.</p>
            
            <a href="exportar_csv.php" class="btn-download">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Descargar CSV
            </a>
        </div>
    </div>
</body>
</html>
