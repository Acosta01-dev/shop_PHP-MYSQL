<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: ../pages/login_register_screen.php");
} else {
    echo "<a href='../index.php'P> Go Back </a>";
    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        echo "<ul>";
        foreach ($_SESSION['carrito'] as $producto) {
            echo "<li>{$producto['nombre']} - ({$producto['cantidad']} units) - Total: $ " . number_format($producto['precio'] * $producto['cantidad'], 2) . " 
            <input type='number' name='cant' value='{$producto['cantidad']}' min='1' max='99'> 
            <button class='actualizar-cantidad' data-id='{$producto['id']}'>Update Quantity</button>
            <button class='eliminar-item' data-id='{$producto['id']}'>Delete Product</button>
           </li>";
        }
        echo "</ul>";
    
        echo "<a href='../php/checkout.php'> Pay </a>";
    } else {
        echo "<p>The cart is empty.</p>";
    }
}
?>

<script src="../app/app.js"></script>