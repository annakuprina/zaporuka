<?php
/**
 * Template Name: Page Test
 */

$public_key = get_option('liqpay_merchant_id');
$private_key = get_option('liqpay_signature_id');
$date_from = date(strtotime('-1 day') )* 1000;
$date_to = time() * 1000;
//$liqpay = new MyLiqPay($public_key, $private_key);
//$res = $liqpay->api("request", array(
//    'action'    => 'reports',
//    'version'   => '3',
//    'date_from' => '1583854660000',
//    'date_to'   => '1583941072000'
//));
//var_dump($res);
$g = get_option('cancel_subscription');
var_dump($g->result);
