<?php
$conexion = new mysqli("sql303.infinityfree.com", "if0_39195234", "ddSDwgVOvoI", "if0_39195234_cotizaciones_web");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM solicitudes ORDER BY id DESC";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Cotizaciones</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .cotizacion { margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Historial de Cotizaciones</h1>
    
    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <div class="cotizacion">
            <h2>Cotización #<?= $fila['id'] ?></h2>
            <p><strong>Cliente:</strong> <?= htmlspecialchars($fila['nombres']) ?></p>
            <p><strong>Ciudad:</strong> <?= htmlspecialchars($fila['ciudad']) ?></p>
            <p><strong>Fecha:</strong> <?= $fila['fecha'] ?></p>
            
            <h3>Productos:</h3>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
                <?php 
                $productos = explode(", ", $fila['productos']);
                $cantidades = explode(", ", $fila['cantidades']);
                foreach($productos as $index => $producto): 
                ?>
                <tr>
                    <td><?= htmlspecialchars($producto) ?></td>
                    <td><?= htmlspecialchars($cantidades[$index] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <p><strong>Total:</strong> $<?= number_format($fila['total'], 2) ?></p>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay cotizaciones registradas.</p>
    <?php endif; ?>
    
    <?php $conexion->close(); ?>
    <p><a href="index.html">Volver al inicio</a></p>
</body>
</html>