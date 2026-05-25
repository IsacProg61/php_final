<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$stmt = $pdo->query("SELECT * FROM recetario ORDER BY id DESC");
$recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas - Mi Recetario</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #3b82f6; --bg-color: #0f172a; --card-bg: rgba(30, 41, 59, 0.7); --text-main: #f8fafc; --text-muted: #94a3b8; }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-color); background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,0.2) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,0.2) 0, transparent 50%); color: var(--text-main); min-height: 100vh; padding-bottom: 50px;}
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 50px; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); position: sticky; top: 0; z-index: 100;}
        .navbar h1 { font-size: 24px; font-weight: 700; background: linear-gradient(to right, #60a5fa, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-back { background: rgba(255,255,255,0.1); color: var(--text-main); padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        
        .recipes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px; }
        .recipe-card { background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; overflow: hidden; backdrop-filter: blur(10px); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; flex-direction: column; }
        .recipe-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.4); border-color: rgba(59, 130, 246, 0.4); }
        .recipe-img { width: 100%; height: 200px; object-fit: cover; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .recipe-content { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
        .recipe-tags { display: flex; gap: 10px; margin-bottom: 10px; flex-wrap: wrap; }
        .badge { font-size: 11px; padding: 4px 10px; border-radius: 20px; background: rgba(255,255,255,0.1); color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .badge.categoria { background: rgba(59, 130, 246, 0.2); color: #60a5fa; }
        .badge.dificultad { background: rgba(245, 158, 11, 0.2); color: #fbbf24; }
        .recipe-title { font-size: 20px; font-weight: 600; margin-bottom: 10px; color: #fff; }
        .recipe-desc { font-size: 14px; color: var(--text-muted); line-height: 1.5; margin-bottom: 20px; flex-grow: 1; }
        .recipe-meta { display: flex; justify-content: space-between; font-size: 13px; color: var(--text-muted); padding-top: 15px; border-top: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Mi Recetario - Consultas</h1>
        <a href="first.php" class="btn-back">⬅ Volver al Menú</a>
    </nav>

    <div class="container">
        <h2 style="font-size: 28px; margin-bottom: 30px; font-weight: 700;">Catálogo de Recetas (<?php echo count($recetas); ?>)</h2>
        <div class="recipes-grid">
            <?php foreach($recetas as $receta): ?>
            <div class="recipe-card">
                <img src="<?php echo htmlspecialchars($receta['imagen_url']); ?>" alt="<?php echo htmlspecialchars($receta['nombre']); ?>" class="recipe-img" onerror="this.src='https://images.unsplash.com/photo-1495195134817-a1a288f56c04?w=600'">
                <div class="recipe-content">
                    <div class="recipe-tags">
                        <span class="badge categoria"><?php echo htmlspecialchars($receta['categoria']); ?></span>
                        <span class="badge dificultad"><?php echo htmlspecialchars($receta['dificultad']); ?></span>
                    </div>
                    <h3 class="recipe-title"><?php echo htmlspecialchars($receta['nombre']); ?></h3>
                    <p class="recipe-desc"><?php echo htmlspecialchars($receta['descripcion']); ?></p>
                    
                    <div class="recipe-meta">
                        <span>⏱️ <?php echo htmlspecialchars($receta['tiempo_prep']); ?> min</span>
                        <span>🍽️ <?php echo htmlspecialchars($receta['porciones']); ?> porciones</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
