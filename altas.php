<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO recetario (nombre, descripcion, ingredientes, instrucciones, categoria, tiempo_prep, porciones, dificultad, imagen_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nombre'], $_POST['descripcion'], $_POST['ingredientes'], 
            $_POST['instrucciones'], $_POST['categoria'], $_POST['tiempo_prep'], 
            $_POST['porciones'], $_POST['dificultad'], $_POST['imagen_url']
        ]);
        $mensaje = '<div class="alert alert-success">✅ Receta agregada exitosamente.</div>';
    } catch(Exception $e) {
        $mensaje = '<div class="alert alert-danger">❌ Error: ' . $e->getMessage() . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altas - Mi Recetario</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #10b981; --primary-hover: #059669; --bg-color: #0f172a; --card-bg: rgba(30, 41, 59, 0.7); --text-main: #f8fafc; --text-muted: #94a3b8; }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-color); background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,0.2) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,0.2) 0, transparent 50%); color: var(--text-main); min-height: 100vh; padding-bottom: 50px;}
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 50px; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); position: sticky; top: 0; z-index: 100;}
        .navbar h1 { font-size: 24px; font-weight: 700; background: linear-gradient(to right, #38ef7d, #11998e); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-back { background: rgba(255,255,255,0.1); color: var(--text-main); padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        
        .form-card { background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 40px; backdrop-filter: blur(10px); }
        .form-card h2 { font-size: 28px; margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px;}
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 14px; color: var(--text-muted); font-weight: 600; }
        .form-control { width: 100%; padding: 12px 15px; background: rgba(15, 23, 42, 0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #fff; font-size: 14px; transition: all 0.3s ease; }
        .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-row { display: flex; gap: 15px; }
        .form-row .form-group { flex: 1; }
        
        .btn-primary { background: var(--primary); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; width: 100%; font-size: 16px; margin-top: 10px;}
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4); }
        
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; text-align: center; }
        .alert-success { background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .alert-danger { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Mi Recetario - Altas</h1>
        <a href="first.php" class="btn-back">⬅ Volver al Menú</a>
    </nav>

    <div class="container">
        <div class="form-card">
            <h2>Agregar Nueva Receta</h2>
            <?php echo $mensaje; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Nombre de la Receta</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>URL de la Imagen</label>
                    <input type="url" name="imagen_url" class="form-control" placeholder="https://..." required>
                </div>
                <div class="form-group">
                    <label>Descripción Corta</label>
                    <input type="text" name="descripcion" class="form-control" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Categoría</label>
                        <input type="text" name="categoria" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Dificultad</label>
                        <select name="dificultad" class="form-control" required>
                            <option value="Fácil">Fácil</option>
                            <option value="Media">Media</option>
                            <option value="Difícil">Difícil</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Tiempo (min)</label>
                        <input type="number" name="tiempo_prep" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Porciones</label>
                        <input type="number" name="porciones" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ingredientes</label>
                    <textarea name="ingredientes" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Instrucciones</label>
                    <textarea name="instrucciones" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn-primary">Guardar Receta</button>
            </form>
        </div>
    </div>
</body>
</html>
