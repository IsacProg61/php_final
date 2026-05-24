<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
            /* Animated Gradient Background */
            background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);
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
        .login-wrapper {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 50px 40px;
            border-radius: 24px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .login-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), inset 0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        .login-wrapper h2 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 600;
            font-size: 32px;
            letter-spacing: 0.5px;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.8);
            letter-spacing: 0.5px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #fff;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            /* Premium gradient for button */
            background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(79, 172, 254, 0.4);
            margin-top: 15px;
        }

        .btn-submit:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 12px 25px rgba(79, 172, 254, 0.6);
        }

        .btn-submit:active {
            transform: translateY(1px) scale(0.98);
            box-shadow: 0 4px 10px rgba(79, 172, 254, 0.3);
        }

        .error-msg {
            color: #ff8787;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            font-weight: 400;
            background: rgba(255, 0, 0, 0.15);
            border: 1px solid rgba(255, 135, 135, 0.3);
            padding: 12px;
            border-radius: 8px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <h2>Bienvenido</h2>
        <!-- Formulario apuntando a autentica.php como solicitado -->
        <form action="autentica.php" method="POST">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit" class="btn-submit">Iniciar Sesión</button>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="error-msg">Usuario o contraseña incorrectos.</div>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>
