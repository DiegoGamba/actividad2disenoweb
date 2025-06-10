<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos (ajusta con tus credenciales de InfinityFree)
$conexion = new mysqli("sql303.infinityfree.com", "if0_39195234", "ddSDwgVOvoI", "if0_39195234_cotizaciones_web");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Validar y sanitizar datos
$nombres = $conexion->real_escape_string($_POST['nombres']);
$ciudad = $conexion->real_escape_string($_POST['ciudad']);
$direccion = $conexion->real_escape_string($_POST['direccion']);
$celular = $conexion->real_escape_string($_POST['celular']);

// Procesar productos
$productos = [];
$cantidades = [];
$total = 0;

// Precios definidos (deben coincidir con los del formulario)
$precios = [
    'Producto A' => 10000,
    'Producto B' => 20000,
    'Producto C' => 15000
];

if(isset($_POST['productos']) && is_array($_POST['productos'])) {
    foreach($_POST['productos'] as $producto) {
        if(isset($_POST['cantidades'][$producto]) && is_numeric($_POST['cantidades'][$producto])) {
            $cantidad = intval($_POST['cantidades'][$producto]);
            if($cantidad > 0) {
                $productos[] = $producto;
                $cantidades[] = $cantidad;
                $total += $precios[$producto] * $cantidad;
            }
        }
    }
}

// Insertar en la base de datos
$sql = "INSERT INTO solicitudes (nombres, ciudad, direccion, celular, productos, cantidades, total) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$productos_texto = implode(", ", $productos);
$cantidades_texto = implode(", ", $cantidades);
$stmt->bind_param("ssssssd", $nombres, $ciudad, $direccion, $celular, $productos_texto, $cantidades_texto, $total);

if($stmt->execute()) {
    $_SESSION['cotizacion'] = [
        'nombres' => $nombres,
        'ciudad' => $ciudad,
        'direccion' => $direccion,
        'celular' => $celular,
        'productos' => $productos,
        'cantidades' => $cantidades,
        'precios' => $precios,
        'total' => $total
    ];
    header("Location: resumen_cotizacion.php");
    exit;
} else {
    die("Error al guardar la cotización: " . $conexion->error);
}

$stmt->close();
$conexion->close();
?>