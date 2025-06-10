<?php
session_start(); // Muy importante para acceder a $_SESSION

if (isset($_SESSION['nombres']) && isset($_SESSION['ciudad'])) {
    echo "<h2>¡La cotización fue enviada con éxito!</h2>";
    echo "<p>Gracias, <strong>" . htmlspecialchars($_SESSION['nombres']) . "</strong> de <strong>" . htmlspecialchars($_SESSION['ciudad']) . "</strong>.</p>";
} else {
    echo "<h2>No hay datos disponibles.</h2>";
}

// Limpiar la sesión al final
session_unset();
session_destroy();
?>
