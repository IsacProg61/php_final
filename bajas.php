<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

require 'conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    try {
        $stmt = $pdo->prepare("DELETE FROM recetario WHERE id=?");
        $stmt->execute([$_POST['id']]);
        $mensaje = '<div class="alert alert-success">✅ Receta eliminada exitosamente.</div>';
    } catch(Exception $e) {
        $mensaje = '<div class="alert alert-danger">❌ Error: ' . $e->getMessage() . '</div>';
    }
}

$stmt = $pdo->query("SELECT * FROM recetario ORDER BY id DESC");
$recetas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bajas - Mi Recetario</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #ef4444; --primary-hover: #dc2626; --bg-color: #0f172a; --card-bg: rgba(30, 41, 59, 0.7); --text-main: #f8fafc; --text-muted: #94a3b8; }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-color); background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,0.2) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,0.2) 0, transparent 50%); color: var(--text-main); min-height: 100vh; padding-bottom: 50px;}
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 50px; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); position: sticky; top: 0; z-index: 100;}
        .navbar h1 { font-size: 24px; font-weight: 700; background: linear-gradient(to right, #f87171, #ef4444); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-back { background: rgba(255,255,255,0.1); color: var(--text-main); padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 25px; font-weight: 600; text-align: center; }
        .alert-success { background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
        .alert-danger { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); }

        .list-group { display: flex; flex-direction: column; gap: 15px; }
        .list-item { background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(10px); transition: all 0.3s; }
        .list-item:hover { border-color: rgba(239, 68, 68, 0.4); transform: translateX(5px); }
        .item-img { width: 80px; height: 80px; border-radius: 8px; object-fit: cover; }
        .item-info { flex-grow: 1; }
        .item-title { font-size: 18px; font-weight: 600; margin-bottom: 5px; }
        .item-desc { font-size: 14px; color: var(--text-muted); }
        
        .btn-delete { background: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; text-decoration: none;}
        .btn-delete:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3); }

        /* Modal Styles */
        .modal-backdrop { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); display: flex; justify-content: center; align-items: center; z-index: 1000; opacity: 0; visibility: hidden; transition: all 0.3s ease; }
        .modal-backdrop.active { opacity: 1; visibility: visible; }
        .modal-content { background: #1e293b; width: 100%; max-width: 400px; border-radius: 20px; padding: 30px; border: 1px solid rgba(239, 68, 68, 0.3); transform: scale(0.9); transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); text-align: center; }
        .modal-backdrop.active .modal-content { transform: scale(1); }
        
        .warning-icon { font-size: 48px; margin-bottom: 15px; }
        .modal-title { font-size: 22px; font-weight: 700; margin-bottom: 10px;}
        .modal-desc { color: var(--text-muted); margin-bottom: 25px; line-height: 1.5; font-size: 14px;}
        
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Mi Recetario - Bajas</h1>
        <a href="first.php" class="btn-back">⬅ Volver al Menú</a>
    </nav>

    <div class="container">
        <h2 style="font-size: 28px; margin-bottom: 30px; font-weight: 700;">Selecciona una receta para eliminar</h2>
        <?php echo $mensaje; ?>
        
        <div class="list-group">
            <?php foreach($recetas as $receta): ?>
            <div class="list-item">
                <img src="<?php echo htmlspecialchars($receta['imagen_url']); ?>" alt="<?php echo htmlspecialchars($receta['nombre']); ?>" class="item-img" onerror="this.src='https://images.unsplash.com/photo-1495195134817-a1a288f56c04?w=600'">
                <div class="item-info">
                    <h3 class="item-title"><?php echo htmlspecialchars($receta['nombre']); ?></h3>
                    <p class="item-desc">ID: <?php echo $receta['id']; ?> | Categoría: <?php echo htmlspecialchars($receta['categoria']); ?></p>
                </div>
                <button class="btn-delete" onclick="openDeleteModal(<?php echo $receta['id']; ?>, '<?php echo addslashes(htmlspecialchars($receta['nombre'])); ?>')">Eliminar</button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div class="modal-backdrop" id="deleteModal">
        <div class="modal-content">
            <div class="warning-icon">⚠️</div>
            <h3 class="modal-title">¿Estás seguro?</h3>
            <p class="modal-desc">Estás a punto de eliminar permanentemente la receta <strong id="modalRecipeName" style="color:#fff;"></strong>. Esta acción no se puede deshacer.</p>
            
            <form method="POST">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" id="formId" value="">
                
                <div style="display: flex; gap: 15px; margin-top: 20px;">
                    <button type="button" class="btn-back" style="flex:1; justify-content: center;" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-delete" style="flex:1">Sí, Eliminar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('deleteModal');
        
        function openDeleteModal(id, nombre) {
            document.getElementById('formId').value = id;
            document.getElementById('modalRecipeName').textContent = '"' + nombre + '"';
            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
    </script>
</body>
</html>
