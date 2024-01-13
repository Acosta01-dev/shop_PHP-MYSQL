<?php
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'shop';
try {
    $conn = new PDO("mysql:host=$host;dbname=$base_datos", $usuario, $contrasena);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>