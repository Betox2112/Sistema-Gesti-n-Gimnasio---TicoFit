<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Vista/Login.php");
    exit();
}

// Manejo del cierre de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header("Location: ../Vista/Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Ticofit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('../imagenes/TICOFIT9.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }
        .config-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .card-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .nav-tabs .nav-link {
            color: #2c3e50;
            background-color: #ecf0f1;
            border: none;
            border-radius: 5px 5px 0 0;
            margin-right: 5px;
        }
        .nav-tabs .nav-link.active {
            background-color: #e74c3c;
            color: #fff;
        }
        .tab-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .config-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .config-option i {
            font-size: 1.2rem;
            margin-right: 15px;
            color: #34495e;
        }
        .config-option:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }
        .btn-config {
            background-color: #34495e;
            border: none;
            color: white;
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        .btn-config:hover {
            background-color: #2c3e50;
        }
        .btn-danger {
            background-color: #e74c3c;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        @media (max-width: 768px) {
            .config-container { margin: 20px; }
            .btn-config, .btn-danger { width: 100%; margin-bottom: 10px; }
        }
    </style>
</head>
<body>
<div class="config-container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Configuración</h2>
            <ul class="nav nav-tabs" id="configTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="perfil-tab" data-bs-toggle="tab" data-bs-target="#perfil" type="button" role="tab">Perfil</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="notificaciones-tab" data-bs-toggle="tab" data-bs-target="#notificaciones" type="button" role="tab">Notificaciones</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seguridad-tab" data-bs-toggle="tab" data-bs-target="#seguridad" type="button" role="tab">Seguridad</button>
                </li>
            </ul>
            <div class="tab-content" id="configTabContent">
                <div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
                    <div class="config-option" onclick="alert('Función de Editar Perfil en desarrollo.')">
                        <i class="fas fa-user-graduate"></i>
                        <span>Editar Perfil</span>
                    </div>
                    <div class="config-option" onclick="alert('Función de Cambiar Foto en desarrollo.')">
                        <i class="fas fa-image"></i>
                        <span>Cambiar Foto de Perfil</span>
                    </div>
                </div>
                <div class="tab-pane fade" id="notificaciones" role="tabpanel" aria-labelledby="notificaciones-tab">
                    <div class="config-option" onclick="alert('Función de Notificaciones en desarrollo.')">
                        <i class="fas fa-bell-slash"></i>
                        <span>Habilitar Notificaciones</span>
                    </div>
                    <div class="config-option" onclick="alert('Función de Email en desarrollo.')">
                        <i class="fas fa-paper-plane"></i>
                        <span>Preferencias de Email</span>
                    </div>
                </div>
                <div class="tab-pane fade" id="seguridad" role="tabpanel" aria-labelledby="seguridad-tab">
                    <div class="config-option" onclick="alert('Función de Autenticación en desarrollo.')">
                        <i class="fas fa-shield-check"></i>
                        <span>Activar Autenticación de Dos Factores</span>
                    </div>
                    <div class="config-option" onclick="alert('Función de Historial en desarrollo.')">
                        <i class="fas fa-clock"></i>
                        <span>Historial de Actividad</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <form method="POST" style="display: inline;" onsubmit="return confirm('¿Seguro que deseas cerrar sesión?')">
                    <button type="submit" name="cerrar_sesion" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
                <a href="Dashboard.php" class="btn btn-config">
                    <i class="fas fa-arrow-left"></i> Volver al Menú
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>