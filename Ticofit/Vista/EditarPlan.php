<?php
session_start();
require_once '../Modelo/Conexio.php';

$conn = new Conexio();
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: Login.php");
    exit();
}

$planId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$plan = [];
if ($planId) {
    $stmt = $conn->conn->prepare("SELECT id, nombre, descripcion FROM plan_entrenamiento WHERE id = ?");
    $stmt->execute([$planId]);
    $plan = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $planId) {
    $stmt = $conn->conn->prepare("UPDATE plan_entrenamiento SET nombre = ?, descripcion = ? WHERE id = ?");
    $stmt->execute([$_POST['nombre'], $_POST['descripcion'], $planId]);
    header("Location: PlanEntrenamiento.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Plan - Ticofit</title>
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
        .content {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .content h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
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
            background-color: #34495e;
            border: none;
            color: white;
            transition: background-color 0.3s;
        }
        .btn-secondary:hover {
            background-color: #2c3e50;
        }
        @media (max-width: 768px) {
            .content { margin: 20px; }
        }
    </style>
</head>
<body>
<div class="content">
    <h2>Editar Plan</h2>
    <?php if ($plan): ?>
        <form method="POST">
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($plan['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required><?php echo htmlspecialchars($plan['descripcion']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="PlanEntrenamiento.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php else: ?>
        <p class="text-center">Plan no encontrado.</p>
        <a href="PlanEntrenamiento.php" class="btn btn-secondary">Volver</a>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>