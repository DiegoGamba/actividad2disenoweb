<?php
session_start();
if(!isset($_SESSION['cotizacion'])) {
    header("Location: index.html");
    exit;
}

$cotizacion = $_SESSION['cotizacion'];
unset($_SESSION['cotizacion']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Cotización</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Resumen de tu Cotización</h1>
    
    <h2>Datos del Cliente</h2>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($cotizacion['nombres']) ?></p>
    <p><strong>Ciudad:</strong> <?= htmlspecialchars($cotizacion['ciudad']) ?></p>
    <p><strong>Dirección:</strong> <?= htmlspecialchars($cotizacion['direccion']) ?></p>
    <p><strong>Celular:</strong> <?= htmlspecialchars($cotizacion['celular']) ?></p>
    
    <h2>Productos Cotizados</h2>
    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach($cotizacion['productos'] as $index => $producto): ?>
        <tr>
            <td><?= htmlspecialchars($producto) ?></td>
            <td><?= htmlspecialchars($cotizacion['cantidades'][$index]) ?></td>
            <td>$<?= number_format($cotizacion['precios'][$producto], 2) ?></td>
            <td>$<?= number_format($cotizacion['precios'][$producto] * $cotizacion['cantidades'][$index], 2) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="total">
            <td colspan="3">Total</td>
            <td>$<?= number_format($cotizacion['total'], 2) ?></td>
        </tr>
    </table>
    
    <p><a href="index.html">Volver al inicio</a></p>
</body>
</html>