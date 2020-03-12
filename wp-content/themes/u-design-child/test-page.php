<?php
/**
 * Template Name: Page Test
 */

$public_key = get_option('liqpay_merchant_id');
$private_key = get_option('liqpay_signature_id');
$date_from = date(strtotime('-1 day') )* 1000;
$date_to = time() * 1000;
$liqpay = new MyLiqPay($public_key, $private_key);
$res = $liqpay->api("request", array(
    'action'    => 'reports',
    'version'   => '3',
    'date_from' => $date_from,
    'date_to'   => $date_to
));


if ( !empty($res) ) {
    global $wpdb, $table_prefix;
    $table_liqpay = $table_prefix . 'liqpay';
    $table_liqpay_history = $table_prefix . 'project_history';
    if (!isset($wpdb))
        require_once('../../../wp-config.php');
    for ($i=0; $i<count($res->data); ++$i) {
        $sql = "Select * from {$table_liqpay} where transaction_id = {$res->data[$i]->transaction_id}";
        $sql_res = $wpdb->get_results($sql);

        if( empty($sql_res) ) {

//            $order_id = $res->data[$i]->order_id;
//            $project_id = $res->data[$i]->info;
//            $transaction_id = $res->data[$i]->transaction_id;
//            $date = date('Y-m-d H:i:s', ($res->data[$i]->create_date/1000));
//            $users_name = $res->data[$i]->sender_first_name;
//            $users_email = $res->data[$i]->;
//            $users_phone = ;
//            $type_operation = $res->data[$i]->;
//
//            $status = $res->data[$i]->;
//            $code = $res->data[$i]->;
//            $summa = $res->data[$i]->amount;
//            $valuta = $res->data[$i]->currency;
//            $ip = $res->data[$i]->ip;
//            $datas = $res->data[$i]->description;
//            $sql = "insert into {$table_liqpay} (`order_id`,`xdate`,`transaction_id`,`status`,`err_code`,`summa`,`valuta`,`sender_phone`,`comments`,`email`,`ip`)
//             values ('" . $order_id . "','" . $date . "'," . $transaction_id . ",'" . $status . "','" . $code . "','" . $summa . "','" . $valuta . "','" . $users_phone . "','" . $datas . "','" . $users_email . "','" . $ip . "')
//             on duplicate key update order_id=VALUES(order_id),xdate=VALUES(xdate),transaction_id=VALUES(transaction_id),status=VALUES(status),err_code=VALUES(err_code),summa=VALUES(summa),valuta=VALUES(valuta),sender_phone=VALUES(sender_phone),comments=VALUES(comments),email=VALUES(email),ip=VALUES(ip);";
//            $wpdb->query($sql);
//            $sql1 = "insert into {$table_liqpay_history} (`project_id`,`transaction_id`,`order_date`,`users_name`,`users_phone`,`users_email`,`summa`,`type_operation`) values ('" . $project_id . "','" . $transaction_id . "','" . $date . "','" . $users_name . "','" . $users_phone . "','" . $users_email . "','" . $summa . "','" . $type_operation . "')
//         on duplicate key update project_id=VALUES(project_id),transaction_id=VALUES(transaction_id),order_date=VALUES(order_date),users_name=VALUES(users_name),users_phone=VALUES(users_phone),users_email=VALUES(users_email),summa=VALUES(summa),type_operation=VALUES(type_operation);";
//            $wpdb->query($sql1);

        }
        var_dump($res->data[$i]);
    }
}
//$g = get_option('cancel_subscription');
//var_dump($g->result);
