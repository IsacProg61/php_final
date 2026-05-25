<?php

$url = "https://analizador-calorico-716174557013.us-west1.run.app";

$data = [
    "peso" => $_POST["peso"],
    "altura" => $_POST["altura"],
    "calorias" => $_POST["calorias"]
];

$options = [
    "http" => [
        "header"  => "Content-Type: application/json",
        "method"  => "POST",
        "content" => json_encode($data)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

$resultado = json_decode($response, true);

?>

<!DOCTYPE html>
<html>
<head>
<style>
.resultado{
    width: 400px;
    margin: 50px auto;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    font-family: Arial;
}
h2{
    text-align:center;
}
</style>
</head>

<body>

<div class="resultado">
    <h2>📊 Resultado</h2>

    <p><b>TMB:</b> <?= $resultado["tmb"] ?></p>
    <p><b>Estado:</b> <?= $resultado["estado"] ?></p>
    <p><b>Recomendación:</b> <?= $resultado["recomendacion"] ?></p>
</div>

</body>
</html>