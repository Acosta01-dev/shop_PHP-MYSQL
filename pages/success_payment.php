<?php 
session_start();


require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . 'paypal_config.php';
require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . 'config.php';

// Obtener user_id basado en el email almacenado en la sesión
$user_email = $_SESSION["user"];
$user_query = $conn->prepare("SELECT id FROM users WHERE email = ?");
$user_query->execute([$user_email]);
$user_result = $user_query->fetch(PDO::FETCH_ASSOC);

if (!$user_result) {
    echo 'Error: Usuario no encontrado';
    exit;
}

$user_id = $user_result['id'];

if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $response = $transaction->send();
 
    if ($response->isSuccessful()) {
        // El cliente ha pagado con éxito.
        $arr_body = $response->getData();
        $payment_status = $arr_body['state'];

        foreach ($_SESSION["carrito"] as $producto) {
            $product_name = $producto['nombre'];
            $quantity = $producto['cantidad'];
            $amount = $producto['precio'];
            
            $sql = "INSERT INTO purchase_history (user_id, product_name, quantity, amount, purchase_date, payment_status) VALUES (?, ?, ?, ?, NOW(), ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$user_id, $product_name, $quantity, $amount, $payment_status]);
        }

        echo "Pago exitoso. Tu ID de transacción es: " . $arr_body['id'];
        unset($_SESSION["carrito"]);
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'La transacción fue rechazada';
}
?>