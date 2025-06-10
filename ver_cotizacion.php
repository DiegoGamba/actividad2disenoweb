<?php
$conexion = new mysqli("localhost", "root", "concha24", "cotizaciones_web");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta de todos los registros
$sql = "SELECT * FROM cotizaciones ORDER BY id DESC";
$resultado = $conexion->query($sql);

// Precios fijos de productos
$precios = [
    'Laptop' => 3000000,
    'Mouse' => 50000,
    'Teclado' => 80000,
    'Monitor' => 700000,
    'Parlantes' => 120000
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Cotización</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h1>Resumen de Cotizaciones</h1>

    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <h2>Solicitud de <?php echo htmlspecialchars($fila['nombres']); ?></h2>
            <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($fila['ciudad']); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($fila['direccion']); ?></p>
            <p><strong>Celular:</strong> <?php echo htmlspecialchars($fila['celular']); ?></p>

            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
                <?php
                $total_general = 0;
                foreach ($precios as $producto => $precio_unitario) {
                    $campo_cantidad = strtolower($producto); // ejemplo: laptop, mouse
                    $cantidad = intval($fila[$campo_cantidad]);

                    if ($cantidad > 0) {
                        $subtotal = $cantidad * $precio_unitario;
                        $total_general += $subtotal;
                        echo "<tr>
                            <td>$producto</td>
                            <td>$cantidad</td>
                            <td>$precio_unitario</td>
                            <td>$subtotal</td>
                        </tr>";
                    }
                }
                ?>
                <tr>
                    <th colspan="3">Total General</th>
                    <th><?php echo $total_general; ?></th>
                </tr>
            </table>
            <hr>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay cotizaciones registradas.</p>
    <?php endif; ?>

    <?php $conexion->close(); ?>

    <br><a href="index.html">Volver al inicio</a>

</body>
</html>
