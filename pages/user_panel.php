<?php
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'config.php';

session_start();

if (!isset($_SESSION["user"])) {
    header("location: ../pages/login_register_screen.php");
    exit();
} else {
    echo "Bienvenido, " . $_SESSION["user"] . "<br>";


    $user_email = $_SESSION["user"];
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$user_email]);
    $user_result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user_result) {
        echo "Error: Usuario no encontrado";
        exit();
    }
    $user_id = $user_result['id'];

    $purchase_stmt = $conn->prepare("SELECT * FROM purchase_history WHERE user_id = ?");
    $purchase_stmt->execute([$user_id]);

    // Imprimir los resultados
    echo "<h2>Historial de compras:</h2>";
    echo "<ul>";
    while ($row = $purchase_stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>Producto: " . $row['product_name'] . ", Cantidad: " . $row['quantity'] . ", Monto p.u. : " . $row['amount'] . "</li>";
    }
    echo "</ul>";

    echo "
    <form action=\"../php/logout.php\" method=\"post\">
        <button type=\"submit\">Cerrar Sesión</button>
    </form>
";

}
?>