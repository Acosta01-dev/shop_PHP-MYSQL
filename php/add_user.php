<?php
session_start();

require __DIR__ . DIRECTORY_SEPARATOR . "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $register_email = $_POST["register_email"];
    $register_password = $_POST["register_password"];

    $hashed_password = password_hash($register_password, PASSWORD_DEFAULT);

    $checkEmailQuery = "SELECT COUNT(*) as count FROM users WHERE email = :email";
    $checkStmt = $conn->prepare($checkEmailQuery);
    $checkStmt->bindParam(':email', $register_email);
    $checkStmt->execute();
    $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo "El email ya está registrado. Por favor, elige otro.";
    } else {
        $insertQuery = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(':email', $register_email);
        $insertStmt->bindParam(':password', $hashed_password);
        $insertStmt->execute();

        $_SESSION["user"] = $register_email;

        header("Location: ../pages/user_panel.php");
        exit();
    }
}
?>
