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
<title>Descargas - Mi Recetario</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --bg: #0f172a;
    --card: rgba(30, 41, 59, 0.7);
    --primary: #ec4899;
    --text: #f8fafc;
    --muted: #94a3b8;
}

* {
    margin: 0;
    padding: 0;
    font-family: 'Inter', sans-serif;
    box-sizing: border-box;
}

body {
    background: var(--bg);
    color: var(--text);
    padding: 40px 20px;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
    background: linear-gradient(to right, #f472b6, #ec4899);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.container {
    max-width: 900px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.card {
    background: var(--card);
    border-radius: 16px;
    padding: 20px;
    border: 1px solid rgba(255,255,255,0.1);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    border-color: var(--primary);
}

.titulo {
    font-weight: 600;
    margin-bottom: 10px;
}

a {
    display: inline-block;
    margin-top: 10px;
    color: var(--primary);
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

.back {
    display: block;
    text-align: center;
    margin-bottom: 20px;
    color: var(--muted);
    text-decoration: none;
}
</style>
</head>

<body>

<a class="back" href="first.php">⬅ Volver al menú</a>

<h1>📥 Descargas del Semestre</h1>

<div class="container">

    <div class="card">
        <div class="titulo">📄 Tarea 1</div>
        <a href="https://storage.googleapis.com/proyecto-recetario-descargas/Tarea%201.pdf" target="_blank">Descargar PDF</a>
    </div>

    <div class="card">
        <div class="titulo">📄 Tarea 2</div>
        <a href="https://storage.googleapis.com/proyecto-recetario-descargas/Tarea%202..pdf" target="_blank">Descargar PDF</a>
    </div>

    <div class="card">
        <div class="titulo">📄 Tarea 3</div>
        <a href="https://storage.googleapis.com/proyecto-recetario-descargas/Tarea%203.pdf" target="_blank">Descargar PDF</a>
    </div>

    <div class="card">
        <div class="titulo">📄 Tarea 4</div>
        <a href="https://storage.googleapis.com/proyecto-recetario-descargas/Tarea%204.pdf" target="_blank">Descargar PDF</a>
    </div>

    <div class="card">
        <div class="titulo">📄 Tarea 7</div>
        <a href="https://storage.googleapis.com/proyecto-recetario-descargas/Tarea%207.%20Realizaci%C3%B3n%20de%20micro-cursos%20en%20AWS%20Educate%20y%20ensayo%20(1).pdf" target="_blank">Descargar PDF</a>
    </div>

    <div class="card">
        <div class="titulo">📄 Tarea 8</div>
        <a href="https://storage.googleapis.com/proyecto-recetario-descargas/Tarea%208.%20Realizaci%C3%B3n%20de%20micro-cursos%20en%20AWS%20Educate%20y%20ensayo.docx.pdf" target="_blank">Descargar PDF</a>
    </div>

    <div class="card">
        <div class="titulo">📄 Tarea 9</div>
        <a href="https://storage.googleapis.com/proyecto-recetario-descargas/Tarea%209.%20Realizaci%C3%B3n%20de%20micro-cursos%20en%20AWS%20Educate%20y%20ensayo.docx.pdf" target="_blank">Descargar PDF</a>
    </div>

    <div class="card">
        <div class="titulo">📄 Tarea 13</div>
        <a href="https://storage.googleapis.com/proyecto-recetario-descargas/Tarea%2013.%20Realizaci%C3%B3n%20de%20cursos%20en%20Oracle%20MyLearn.docx.pdf" target="_blank">Descargar PDF</a>
    </div>

</div>

</body>
</html>