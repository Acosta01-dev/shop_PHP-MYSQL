<?php
session_start();

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
    echo "<ul>";
    foreach ($_SESSION['carrito'] as $producto) {
        echo "<li>{$producto['nombre']} - ({$producto['cantidad']} unidades) - Total: $ " . number_format($producto['precio'] * $producto['cantidad'], 2) . " 
        <input type='number' name='cant' value='{$producto['cantidad']}' min='1' max='99'> 
        <button class='actualizar-cantidad' data-id='{$producto['id']}'>Actualizar Cantidad</button>
        <button class='eliminar-item' data-id='{$producto['id']}'>Eliminar Producto</button>
       </li>";
    }
    echo "</ul>";

    echo "<a href='../php/checkout.php'> Pagar </a>";
} else {
    echo "<p>El carrito está vacío.</p>";
}
?>

<script src="../app/app.js"></script>