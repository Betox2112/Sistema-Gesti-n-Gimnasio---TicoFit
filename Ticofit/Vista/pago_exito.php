<?php
session_start();
$mensaje = $_SESSION['mensaje_pago']; 'Error en el procesamiento del pago.';
unset($_SESSION['mensaje_pago']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso - Ticofit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .content { margin-left: 250px; padding: 20px; }
        .success-container { margin-top: 20px; }
    </style>
</head>
<body>
<div class="content">
    <h2>Pago Exitoso - Ticofit</h2>
    <div class="success-container">
        <p class="text-success"><?php echo $mensaje; ?></p>
    </div>
    <a href="Dashboard.php" class="btn btn-secondary mt-3">Volver al Menú</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>