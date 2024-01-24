<?php
session_start();

require_once "../vendor/autoload.php";
require __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'paypal_config.php';

try {
    $carrito = $_SESSION["carrito"];

    if (empty($carrito)) {
        echo "El carrito está vacío";
        exit;
    }

    $items = array();
    foreach ($carrito as $producto) {
        $items[] = array(
            'name' => $producto['nombre'],
            'description' => 'TODO',
            'quantity' => $producto['cantidad'],
            'price' => number_format($producto['precio'], 2),
        );
    }

    $amount = array_sum(array_map(function ($item) {
        return $item['quantity'] * $item['price'];
    }, $items));
    

    $purchaseParams = array(
        'amount' => $amount,
        'currency' => PAYPAL_CURRENCY,
        'returnUrl' => PAYPAL_RETURN_URL,
        'cancelUrl' => PAYPAL_CANCEL_URL,
        'items' => $items,
    );

    $response = $gateway->purchase($purchaseParams)->send();

    if ($response->isRedirect()) {
        $response->redirect();
    } else {
        // No fue exitoso
        echo "Items: " . print_r($items, true) . "<br>";
        echo "Total Amount: " . $amount . "<br>";

        print_r($response->getData());
    }
} catch (Exception $e) {
    print_r($e->getMessage());
}
