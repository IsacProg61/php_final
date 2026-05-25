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
:root {
    --primary: #ec4899;
    --primary-hover: #db2777;
    --bg-color: #0f172a;
    --card-bg: rgba(30, 41, 59, 0.7);
    --text-main: #f8fafc;
    --text-muted: #94a3b8;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Inter', sans-serif;
}

body {
    background-color: var(--bg-color);
    background-image: radial-gradient(at 0% 0%, rgba(0,0,0,0.4), transparent 50%),
                      radial-gradient(at 50% 0%, rgba(236,72,153,0.1), transparent 50%);
    color: var(--text-main);
    min-height: 100vh;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.navbar h1 {
    font-size: 22px;
    background: linear-gradient(to right, #f472b6, #ec4899);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.btn-back {
    background: rgba(255,255,255,0.1);
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
}

.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 0 20px;
}

.card {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 40px;
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
}

.header {
    text-align: center;
    margin-bottom: 30px;
}

.header h2 {
    font-size: 28px;
    margin-bottom: 10px;
}

.header p {
    color: var(--text-muted);
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: 600;
    font-size: 14px;
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 14px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.1);
    background: rgba(15,23,42,0.5);
    color: white;
    outline: none;
}

input:focus {
    border-color: var(--primary);
}

.btn-submit {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 12px;
    background: var(--primary);
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn-submit:hover {
    background: var(--primary-hover);
}

.loader {
    display: none;
    width: 18px;
    height: 18px;
    border: 3px solid rgba(255,255,255,0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-left: 10px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

#resultsArea {
    display: none;
    margin-top: 25px;
    padding: 20px;
    background: rgba(0,0,0,0.2);
    border-radius: 15px;
    border: 1px solid rgba(236,72,153,0.2);
}

.result-item {
    margin: 10px 0;
    padding: 10px;
    background: rgba(255,255,255,0.05);
    border-radius: 10px;
}
</style>
</head>

<body>

<nav class="navbar">
    <h1>⚡ Procesamiento Serverless</h1>
    <a href="first.php" class="btn-back">⬅ Volver</a>
</nav>

<div class="container">

<div class="card">

    <div class="header">
        <h2>Análisis Calórico Inteligente</h2>
        <p>Ingresa tus datos y analiza tu balance energético usando Cloud Run</p>
    </div>

    <form id="analyzerForm">

        <div class="form-group">
            <label>Peso (kg)</label>
            <input type="number" id="peso" required>
        </div>

        <div class="form-group">
            <label>Altura (cm)</label>
            <input type="number" id="altura" required>
        </div>

        <div class="form-group">
            <label>Calorías diarias</label>
            <input type="number" id="calorias" required>
        </div>

        <button type="submit" class="btn-submit">
            Analizar
            <span class="loader" id="loader"></span>
        </button>

    </form>

    <div id="resultsArea">

        <div class="result-item" id="r1"></div>
        <div class="result-item" id="r2"></div>
        <div class="result-item" id="r3"></div>

    </div>

</div>

</div>

<script>
document.getElementById("analyzerForm").addEventListener("submit", async function(e){
    e.preventDefault();

    const peso = document.getElementById("peso").value;
    const altura = document.getElementById("altura").value;
    const calorias = document.getElementById("calorias").value;

    const loader = document.getElementById("loader");
    const results = document.getElementById("resultsArea");

    loader.style.display = "inline-block";
    results.style.display = "none";

    try {

        const response = await fetch("https://analizador-calorico-716174557013.us-west1.run.app", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                peso,
                altura,
                calorias
            })
        });

        const data = await response.json();

        document.getElementById("r1").innerHTML = "🔥 TMB: " + data.tmb;
        document.getElementById("r2").innerHTML = "📊 Estado: " + data.estado;
        document.getElementById("r3").innerHTML = "💡 Recomendación: " + data.recomendacion;

        results.style.display = "block";

    } catch (error) {
        alert("Error conectando con serverless");
        console.log(error);
    }

    loader.style.display = "none";

});
</script>

</body>
</html>