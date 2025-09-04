<?php
require_once '../Modelo/Conexio.php';
$conn = new Conexio();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = (int)$_POST['cantidad'];
    $estado = $_POST['estado'];
    $fecha_adquisicion = $_POST['fecha_adquisicion'];

    $stmt = $conn->conn->prepare("INSERT INTO inventario (nombre, descripcion, cantidad, estado, fecha_adquisicion) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $cantidad, $estado, $fecha_adquisicion]);
    header("Location: Inventario.php");
    exit();
}

$stmt = $conn->conn->query("SELECT * FROM inventario");
$inventario = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario - Ticofit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: url('../imagenes/TICOFIT9.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Arial', sans-serif;
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
    <h2>Gestión de Inventario - Ticofit</h2>
    <h3>Agregar Nuevo Equipo</h3>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Equipo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
                <option value="disponible">Disponible</option>
                <option value="en_mantenimiento">En Mantenimiento</option>
                <option value="roto">Roto</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_adquisicion" class="form-label">Fecha de Adquisición</label>
            <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" required>
        </div>
        <button type="submit" name="agregar" class="btn btn-primary">Agregar Equipo</button>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Fecha de Adquisición</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($inventario as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($item['descripcion'] ?: 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
                    <td><?php echo htmlspecialchars($item['estado']); ?></td>
                    <td><?php echo htmlspecialchars($item['fecha_adquisicion']); ?></td>
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