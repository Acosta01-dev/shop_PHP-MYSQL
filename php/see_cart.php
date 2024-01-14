<?php
session_start();

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    echo "<ul>";
    foreach ($_SESSION['carrito'] as $producto) {
        echo "<li>{$producto['nombre']} - $" . number_format($producto['precio'] * $producto['cantidad'], 2) .  " ({$producto['cantidad']} unidades)</li>";
    }
    echo "</ul>";
} else {
    echo "<p>El carrito está vacío.</p>";
}
