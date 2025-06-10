<?php
session_start();  // INICIAR SESIÓN AL INICIO

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$conexion = new mysqli("sql303.infinityfree.com", "if0_39195234", "ddSDwgVOvoI", "if0_39195234_cotizaciones_web");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombres = $_POST['nombres'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$celular = $_POST['celular'];

// Obtener productos seleccionados y cantidades
$productos = isset($_POST['productos']) ? $_POST['productos'] : [];
$cantidades = isset($_POST['cantidades']) ? $_POST['cantidades'] : [];

// Convertir a texto para almacenar
$productosTexto = implode(",", $productos);
$cantidadesTexto = implode(",", $cantidades);

// Insertar en la base de datos
$sql = "INSERT INTO solicitudes (nombres_apellidos, ciudad, direccion, celular, productos, cantidades)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssss", $nombres, $ciudad, $direccion, $celular, $productosTexto, $cantidadesTexto);
$stmt->execute();
$stmt->close();
$conexion->close();

// GUARDAR DATOS EN $_SESSION para usarlos en resumen_cotizacion.php
$_SESSION['nombres'] = $nombres;
$_SESSION['ciudad'] = $ciudad;
$_SESSION['direccion'] = $direccion;
$_SESSION['celular'] = $celular;
$_SESSION['productos'] = $productosTexto;
$_SESSION['cantidades'] = $cantidadesTexto;

// Redirigir a la página de resumen
header("Location: resumen_cotizacion.php");
exit;
?>
