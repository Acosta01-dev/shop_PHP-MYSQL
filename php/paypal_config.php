<?php
require __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . 'autoload.php';

use Omnipay\Omnipay;

define('CLIENT_ID', 'AboVLtp2Efk_JXom8jl-orkjCua-YDrq_JYhLA3jmP4OzjKdPkXlgxef4ZyP2rcRk5k_7qABxFIzweMr');
define('CLIENT_SECRET', 'ENaYxuN-p1-Igy8AqgjnhUOWzLFxXFiLrpQklsIObXNo524EgpoQdFIFASh4vxM-pzKv6z12zOJAc9_r');

define('PAYPAL_RETURN_URL', 'http://localhost/Phone-Shop-2.0/pages/success_payment.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/Phone-Shop-2.0');
define('PAYPAL_CURRENCY', 'USD');

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live
?>