<?php
/**
 * Template Name: Page Test
 */

$public_key = get_option('liqpay_merchant_id');
$private_key = get_option('liqpay_signature_id');
$date_from = date(strtotime('-1 day'));
$date_to = time();
$liqpay = new LiqPay($public_key, $private_key);
$res = $liqpay->api("request", array(
    'action'    => 'reports',
    'version'   => '3',
    'date_from' => $date_from,
    'date_to'   => $date_to
));
var_dump($res);
