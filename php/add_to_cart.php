<?php
session_start();

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = array();
}

$id = $_POST["id"]; 
$nombre = $_POST["nombre"];
$precio = $_POST["precio"];

$index = array_search($id, array_column($_SESSION["carrito"], "id"));
if ($index !== FALSE) {
    $_SESSION["carrito"][$index]["cantidad"]++;
} else {
    $_SESSION["carrito"][] = array("id" => $id, "nombre" => $nombre, "precio" => $precio, "cantidad" => 1);
}

echo count($_SESSION["carrito"]);

?>
