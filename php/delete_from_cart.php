<?php 
 if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $indice => $producto) {
        if ($producto['id'] == $idEliminar) {
            unset($_SESSION['carrito'][$indice]);
            break;
        }
    }
}
?>