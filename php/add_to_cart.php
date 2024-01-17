<?php
session_start();

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = array();
}

$id = isset($_POST["id"]) ? $_POST["id"] : '';
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
$precio = isset($_POST["precio"]) ? $_POST["precio"] : '';
$cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : '';
$update = isset($_POST["update"]) ? $_POST["update"] : '';

$index = array_search($id, array_column($_SESSION["carrito"], "id"));
if ($index !== FALSE) {
    if (isset($update) && $update === 'true') {
        $_SESSION["carrito"][$index]["cantidad"] = $cantidad;
    } else {
        $_SESSION["carrito"][$index]["cantidad"] += $cantidad;
    }
} else {
    $_SESSION["carrito"][] = array("id" => $id, "nombre" => $nombre, "precio" => $precio, "cantidad" => $cantidad);
}

echo count($_SESSION["carrito"]);

?>
