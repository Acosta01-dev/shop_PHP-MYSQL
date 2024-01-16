<?php
session_start();

$idEliminar = $_POST["eliminar_id"];
$indiceEliminar = null;

foreach ($_SESSION["carrito"] as $indice => $producto) {
    if ($producto['id'] == $idEliminar) {
        $indiceEliminar = $indice;
        break;
    }
}

if ($indiceEliminar !== null && isset($_SESSION["carrito"][$indiceEliminar])) {
    unset($_SESSION["carrito"][$indiceEliminar]);
}
?>
