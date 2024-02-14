<?php
require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php';

use Omnipay\Omnipay;

define('CLIENT_ID', 'your client id');
define('CLIENT_SECRET', 'secret key');

define('PAYPAL_RETURN_URL', 'http://localhost/Phone-Shop-2.0/pages/success_payment.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/Phone-Shop-2.0');
define('PAYPAL_CURRENCY', 'USD');

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live
?>