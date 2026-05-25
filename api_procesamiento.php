<?php
// Función Serverless Simulada para el Análisis Nutricional
header('Content-Type: application/json');

// Permitir solo método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['ingredientes']) || empty($data['ingredientes'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Se requieren ingredientes']);
    exit();
}

// Simular el retraso de una petición a una función serverless/API externa
usleep(1500000); // 1.5 seconds

$ingredientes = trim($data['ingredientes']);

// Lógica simulada de cálculo nutricional (basada en la longitud del texto y random)
$calorias_base = (strlen($ingredientes) * 4) + rand(100, 300);
$proteinas = rand(5, 50);
$carbohidratos = rand(10, 80);
$grasas = rand(2, 30);
$health_score = rand(60, 98);

$response = [
    'status' => 'success',
    'mensaje' => 'Análisis completado',
    'resultados' => [
        'calorias' => $calorias_base,
        'proteinas' => $proteinas . 'g',
        'carbohidratos' => $carbohidratos . 'g',
        'grasas' => $grasas . 'g',
        'score' => $health_score
    ]
];

echo json_encode($response);
?>
