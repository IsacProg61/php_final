<?php
session_start();

// Validar que el usuario haya iniciado sesión
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
    <title>Logeado</title>
    <!-- Modern Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Animated Gradient Background in Greens for success */
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Glassmorphism Container */
        .success-wrapper {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 60px 50px;
            border-radius: 24px;
            width: 100%;
            max-width: 450px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2), inset 0 0 0 1px rgba(255, 255, 255, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .success-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.3);
        }

        .success-wrapper h2 {
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 40px;
            letter-spacing: 0.5px;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .success-wrapper p {
            font-size: 18px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 35px;
        }

        .btn-logout {
            display: inline-block;
            padding: 14px 30px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 12px;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.35);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .icon {
            font-size: 65px;
            margin-bottom: 20px;
            animation: bounce 2s infinite ease-in-out;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>

    <div class="success-wrapper">
        <div class="icon">🚀</div>
        <h2>¡Logeado!</h2>
        <p>Bienvenido de nuevo, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>.</p>
        <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
    </div>

</body>
</html>
