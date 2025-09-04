<?php
session_start();
require_once '../Controlador/ControladorEstadoPagos.php';
$controlador = new ControladorEstadoPagos();
// Seleccionar método según rol
$idCliente = $_SESSION['user_id'] ?? null;
if ($_SESSION['rol'] === 'admin') {
    $data = $controlador->listarEstadoPagos();
} else {
    $data = $idCliente ? $controlador->listarEstadoPagosPorCliente($idCliente) : [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Pagos - Ticofit</title>
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
            max-width: 1000px;
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
        .table-responsive {
            margin-top: 20px;
        }
        .table {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th {
            background-color: #e74c3c;
            color: white;
            font-weight: 500;
        }
        .table td {
            vertical-align: middle;
        }
        .vencido, .por-renovar {
            color: #e74c3c;
            font-weight: bold;
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
    <h2>Estado de Pagos - Ticofit</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Membresía</th>
                <th>Estado de Pago</th>
                <th>Fecha de Pago</th>
                <th>Días Restantes</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($item['tipoMembresia']); ?></td>
                    <td><?php echo htmlspecialchars($item['estadoPago'] ?? 'Pendiente'); ?></td>
                    <td><?php echo htmlspecialchars($item['fechaPago']); ?></td>
                    <td>
                        <?php
                        $dias = $item['diasRestantes'];
                        if ($dias < 0) {
                            echo "<span class='vencido'>Vencido</span>";
                        } elseif ($dias < 7) {
                            echo "<span class='por-renovar'>$dias (Por Renovar)</span>";
                        } else {
                            echo htmlspecialchars($dias);
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="Dashboard.php" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Volver al Menú</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>