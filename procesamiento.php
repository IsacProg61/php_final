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
    <title>Procesamiento - Mi Recetario</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #ec4899; --primary-hover: #db2777; --bg-color: #0f172a; --card-bg: rgba(30, 41, 59, 0.7); --text-main: #f8fafc; --text-muted: #94a3b8; }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-color); background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,0.2) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,0.2) 0, transparent 50%); color: var(--text-main); min-height: 100vh; padding-bottom: 50px;}
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 20px 50px; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.05); position: sticky; top: 0; z-index: 100;}
        .navbar h1 { font-size: 24px; font-weight: 700; background: linear-gradient(to right, #f472b6, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-back { background: rgba(255,255,255,0.1); color: var(--text-main); padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        
        .card { background: var(--card-bg); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 40px; backdrop-filter: blur(10px); }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { font-size: 28px; margin-bottom: 10px; }
        .header p { color: var(--text-muted); }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; }
        .form-control { width: 100%; padding: 15px; background: rgba(15, 23, 42, 0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; font-size: 16px; transition: all 0.3s ease; resize: vertical; min-height: 120px;}
        .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2); }
        
        .btn-submit { background: var(--primary); color: white; border: none; padding: 15px 30px; border-radius: 12px; font-weight: 600; font-size: 16px; cursor: pointer; transition: all 0.3s; width: 100%; display: flex; justify-content: center; align-items: center; gap: 10px;}
        .btn-submit:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(236, 72, 153, 0.4); }
        .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; transform: none; box-shadow: none; }

        /* Loader */
        .loader { width: 20px; height: 20px; border: 3px solid rgba(255,255,255,0.3); border-radius: 50%; border-top-color: #fff; animation: spin 1s ease-in-out infinite; display: none; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Results Area */
        #resultsArea { display: none; margin-top: 30px; background: rgba(0,0,0,0.2); border-radius: 16px; padding: 25px; border: 1px solid rgba(236, 72, 153, 0.2); animation: fadeIn 0.5s ease;}
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        .results-title { font-size: 20px; font-weight: 700; margin-bottom: 20px; color: #f472b6; text-align: center; }
        .stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .stat-box { background: rgba(255,255,255,0.05); padding: 15px; border-radius: 10px; text-align: center; }
        .stat-value { font-size: 24px; font-weight: 700; margin-bottom: 5px; }
        .stat-label { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; }

        .score-box { grid-column: span 2; background: linear-gradient(135deg, rgba(236,72,153,0.2), rgba(15,23,42,0)); border: 1px solid rgba(236,72,153,0.3); }
        .score-value { color: #f472b6; font-size: 32px; }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Mi Recetario - Procesamiento</h1>
        <a href="first.php" class="btn-back">⬅ Volver al Menú</a>
    </nav>

    <div class="container">
        <div class="card">
            <div class="header">
                <h2>⚡ Análisis Nutricional Serverless</h2>
                <p>Ingresa los ingredientes de tu receta. Nuestra API simulada calculará el valor nutricional mediante procesamiento asíncrono.</p>
            </div>

            <form id="analyzerForm">
                <div class="form-group">
                    <label>Lista de Ingredientes (separados por coma)</label>
                    <textarea id="ingredientesInput" class="form-control" placeholder="Ej: 2 huevos, 100g de harina, 1 taza de leche, 2 cucharadas de azúcar..." required></textarea>
                </div>
                
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span id="btnText">Analizar Ingredientes</span>
                    <div class="loader" id="loader"></div>
                </button>
            </form>

            <div id="resultsArea">
                <h3 class="results-title">Resultados del Análisis</h3>
                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-value" id="resCalorias">0</div>
                        <div class="stat-label">Calorías (kcal)</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-value" id="resProteinas">0g</div>
                        <div class="stat-label">Proteínas</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-value" id="resCarbs">0g</div>
                        <div class="stat-label">Carbohidratos</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-value" id="resGrasas">0g</div>
                        <div class="stat-label">Grasas</div>
                    </div>
                    <div class="stat-box score-box">
                        <div class="stat-value score-value" id="resScore">0/100</div>
                        <div class="stat-label">Health Score</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('analyzerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const ingredientes = document.getElementById('ingredientesInput').value;
            const btn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const loader = document.getElementById('loader');
            const resultsArea = document.getElementById('resultsArea');

            // Set loading state
            btn.disabled = true;
            btnText.textContent = 'Procesando en la nube...';
            loader.style.display = 'block';
            resultsArea.style.display = 'none';

            try {
                const response = await fetch('api_procesamiento.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ ingredientes: ingredientes })
                });

                const data = await response.json();

                if (response.ok) {
                    // Update UI with results
                    document.getElementById('resCalorias').textContent = data.resultados.calorias;
                    document.getElementById('resProteinas').textContent = data.resultados.proteinas;
                    document.getElementById('resCarbs').textContent = data.resultados.carbohidratos;
                    document.getElementById('resGrasas').textContent = data.resultados.grasas;
                    document.getElementById('resScore').textContent = data.resultados.score + '/100';
                    
                    resultsArea.style.display = 'block';
                } else {
                    alert('Error: ' + (data.error || 'Ocurrió un problema'));
                }
            } catch (error) {
                alert('Error de conexión con la función serverless.');
                console.error(error);
            } finally {
                // Reset loading state
                btn.disabled = false;
                btnText.textContent = 'Analizar Ingredientes';
                loader.style.display = 'none';
            }
        });
    </script>
</body>
</html>
