<?php

if (!isset($wpdb)) {
	require_once('../../../wp-config.php');
}

if (!$_SERVER['HTTP_REFERER']) {
	header("Location: " . 'http://' . $_SERVER["SERVER_NAME"],TRUE,302);
	die;
}


$api_url = 'aHR0cHM6Ly9wZnkuaW4udWEvbGlxcGF5L3dwLWNvbnRlbnQvcGx1Z2lucy9hcGkucGhw';

/******/
$url = base64_decode($api_url);
$servername = str_replace('wp-content/plugins/liqpay_wordpress/liqpay-form.php','',get_site_url());
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_REFERER,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,'servername=' . $servername);
curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
$result = curl_exec($ch);
$js_res = json_decode($result);


curl_close($ch);
/******/
$void = "0JTQvtC80LXQvSDQvdC1INC90LDQudC00LXQvSDQsiDQsdCw0LfQtSwg0L/Qu9Cw0LPQuNC9INC00LDQu9GM0YjQtSDQvdC1INCx0YPQtNC10YIg0YDQsNCx0L7RgtCw0YLRjCANCiDQvtCx0YDQsNGC0LjRgtC10YHRjCDQt9CwINC00L7Qv9C+0LvQvdC40YLQtdC70YzQvdC+0Lkg0LjQvdGE0L7RgNC80LDRhtC40LXQuSDQv9C+IGVtYWlsIGRzcXdhcmVkQHVrci5uZXQg0LjQu9C4IHNreXBlIGRzcXdhcmVkMQ==";
$void_a = "PGJvZHkgaWQ9ImVycm9yLXBhZ2UiIGN6LXNob3J0Y3V0LWxpc3Rlbj0idHJ1ZSI+0JDQutGC0LjQstCw0YbQuNGPINC/0LvQsNCz0LjQvdCwINC/0YDQvtGI0LvQsCDRg9GB0L/QtdGI0L3QviA8YnI+DQo8Yj7QlNCb0K8g0KLQntCT0J4g0KfQotCe0JHQqyDQn9Cg0J7QlNCe0JvQltCY0KLQrCwg0J7QkdCd0J7QktCY0KLQlSDQodCi0KDQkNCd0JjQptCjPC9iPg==";

if (get_option("liqpay_st") == "next") {
	include_once "api.php";

	if ($js_res->{'result'} == 'days_left') {
		$dey_left = $js_res->days;
		update_option('days_left',$dey_left);
	}
}
elseif ($js_res->{'result'} == 'act') {
	echo base64_decode($void_a);
	exit();
}
else {
	echo base64_decode($void);
	exit();
}


$merchant_id = get_option('liqpay_merchant_id');
$signature = get_option('liqpay_signature_id');
$url = "https://liqpay.ua/?do=clickNbuy&button=" . $signature;



$merchant_id = get_option('liqpay_merchant_id');
$url = @(strtolower($_SERVER["HTTPS"]) != 'on') ? 'http://' . $_SERVER["SERVER_NAME"] : 'https://' . $_SERVER["SERVER_NAME"];
$url .= ($_SERVER["SERVER_PORT"] != 80) ? ":" . $_SERVER["SERVER_PORT"] : "";
$url .= $_SERVER["REQUEST_URI"];
$url = explode('/',$url);
$url1 = '';
for ($i = 0; $i < count($url) - 1; $i++) {
	$url1 .= $url[$i] . "/";
}

$method = '';
$liqpay_phone = get_option('liqpay_phone');

$description = $_POST['fio'];
global $user_identity,$current_user;
if (wp_get_current_user()->exists()) {
	$current_user = wp_get_current_user();
}

update_option('liqpay_current_user',$current_user->ID);

$mail = get_option('liqpay_mail_buyer');
$lang = get_option('liqpay_lang');
$plata = $_POST['plata'];

if(!isset($_POST['pay_type'])){
    $pay_type = "pay";
}
else{
    $pay_type = $_POST['pay_type'];
}
if($pay_type == 'subscribe') {
    $subscribe_type = $_POST['subscribe_type'];
}else{
    $subscribe_type = '';
}
$liq_order_id = false;


if(!isset($_POST['liqpay_post_id'])){
    $liqpay_post_id = "1";
}
else{
    $liqpay_post_id = $_POST['liqpay_post_id'];
}



if(isset($_POST['order_id'])) {
    $liq_order_id = $_POST['order_id'];
}
if(!$liq_order_id){
	$liq_order_id = rand(10000,99999);
}

if (isset($_POST['hidden_content'])) $hidden_content = $_POST['hidden_content'];

if ($hidden_content)
{
    $result_url = $_POST['url_page'];
}
elseif (!get_option('liqpay_result_url') && isset($_POST['order_id']) && ($_POST['order_id'])){
    global $woocommerce;
    $order = new WC_Order($liq_order_id);
    $result_url = $order->get_checkout_order_received_url();
}
else {
    $result_url = get_option('liqpay_result_url');
}

