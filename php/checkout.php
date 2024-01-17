<?php
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$stripe_secret_key = "sk_test_51OLLqkEDw2ngiJsDKTsZODIzgu79yQpav5LEQnrdOfKNCOirchOVoABx2NSU2NYhCtTSLaDIxsfpTVbcOmCqrpG10054iT6UcX";
\Stripe\Stripe::setApiKey($stripe_secret_key);

try {
    session_start();
    $carrito = $_SESSION["carrito"];

    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => array_map(function($producto) {
            return [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $producto["nombre"],
                        //'description' => $producto["descripcion"], 
                    ],
                    'unit_amount' => $producto["precio"] * 100, 
                ],
                'quantity' => $producto["cantidad"],
            ];
        }, $carrito),
        'mode' => 'payment',
        'success_url' => 'https://www.example.com/success',
        'cancel_url' => 'https://www.example.com/cancel',
    ]);

    header("Location:" . $checkout_session->url);
} catch (\Stripe\Exception\ApiErrorException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
