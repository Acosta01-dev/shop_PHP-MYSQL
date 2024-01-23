<?php
session_start();
require __DIR__ . DIRECTORY_SEPARATOR . "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login_email = $_POST["login_email"];
    $login_password = $_POST["login_password"];

    $conn = new PDO("mysql:host=$host;dbname=$base_datos", $usuario, $contrasena);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $checkUserQuery = "SELECT * FROM users WHERE email = :email";
    $checkStmt = $conn->prepare($checkUserQuery);
    $checkStmt->bindParam(':email', $login_email);
    $checkStmt->execute();
    $user = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($login_password, $user['password'])) {
        $_SESSION["user"] = $login_email;
        header("Location: ../pages/user_panel.php");
        exit(); 
    } else {
        echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
    }
}
?>