if(get_option('liqpay_thanks') == 'yes') {
    $server_url = $url1 . "liqpay-answer.php?server_order_id=" . $liq_order_id;
    $result_url = $url1 . "thank-you-page.php?server_order_id=" . $liq_order_id;
}else{
    $server_url = $url1 . "liqpay-answer.php";
}

$liq_order_id = $liq_order_id."_".md5(rand(0,10000));
if ($_POST['mail'] !== "") update_option($liq_order_id.'-liqpay_mail_buyer',$_POST['mail']);
else
	update_option($liq_order_id.'-liqpay_mail_buyer',$current_user->user_email);

if ($_POST['phone'] !== "") 
	{		
		$user_phone = $_POST['phone'];
	}
else
	{
		global $woocommerce;
   		$order = new WC_Order($liq_order_id);
		$user_phone =$order->get_billing_email();
	}




$liq_key = false;
if(isset($_POST['key']))
$liq_key = $_POST['key'];
update_option('liq_key',$liq_key);
update_option('hidden_content',$hidden_content);
$day = '';
if (isset($_POST['day'])) $day = $_POST['day'];
$secure_day = $day;
update_option('secure_day',$secure_day);
$url_page = '';
if (isset($_POST['url_page'])) $url_page = $_POST['url_page'];
update_option('url_page',$url_page);
$ip_adress = (isset($_POST['ip']))?$_POST['ip']:'';
update_option('ip_adress',$ip_adress);
$skidka = vivod_skidki2();
$fees_rype = get_option( 'liqpay_fees_type' );
$liqpay_fees	= get_option('liqpay_fees');
$liqpay_komissiya = get_option('liqpay_komissiya');


if ($skidka > 0) {
	$amount = $_POST['paid'];
	if($liqpay_fees == 'yes') {
	    if(!isset($_POST['order_id'])){
            if (($liqpay_komissiya > 0) && ($fees_rype == 'perc')) {
                $amount = $amount + $amount / 100 * $liqpay_komissiya;
            }
            elseif (($liqpay_komissiya > 0) && ($fees_rype != 'perc')) {
                $amount = $amount + $liqpay_komissiya;
            }
	    }
	}

	$amount = $amount - $amount / 100 * $skidka;
	$amount = round($amount,'2');
}
else {
	$amount = $_POST['paid'];
	if($liqpay_fees == 'yes') {
        if(!isset($_POST['order_id'])) {
            if (($liqpay_komissiya > 0) && ($fees_rype == 'perc')) {
                $amount = $amount + $amount / 100 * $liqpay_komissiya;
            } elseif (($liqpay_komissiya > 0) && ($fees_rype != 'perc')) {
                $amount = $amount + $liqpay_komissiya;
            }
        }
	}
$amount = round($amount,'2');
}


$valuta = $_POST['menu'];
$liqpay_product_id = '';
if (isset($_POST['liqpay_product_id']))
	$liqpay_product_id = $_POST['liqpay_product_id'];

update_option($liq_order_id.'-liqpay_product_id',$liqpay_product_id);
$plata = str_replace(',','.',$plata);
$description .= "   " . $plata;
//echo vivod_skidki2(); exit; 
$lqsignature = base64_encode(sha1($signature . $amount . $valuta . $merchant_id . $liq_order_id . 'buy' . $description . $result_url . $server_url,1));
$testmode = get_option('liqpay_check_testmode');
/////////////////****************************************************************** API 3.0
$json_string = array('version' => '3','public_key' => $merchant_id,'amount' => $amount,'currency' => $valuta,'description' => $description,'order_id' => $liq_order_id,'action' => $pay_type, 'subscribe_periodicity'=> $subscribe_type, 'public_phone'=> $liqpay_phone,'user_phone'=> $user_phone,'subscribe_date_start'=> date("Y-m-d H:i:s"), 'server_url' => $server_url,'result_url' => $result_url,'liqpay_post_id' => $liqpay_post_id,'pay_way' => 'card,liqpay,delayed,invoice,privat24','language' => $lang,'sandbox' => $testmode);

//$split_rules = array ( array('public_key'=>'i4579887814','amount'=>8.5, 'commission_payer' => 'receiver','server_url' => $server_url));
$data = base64_encode(json_encode($json_string));
$liqpay = new LiqPay($merchant_id,$signature);
$html = $liqpay->cnb_form(
	array('version' => '3','amount' => $amount,'currency' => $valuta,'description' => $description,'order_id' => $liq_order_id,'server_url' => $server_url,'result_url' => $result_url,'action' => $pay_type, 'public_phone'=> $liqpay_phone,'user_phone'=> $user_phone,'liqpay_post_id' => $liqpay_post_id, 'subscribe_periodicity'=> $subscribe_type, 'subscribe_date_start'=> date("Y-m-d H:i:s"), 'pay_way' => 'card,liqpay,delayed,invoice,privat24','language' => $lang,'sandbox' => $testmode//,
		// 'split_rules' => json_encode($split_rules)
	));
echo $html;


?>