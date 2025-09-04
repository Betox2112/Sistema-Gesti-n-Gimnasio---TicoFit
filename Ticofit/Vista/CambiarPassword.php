<?php
session_start();
require_once '../Modelo/Conexio.php';

$conn = new Conexio();
$success = '';
$error = '';

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = trim($_POST['current_password'] ?? '');
    $newPassword = trim($_POST['new_password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');

    // Verificar contraseña actual
    $stmtCheck = $conn->conn->prepare("SELECT contraseña FROM usuario WHERE id = :id");
    $stmtCheck->execute(['id' => $_SESSION['user_id']]);
    $user = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($currentPassword === $user['contraseña']) {
            if (strlen($newPassword) < 6) {
                $error = "La nueva contraseña debe tener al menos 6 caracteres.";
            } elseif ($newPassword !== $confirmPassword) {
                $error = "Las contraseñas no coinciden.";
            } else {
                $stmtUpdate = $conn->conn->prepare("UPDATE usuario SET contraseña = :password WHERE id = :id");
                $stmtUpdate->execute(['password' => $newPassword, 'id' => $_SESSION['user_id']]);
                $success = "Contraseña cambiada exitosamente.";
            }
        } else {
            $error = "Contraseña actual incorrecta. Verifica que sea la correcta.";
            // Para depuración (eliminar en producción)
            error_log("Contraseña ingresada: $currentPassword, Contraseña almacenada: " . $user['contraseña']);
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña - Ticofit</title>
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
            max-width: 500px;
            padding: 25px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: auto;
        }
        .login-container h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }
        .form-label {
            font-weight: 500;
            color: #34495e;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: #e74c3c;
            border: none;
            transition: background-color 0.3s;
            padding: 10px;
            font-size: 1rem;
            border-radius: 8px;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #c0392b;
        }
        .btn-secondary {
            background-color: #34495e;
            border: none;
            color: white;
            padding: 10px;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            width: 100%;
            margin-top: 10px;
            border-radius: 8px;
        }
        .btn-secondary:hover {
            background-color: #2c3e50;
        }
        .gym-icon {
            font-size: 2.2rem;
            color: #e74c3c;
            margin-bottom: 15px;
        }
        .mb-3 {
            margin-bottom: 12px;
        }
        .form-control {
            padding: 10px 40px 10px 12px;
            font-size: 1rem;
            height: 45px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .text-success {
            font-size: 1rem;
            margin-bottom: 15px;
            padding: 8px;
            background-color: #dff0d8;
            border-radius: 5px;
            text-align: center;
        }
        .text-danger {
            font-size: 1rem;
            margin-bottom: 15px;
            padding: 8px;
            background-color: #f8d7da;
            border-radius: 5px;
            text-align: center;
        }
        .security-tips {
            margin-top: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            font-size: 0.9rem;
            color: #7f8c8d;
        }
        .security-tips ul {
            list-style-type: disc;
            padding-left: 20px;
            margin: 0;
        }
        .input-group {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #34495e;
            font-size: 1rem;
            z-index: 10;
        }
        .form-control:focus + .toggle-password {
            color: #34495e;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="text-center">
        <i class="fas fa-key gym-icon"></i>
        <h2>Cambiar Contraseña</h2>
    </div>
    <?php if ($success): ?>
        <p class="text-success"><?php echo $success; ?></p>
        <a href="Dashboard.php" class="btn btn-secondary">Volver al Menú</a>
    <?php elseif ($error): ?>
        <p class="text-danger"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (!$success): ?>
        <form method="POST">
            <div class="mb-3">
                <label for="current_password" class="form-label"><i class="fas fa-lock"></i> Contraseña Actual *</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Ingrese su contraseña actual" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('current_password')"></i>
                </div>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label"><i class="fas fa-lock"></i> Nueva Contraseña *</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Mínimo 6 caracteres" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('new_password')"></i>
                </div>
                <small class="text-muted">Mínimo 6 caracteres</small>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label"><i class="fas fa-lock"></i> Confirmar Nueva Contraseña *</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Repita la nueva contraseña" required>
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('confirm_password')"></i>
                </div>
            </div>
            <div class="security-tips">
                <p><i class="fas fa-info-circle"></i> Recomendaciones de Seguridad</p>
                <ul>
                    <li>Use al menos 8 caracteres</li>
                    <li>Combine letras mayúsculas y minúsculas</li>
                    <li>Incluya números y símbolos</li>
                    <li>Evite información personal fácil de adivinar</li>
                    <li>No reutilice contraseñas de otros servicios</li>
                </ul>
            </div>
            <a href="Dashboard.php" class="btn btn-secondary mt-3"><i class="fas fa-times"></i> Cancelar</a>
            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-check"></i> Cambiar Contraseña</button>
        </form>
    <?php endif; ?>
</div>
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>