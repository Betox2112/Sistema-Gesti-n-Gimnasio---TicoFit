<?php
require_once '../Controlador/ControladorLogin.php';
$controlador = new ControladorLogin();
$error = $controlador->validarLogin();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Gestión Gimnasio - TicoFit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('../imagenes/TICOFIT9.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
        }
        .login-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .login-container h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 500;
            color: #34495e;
        }
        .btn-primary {
            background-color: #e74c3c;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #c0392b;
        }
        .btn-secondary {
            background-color: #7f8c8d;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-secondary:hover {
            background-color: #6c757d;
        }
        .gym-icon {
            font-size: 2rem;
            color: #e74c3c;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="text-center">
        <i class="fas fa-dumbbell gym-icon"></i>
        <h2>Iniciar Sesión - Sistema Gestión Gimnasio - TicoFit</h2>
    </div>
    <?php if ($error) echo "<p class='text-danger text-center'>$error</p>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Usuario:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i> Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100 mb-2"><i class="fas fa-sign-in-alt"></i> Ingresar a Mi Cuenta</button>
        <button type="button" class="btn btn-secondary w-100 mb-2" onclick="clearForm()"><i class="fas fa-eraser"></i> Limpiar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function clearForm() { document.querySelector('form').reset(); }
</script>
</body>
</html>