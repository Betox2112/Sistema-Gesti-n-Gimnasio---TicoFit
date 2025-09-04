<?php
session_start();
require_once '../Modelo/Conexio.php';

$conn = new Conexio();
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

$stmt = $conn->conn->prepare("SELECT id, cliente_id, fecha_hora, estado FROM asistencia");
$stmt->execute();
$asistencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia - Ticofit</title>
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
            max-width: 800px;
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
        .table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th {
            background-color: #e74c3c;
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            text-align: center;
        }
        .table td {
            color: #34495e;
            vertical-align: middle;
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
    </style>
</head>
<body>
<div class="content">
    <h2>Asistencia - Ticofit</h2>
    <?php if (empty($asistencias)): ?>
        <p class="text-center">No hay asistencias registradas.</p>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($asistencias as $asistencia): ?>
                <?php
                $clienteStmt = $conn->conn->prepare("SELECT u.nombre FROM usuario u JOIN cliente c ON u.id = c.idUsuario WHERE c.clienteId = :clienteId");
                $clienteStmt->execute(['clienteId' => $asistencia['cliente_id']]);
                $cliente = $clienteStmt->fetchColumn();
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($asistencia['id']); ?></td>
                    <td><?php echo htmlspecialchars($cliente ?: 'No encontrado'); ?></td>
                    <td><?php echo htmlspecialchars($asistencia['fecha_hora']); ?></td>
                    <td><?php echo htmlspecialchars($asistencia['estado']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <a href="Dashboard.php" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Volver al Menú</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>