<?php
// Datos de configuración de la base de datos
$host = "aws-1-us-west-2.pooler.supabase.com";
$port = "6543";
$usuario = "postgres.mwisgzjojhabghmzgwbz";
$base_de_datos = "postgres";
$contrasena = "Contrasupa61%";

try {

    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$base_de_datos",
        $usuario,
        $contrasena
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Conectado correctamente"; // Comentado para no interferir con las redirecciones header()

} catch (PDOException $e) {

    echo "Error de conexión: " . $e->getMessage();
}

?>