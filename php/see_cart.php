<?php
session_start();
print_r($_SESSION);

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    echo "<ul>";
    foreach ($_SESSION['carrito'] as $producto) {
        echo "<li>{$producto['nombre']} - ({$producto['cantidad']} unidades) - Total: $ " . number_format($producto['precio'] * $producto['cantidad'], 2) . " <button class='eliminar-item' data-id='{$producto['id']}'>Eliminar Producto</button></li>";
    }
    echo "</ul>";
} else {
    echo "<p>El carrito está vacío.</p>";
}

?>

<script src="../app/app.js"></script>

