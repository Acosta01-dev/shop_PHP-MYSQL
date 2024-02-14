<?php
session_start();

require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . 'paypal_config.php';
require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . 'config.php';

$user_email = $_SESSION["user"];
$user_query = $conn->prepare("SELECT id FROM users WHERE email = ?");
$user_query->execute([$user_email]);
$user_result = $user_query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Process</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="body_sucess">
    <?php
    if (!$user_result) {
        echo '<h2>Error: User not found</h2>';
        exit;
    }
    $user_id = $user_result['id'];
    if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
        $transaction = $gateway->completePurchase(
            array(
                'payer_id' => $_GET['PayerID'],
                'transactionReference' => $_GET['paymentId'],
            )
        );
        $response = $transaction->send();

        if ($response->isSuccessful()) {
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
            echo "<h3 class='alert alert-success'>Successful payment. Your transaction ID is: " . $arr_body['id'] . "</h3>";
            echo "<br><a href='../index.php' class=' btn btn-primary'>Go Back</a>";
            unset($_SESSION["carrito"]);
        } else {
            echo '<h2>' . $response->getMessage() . '</h2>';
        }
    } else {
        echo '<h2>The transaction was rejected</h2>';
    }
    ?>
</body>

</html>