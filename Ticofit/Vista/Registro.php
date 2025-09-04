<?php
require_once '../Controlador/ControladorRegistro.php';
$controlador = new ControladorRegistro();
$success = $controlador->procesarRegistro();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Ticofit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('../imagenes/registrationgym.jpg') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-container {
            max-width: 500px; /* Aumentado a 500px para mayor adaptabilidad */
            padding: 25px; /* Aumentado para mejor espaciado */
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); /* Sombra más pronunciada */
            position: relative;
            overflow: auto;
        }
        .login-container h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px; /* Aumentado para mejor separación */
            font-size: 1.8rem; /* Aumentado para mayor impacto */
        }
        .form-label {
            font-weight: 500;
            color: #34495e;
            font-size: 1rem; /* Aumentado para legibilidad */
        }
        .btn-primary {
            background-color: #e74c3c;
            border: none;
            transition: background-color 0.3s;
            padding: 10px; /* Aumentado para mejor clickeabilidad */
            font-size: 1rem; /* Aumentado para coherencia */
            border-radius: 8px; /* Bordes más suaves */
        }
        .btn-primary:hover {
            background-color: #c0392b;
        }
        .btn-secondary {
            background-color: #34495e;
            border: none;
            color: white;
            padding: 10px; /* Aumentado para coherencia */
            font-size: 1rem; /* Aumentado para legibilidad */
            text-decoration: none;
            display: inline-block;
            text-align: center;
            width: 100%;
            margin-top: 15px; /* Aumentado para separación */
            border-radius: 8px; /* Bordes más suaves */
        }
        .btn-secondary:hover {
            background-color: #2c3e50;
        }
        .gym-icon {
            font-size: 2.2rem; /* Aumentado para mayor presencia */
            color: #e74c3c;
            margin-bottom: 15px; /* Aumentado para mejor espaciado */
        }
        .mb-3 {
            margin-bottom: 12px; /* Aumentado para mejor separación */
        }
        .form-control, .form-select {
            padding: 10px 12px; /* Aumentado para mejor usabilidad */
            font-size: 1rem; /* Aumentado para legibilidad */
            height: 45px; /* Aumentado para mayor tamaño */
            border-radius: 8px; /* Bordes más suaves */
            border: 1px solid #ddd; /* Borde sutil */
        }
        .text-success {
            font-size: 1rem; /* Aumentado para coherencia */
            margin-bottom: 15px; /* Aumentado para separación */
            padding: 8px;
            background-color: #dff0d8; /* Fondo verde suave */
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="text-center">
        <i class="fas fa-user-plus gym-icon"></i>
        <h2>Registro Cliente - Ticofit</h2>
    </div>
    <?php if ($success) echo "<p class='text-success text-center'>$success</p>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label"><i class="fas fa-user"></i> Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellidos" class="form-label"><i class="fas fa-user"></i> Apellidos:</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label"><i class="fas fa-lock"></i> Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="cedula" class="form-label"><i class="fas fa-id-card"></i> Cédula o DIMEX:</label>
            <input type="text" class="form-control" id="cedula" name="cedula" pattern="[0-9]{9,12}" placeholder="Ej: 123456789 o 123456789012">
        </div>
        <div class="mb-3">
            <label for="celular" class="form-label"><i class="fas fa-phone"></i> Celular:</label>
            <input type="tel" class="form-control" id="celular" name="celular" pattern="[0-9]{8}" placeholder="Ej: 12345678" required>
        </div>
        <div class="mb-3">
            <label for="preferencias" class="form-label"><i class="fas fa-dumbbell"></i> Preferencias:</label>
            <select class="form-select" id="preferencias" name="preferencias" required>
                <option value="">Seleccione una preferencia</option>
                <option value="bajar_peso">Bajar de Peso</option>
                <option value="subir_masa">Subir de Masa Corporal</option>
                <option value="mejorar_resistencia">Mejorar Resistencia</option>
                <option value="tonificar">Tonificar</option>
                <option value="flexibilidad">Flexibilidad</option>
                <option value="salud_general">Salud General</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tipoMembresia" class="form-label"><i class="fas fa-ticket"></i> Tipo de Membresía:</label>
            <select class="form-select" id="tipoMembresia" name="tipoMembresia" required>
                <option value="Mensual">Mensual</option>
                <option value="Anual">Anual</option>
            </select>
        </div>
        <button type="submit" name="register" class="btn btn-primary w-100"><i class="fas fa-check"></i> Confirmar Registro</button>
        <a href="Dashboard.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver al Menú</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>