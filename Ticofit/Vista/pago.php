<?php
session_start();
require_once '../Modelo/Conexio.php';

$conn = new Conexio();
// Permitir acceso a ambos roles: admin y cliente
if (!isset($_SESSION['user_id']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'cliente')) {
    header("Location: Login.php");
    exit();
}

$stmtUsuarios = $conn->conn->prepare("SELECT id, nombre FROM usuario");
$stmtUsuarios->execute();
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);

$stmtMembresias = $conn->conn->prepare("SELECT membresiaId, tipoMembresia, costo, fechaFin FROM membresias");
$stmtMembresias->execute();
$membresias = $stmtMembresias->fetchAll(PDO::FETCH_ASSOC);

$successMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioId = $_POST['usuarioId'] ?? '';
    $membresiaId = $_POST['membresiaId'] ?? '';
    $metodoPago = $_POST['metodoPago'] ?? '';

    if ($usuarioId && $membresiaId && $metodoPago) {
        $stmt = $conn->conn->prepare("INSERT INTO pagos (usuarioId, membresiaId, monto, metodoPago) VALUES (?, ?, ?, ?)");
        $monto = $membresias[array_search($membresiaId, array_column($membresias, 'membresiaId'))]['costo'];
        $stmt->execute([$usuarioId, $membresiaId, $monto, $metodoPago]);
        $successMessage = 'Pago realizado con éxito.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago - Ticofit</title>
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
        .recibo {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid #e74c3c;
            display: none;
        }
        .alert-success {
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>
<div class="content">
    <h2>Pago - Ticofit</h2>
    <form method="POST" action="" id="pagoForm">
        <div class="form-group">
            <label for="usuarioId">Seleccionar Cliente:</label>
            <select name="usuarioId" id="usuarioId" class="form-control" required onchange="updateMembresiaOptions()">
                <?php if ($_SESSION['rol'] === 'cliente'): ?>
                    <?php
                    $clienteActual = $_SESSION['user_id'];
                    $usuario = $conn->conn->prepare("SELECT id, nombre FROM usuario WHERE id = ?");
                    $usuario->execute([$clienteActual]);
                    $cliente = $usuario->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <option value="<?php echo htmlspecialchars($cliente['id']); ?>">
                        <?php echo htmlspecialchars($cliente['nombre']); ?>
                    </option>
                <?php else: ?>
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?php echo htmlspecialchars($usuario['id']); ?>">
                            <?php echo htmlspecialchars($usuario['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="membresiaId">Seleccionar Membresía:</label>
            <select name="membresiaId" id="membresiaId" class="form-control" required>
                <option value="">Seleccione una membresía</option>
                <?php foreach ($membresias as $membresia): ?>
                    <option value="<?php echo htmlspecialchars($membresia['membresiaId']); ?>" data-costo="<?php echo htmlspecialchars($membresia['costo']); ?>" data-fecha-fin="<?php echo htmlspecialchars($membresia['fechaFin']); ?>">
                        <?php echo htmlspecialchars($membresia['tipoMembresia']); ?> (₡<?php echo htmlspecialchars(number_format($membresia['costo'], 2)); ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Método de Pago:</label>
            <div>
                <div class="form-check">
                    <input type="radio" name="metodoPago" value="efectivo" id="efectivo" class="form-check-input" required>
                    <label for="efectivo" class="form-check-label">Efectivo</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="metodoPago" value="transferencia" id="transferencia" class="form-check-input">
                    <label for="transferencia" class="form-check-label">Transferencia Bancaria</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="metodoPago" value="tarjeta" id="tarjeta" class="form-check-input">
                    <label for="tarjeta" class="form-check-label">Tarjeta</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Pago</button>
    </form>
    <div class="recibo" id="recibo">
        <h3>Recibo de Pago</h3>
        <p>Subtotal: <span id="subtotal">₡0.00</span></p>
        <p>Descuento: <span id="descuento">₡0.00</span></p>
        <p>Impuesto (13%): <span id="impuesto">₡0.00</span></p>
        <p><strong>Total: <span id="total">₡0.00</strong></span></p>
        <p>Fecha de Pago: <span id="fechaPago"></span></p>
        <p>Días Restantes: <span id="diasRestantes">0</span></p>
    </div>
    <?php if ($successMessage): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($successMessage); ?>
        </div>
    <?php endif; ?>
    <a href="Dashboard.php" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Volver al Menú</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function updateRecibo() {
        const membresiaSelect = document.getElementById('membresiaId');
        const recibo = document.getElementById('recibo');
        const subtotalSpan = document.getElementById('subtotal');
        const descuentoSpan = document.getElementById('descuento');
        const impuestoSpan = document.getElementById('impuesto');
        const totalSpan = document.getElementById('total');
        const fechaPagoSpan = document.getElementById('fechaPago');
        const diasRestantesSpan = document.getElementById('diasRestantes');

        if (membresiaSelect.value) {
            const selectedOption = membresiaSelect.options[membresiaSelect.selectedIndex];
            const costo = parseFloat(selectedOption.getAttribute('data-costo')) || 0;
            const fechaFin = new Date(selectedOption.getAttribute('data-fecha-fin'));
            const hoy = new Date();

            const subtotal = costo;
            const descuento = 0;
            const impuesto = subtotal * 0.13;
            const total = subtotal + impuesto - descuento;

            subtotalSpan.textContent = `₡${subtotal.toFixed(2)}`;
            descuentoSpan.textContent = `₡${descuento.toFixed(2)}`;
            impuestoSpan.textContent = `₡${impuesto.toFixed(2)}`;
            totalSpan.textContent = `₡${total.toFixed(2)}`;
            fechaPagoSpan.textContent = new Date().toLocaleString();
            diasRestantesSpan.textContent = Math.max(0, Math.ceil((fechaFin - hoy) / (1000 * 60 * 60 * 24)));

            recibo.style.display = 'block';
        } else {
            recibo.style.display = 'none';
        }
    }

    function updateMembresiaOptions() {
        updateRecibo();
    }

    document.getElementById('membresiaId').addEventListener('change', updateRecibo);
    document.getElementById('usuarioId').addEventListener('change', updateMembresiaOptions);

    // Mostrar notificación de éxito si existe
    <?php if ($successMessage): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.alert-success');
        alert.style.display = 'block';
        setTimeout(() => {
            alert.style.display = 'none';
        }, 3000); // Ocultar después de 3 segundos
    });
    <?php endif; ?>
</script>