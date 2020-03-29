<?php
if (!isset($wpdb))
    require_once('../../../wp-config.php');


if (isset($_REQUEST["st"]) && $_REQUEST["st"]) {
    $st = $_REQUEST["st"];
    if ($st == "next") {
        update_option('liqpay_st', 'next');
        echo get_option('liqpay_st');
        return "true";
    } elseif (($st == "show")) {
        echo get_option('liqpay_st');
        return "show";
    } else {
        update_option('liqpay_st', 'err');
        echo get_option('liqpay_st');
        return "false";
    }
}


function insertdb($order_id1, $xdate, $transaction_id1, $status1, $summa1, $datas1, $sender_phone1, $code1, $valuta1, $email1, $ip1)
{
    global $wpdb, $table_prefix;
    $table_liqpay = $table_prefix . 'liqpay';
    if (!isset($wpdb))
        require_once('../../../wp-config.php');
    $sql1 = "Select status from {$table_liqpay} where order_id = '{$order_id1}' and status = 'success'";
    $res = $wpdb->get_row($sql1);
    if (is_null($res)) {
        $sql1 = "insert into {$table_liqpay} (`order_id`,`xdate`,`transaction_id`,`status`,`err_code`,`summa`,`valuta`,`sender_phone`,`comments`,`email`,`ip`) 
             values ('" . $order_id1 . "','" . $xdate . "'," . $transaction_id1 . ",'" . $status1 . "','" . $code1 . "','" . $summa1 . "','" . $valuta1 . "','" . $sender_phone1 . "','" . $datas1 . "','" . $email1 . "','" . $ip1 . "') 
             on duplicate key update order_id=VALUES(order_id),xdate=VALUES(xdate),transaction_id=VALUES(transaction_id),status=VALUES(status),err_code=VALUES(err_code),summa=VALUES(summa),valuta=VALUES(valuta),sender_phone=VALUES(sender_phone),comments=VALUES(comments),email=VALUES(email),ip=VALUES(ip);";
        $wpdb->query($sql1);
    }else{
        die;
    }

}

function insert_history($project_id2, $transaction_id2, $date2, $users_name2, $users_phone2, $users_email2, $summa2, $type_operation2)
{
    global $wpdb, $table_prefix;
    $table_liqpay_project_history = $table_prefix . 'liqpay_project_history';
    if (!isset($wpdb))
        require_once('../../../wp-config.php'); 

    $sql1 = "insert into {$table_liqpay_project_history} (`project_id`,`transaction_id`,`order_date`,`users_name`,`users_phone`,`users_email`,`summa`,`type_operation`) values ('" . $project_id2 . "','" . $transaction_id2 . "','" . $date2 . "','" . $users_name2 . "','" . $users_phone2 . "','" . $users_email2 . "','" . $summa2 . "','" . $type_operation2 . "')
         on duplicate key update project_id=VALUES(project_id),transaction_id=VALUES(transaction_id),order_date=VALUES(order_date),users_name=VALUES(users_name),users_phone=VALUES(users_phone),users_email=VALUES(users_email),summa=VALUES(summa),type_operation=VALUES(type_operation);";
    $wpdb->query($sql1);

}


update_option('payment_answer_from_liqpay', $_POST['data']);
if (isset($_POST['data'])) {
    $json = base64_decode($_POST['data']);
    $obj = json_decode($json);
    $message = $obj->{'amount'};
    $summa = $obj->{'amount'};
    $valuta = $obj->{'currency'};
    $public_key = $obj->{'public_key'};
    $datas = $obj->{'description'};
    $info = $obj->{'info'};
    $order_id = $obj->{'order_id'};
    $order_id_md5 = $obj->{'order_id'};
    $order_id = explode("_", $order_id);
    $order_id = $order_id[0];
    $type = $obj->{'type'};
    $status = $obj->{'status'};
    $transaction_id = $obj->{'transaction_id'};
    $sender_phone = $obj->{'sender_phone'};
    $ip_adress = $obj->{'ip'};
    $xdate = date("Y.m.d H:i:s");
    $sender_first_name = $obj->{'sender_first_name'};

    update_option($order_id.'-liqpay_answer_status',$status);
    update_option($order_id.'-liqpay_answer_transaction_id',$transaction_id);
    update_option($order_id.'-liqpay_answer_summa',$summa);

    global $wpdb, $table_prefix;

    $table_answer_code = $table_prefix . 'liqpay_answer_code';
    $testmode = get_option('liqpay_check_testmode');
    $commission = get_option('liqpay_komissiya');
    $commission_type = get_option('liqpay_fees_type');
    $hidden_content = get_option('hidden_content');
    $secure_day = get_option('secure_day');
    $url_page = get_option('url_page');

    global $user_identity, $current_user;

    if (wp_get_current_user()->exists()) {
        $current_user = wp_get_current_user();
    }
    $to = get_option($order_id_md5 . '-liqpay_mail_buyer');

    $user_phone = get_option($order_id_md5 . '-user_phoner');
    if($user_phone){
        $user_phone = $user_phone;
    }
    else{
        global $woocommerce;
        $order = new WC_Order($order_id);
        $user_phone = $order->get_billing_phone();
    }

    $liqpay_post_id =  get_option($order_id . '-liqpay_post_id');

    if (!$to)
        $to = $current_user->user_email;

    if (($current_user->user_firstname) || ($current_user->user_lastname) || ($current_user->user_login)){
        $fio = $current_user->user_firstname . " " . $current_user->user_lastname . " " . $current_user->user_login;
    }
    else{
        $fio = $sender_first_name;
    }

    $user_phone_fio = $user_phone . ' ' . $fio;
    $new_code = 1;


    $subject = pll__("Звіт по оплаті ");
    $liqpay_magazin_tmp = get_option('liqpay_magazin');
    $liqpay_mail_sender_tmp = " <" . get_option('liqpay_mail_sender') . ">";
    $headers = "From: " . $liqpay_magazin_tmp . $liqpay_mail_sender_tmp . "\r\n";

    if (isset($_GET['server_order_id'])) {
        $server_order_id = $_GET['server_order_id'];
        $url = @(strtolower($_SERVER["HTTPS"]) != 'on') ? 'http://' . $_SERVER["SERVER_NAME"] : 'https://' . $_SERVER["SERVER_NAME"];
        $url .= ($_SERVER["SERVER_PORT"] != 80) ? ":" . $_SERVER["SERVER_PORT"] : "";
        $url .= $_SERVER["REQUEST_URI"];
        $url = explode('/', $url);
        $url1 = '';
        for ($i = 0; $i < count($url) - 1; $i++) {
            $url1 .= $url[$i] . "/";
        }

        $thank_you_page_url = $url1 . "thank-you-page.php";

        $post = array("action" => "thank_you_page_state", "order_id" => $server_order_id, "status" => $status);
        curlSendRequest($thank_you_page_url, $post);
    }
////////////////////////////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    if ($status == "failure") {

        $status = pll__("платіж відхилено");
        $text = pll__("Вибачте але Ваш платіж відхилено") . "...\n";
        $text .= pll__("Дата/час") . ": " . $xdate . "\n ";
        $text .= pll__("Номер заказу") . ": " . $order_id . "\n ";
        $text .= pll__("Номер транзакції в системі LiqPay") . ": " . $transaction_id . "\n ";
        $text .= pll__("Статус транзакції") . ": " . $status . "\n ";
        $text .= pll__("Вартiсть") . ": " . $summa . " " . $valuta . "\n ";
        if ($fio){
            $text .= pll__("Им'я") . ": " . $fio . "\n ";
        }
        $text .= pll__("Телефон") . ": " . $user_phone . "\n ";
        $text .= pll__("Коментар") . ": " . $datas . "\n ";
        $mail = get_option('liqpay_mail');
        $order = '';
        if ($new_code) {
            if ($order_id) {
                if (class_exists('WooCommerce')) {
                    global $woocommerce;
                    $order = new WC_Order($order_id);
                    $order->add_order_note('Liqpay payment Failed');
                    $order->update_status('failed');
                }
            }
            if (!$order) {
                wp_mail($to, $subject . "(" . $status . ")", $message, $headers, '');
                wp_mail($mail, $subject . "(" . $status . ")", $message, $headers, '');
            }
        }
        exit;
    } elseif ($status == "success" || $status == "sandbox" || $status == "subscribed") {
        $flag = 1;
        if ($hidden_content == '1')
            $status = pll__("платіж здійснено");
        $text .= pll__("Дата/час") . ": " . $xdate . "\n ";
        $text .= pll__("Номер заказу") .  ": " . $order_id . "\n ";
        $text .= pll__("Номер транзакції в системі LiqPay") .  ": " . $transaction_id . "\n ";
        $text .= pll__("Статус транзакції") .  ": " . $status . "\n ";
        $text .= pll__("Вартiсть") . ": " . $summa . " " . $valuta . "\n ";
        if ($fio){
            $text .= pll__("Им'я") .  ": " . $fio . "\n ";
        }
        $text .= pll__("Телефон") .  ": " . $user_phone . "\n ";
        $text .= pll__("Коментар") .  ": " . $datas . "\n ";
        if ($hidden_content == '1') {
            $user_pass = (!empty($user_pass)) ? $user_pass : '';
            $user_url = (!empty($user_url)) ? $user_url : '';
            $text .= "\n -------Данные для входа------- ";
            /*$text .=  "\n Логин: " . $user_login;*/
            $text .= "\n Пароль:  " . $user_pass;
            $text .= "\n Аренда контента на :  " . $secure_day . get_name($secure_day, ' День', ' Дня', ' Дней') . " (Время аренды начинает действовать после первого ввода пароля!)";
            $text .= "\n Ссылка на страницу:  " . $user_url . "\n";
        }

        $mail = get_option('liqpay_mail');

        if( $liqpay_post_id != 1){
            $current_value = get_field( "total-collected", $liqpay_post_id );
            $total_amount = get_field('total-amount', $liqpay_post_id);
            if ( $current_value >= $total_amount ) {
                global $wpdb;
                $all_posts = $wpdb->get_var( 'SELECT description FROM ' . $wpdb->term_taxonomy . ' WHERE taxonomy = "post_translations" AND description LIKE "%i:' . $liqpay_post_id . ';%"' );
                $all_ids = unserialize($all_posts);
                $category = get_category_by_slug( 'zaversheni' );
                wp_set_post_categories($all_ids['uk'], array( $category->term_id ));
                $liqpay_post_id = 823;
                $current_value = get_field( "total-collected", $liqpay_post_id );
                if( $status == "subscribed" ) {
                    $datas = 'Щомісячне перерахування коштів в БФ Запорука';
                } else{
                    $datas = 'Одноразове пожертвування в БФ Запорука';
                }
            }
            $new_value = $current_value + $summa;
            update_field('total-collected', $new_value , $liqpay_post_id);
            insert_history($liqpay_post_id, $transaction_id, $xdate, $sender_first_name, $user_phone, $to, $summa, 'зачислено');
        }
        insertdb($order_id, $xdate, $transaction_id, $status, $summa, $datas, $user_phone_fio, 0, $valuta, $to, $ip_adress);
/////////////////////////////////////////////////////////////////////////////
        global $code, $product_id;
        $code = liqpay_random_string(10);
        $ctime = time();
        $product_id = get_option($order_id_md5 . '-liqpay_product_id');
        global $wpdb, $table_prefix;
        $table_downloadcode = $table_prefix . 'liqpay_downloadcodes';
        require_once('../../../wp-config.php');
        $wpdb->insert($table_downloadcode,
            array('downloadcode' => $code, 'product_id' => $product_id, 'ctime' => $ctime),
            array('%s', '%d', '%d')
        );
        $status_url = get_option('liqpay_status_url');
        preg_match('/^http(s)?\:\/\/[^\/]+\/(.*)$/i', $status_url, $matches);
        $liqpay_download_url = $_SERVER['HTTP_HOST'] . "/" . $matches[2];
        $table_products = $table_prefix . 'liqpay_products';
        $product = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_products WHERE id = %d", $product_id));
        $url = $product->url;
        $table_skidki = $table_prefix . "liqpay_skidki";
        $liqpay_current_user = get_option('liqpay_current_user');
        $users = $wpdb->get_row($wpdb->prepare("SELECT id, users_name, users_id, users_skidka from $table_skidki where users_id = %d", $liqpay_current_user));
        if ($product->name) {
            $skidka = $users->users_skidka;
            if ($skidka > 0) {
                $cost_cult = $product->cost - $product->cost / 100 * $skidka;
                if ($commission > 0) {
                    if ($commission_type == 'perc') {
                        $cost_cult = $cost_cult + $cost_cult / 100 * $commission;
                        $cost_cult = round($cost_cult, '2');
                    } else {
                        $cost_cult = $cost_cult + $commission;
                    }
                }
            } else {
                $cost_cult = $product->cost;
                if ($commission > 0) {
                    if ($commission_type == 'perc') {
                        $cost_cult = $cost_cult + $cost_cult / 100 * $commission;
                        $cost_cult = round($cost_cult, '2');
                    } else {
                        $cost_cult = $cost_cult + $commission;
                    }
                }
            }
            if (($hidden_content) && ($secure_day)) {
                $cost_cult = $cost_cult * $secure_day;
                $cost_cult = trim(number_format($cost_cult, 2, '.', ' '), '0.');
                if (substr($cost_cult, -1) == ",")
                    $cost_cult = substr($cost_cult, 0, -1);
            }
            $code_cult = $product->id;
            $valuta_cult = $product->valuta;

            //$summa = trim(number_format($summa, 2, '.', ' '), '0.');
            $summa = number_format($summa, 2, '.', ' ');
            $cost_cult = number_format($cost_cult, 2, '.', ' ');
            /*if (substr($summa, -1) == ",")
                $summa = substr($summa, 0, -1);*/
            if (($cost_cult != $summa) || ($valuta_cult != $valuta)) {
                $flag = 0;
            } //TODO изменить проверку с учетом разных валют

        }
/////////////////////////////////////////////////////////////////////////////
        if ($new_code) {
            $findme = "wp-content";
            $pos = strpos($url, $findme);
            $url_end = substr($url, $pos + 11);
            $url_beg = WP_CONTENT_DIR;
            $pos = strpos($url_beg, $findme);
            $url_beg = substr($url_beg, 0, $pos + 11);
            $file_url = $url_beg . '/' . $url_end;
            $order = '';
            if ($flag == 1) {
                if ($order_id) {
                    if (class_exists('WooCommerce')) {
                        global $woocommerce;
                        $order = wc_get_order($order_id);
                        if ($order) {
                            $order->payment_complete();
                            $order->update_status('completed');
                            $woocommerce->cart->empty_cart();
                        }
                    }
                }

                if ($file_url) {
                    $attachments = array($file_url);
                }
                $text_head = pll__("Вітаємо! Ваш платіж пройшов успішно") . "...\n";

                $message = $text_head . $message;
                $attachments = '';

                if ($url) {
                    $res = send($url);
                    if ($res->id) {
                        $message .= "\n\rСсылка на скачивание:  " . $res->id . "\n\r";
                    } else {
                        $message .= "\n\rСсылка на скачивание:  " . $url . "\n\r";
                    }
                }
            } else {//
                $attachments = '';
                $text_head = pll__("Вітаємо! Ваш платіж пройшов успішно") . "...\n";
                $text_head .= $cost_cult . $valuta_cult . " Вы оплатили. " . $summa . $valuta . ", сумма не соответствует стоимости товара, за разъяснением вопроса, обратитесь к администратору " . get_option('liqpay_mail');
                $message = $text_head . $message;
            }
            if (!$order) {
                $attachments = (!empty($attachments)) ? $attachments : '';
                wp_mail($to, $subject . "(" . $status . ")", $message, $headers, $attachments);
                wp_mail($mail, $subject . "(" . $status . ")", $message . "   Email покупателя - " . $to, $headers, $attachments);
            }
        }

        exit;
    } elseif (($status == "wait_secure") || ($status == "wait_accept")) {
        $status = pll__("платіж знаходиться на перевірці");
        $text = pll__("Ваш платіж очікує на перевірку") . "...\n";
        $text .= pll__("Дата/час") . ": " . $xdate . "\n ";
        $text .= pll__("Номер заказу") . ": " . $order_id . "\n ";
        $text .= pll__("Номер транзакції в системі LiqPay") . ": " . $transaction_id . "\n ";
        $text .= pll__("Статус транзакції") . ": " . $status . "\n ";
        $text .= pll__("Вартiсть") . ": " . $summa . " " . $valuta . "\n ";
        if ($fio){
            $text .= pll__("Им'я") . ": " . $fio . "\n ";
        }
        $text .= pll__("Телефон") . ": " . $user_phone . "\n ";
        $text .= pll__("Коментар") . ": " . $datas . "\n ";
        $text .= pll__("Если долгое время платеж не проходит, Вам следует обратится в онлайн чат службы поддержки Liqpay, по адресу") . " <a href='https://liqpay.ua/' title='Liqpay'>Liqpay</a> \n";
        $mail = get_option('liqpay_mail');
        $order = '';
        if ($new_code) {
            if ($order_id) {
                if (class_exists('WooCommerce')) {
                    global $woocommerce;
                    $order = new WC_Order($order_id);
                    $order->add_order_note('Liqpay payment processing.');
                    $order->update_status('processing');
                    $woocommerce->cart->empty_cart();
                }
            }
            if (!$order) {
                $attachments = (!empty($attachments)) ? $attachments : '';
                wp_mail($to, $subject . "(" . $status . ")", $message, $headers, $attachments);
                wp_mail($mail, $subject . "(" . $status . ")", $message, $headers, $attachments);
            }
        }
        exit;
    }
}

function send($long_url = FALSE, $short_url = FALSE)
{
    $AUTH_KEY = "AIzaSyCZg4CwiBg_OEQD61V6-LVhymQdx9N7mSQ";
    $API_URL = "https://www.googleapis.com/urlshortener/v1/url";

    $ku = curl_init();

    curl_setopt($ku, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ku, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ku, CURLOPT_RETURNTRANSFER, TRUE);

    if ($long_url) {
        curl_setopt($ku, CURLOPT_POST, TRUE);
        curl_setopt($ku, CURLOPT_POSTFIELDS, json_encode(array("longUrl" => $long_url)));
        curl_setopt($ku, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        curl_setopt($ku, CURLOPT_URL, $API_URL . "?key=" . $AUTH_KEY);
    } elseif ($short_url) {
        curl_setopt($ku, CURLOPT_URL, $API_URL . "?key=" . $AUTH_KEY . "&shortUrl=" . $short_url . "&projection=ANALYTICS_CLICKS");
    }


    $result = curl_exec($ku);
    curl_close($ku);
    return json_decode($result);
}


function curlSendRequest($strUrl, $post = array())
{
    $curl = curl_init();
    $post = http_build_query($post);
    echo print_r("<br>" . $post . "<br>");
    curl_setopt_array($curl, array(
        CURLOPT_URL => $strUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }

    return array("res" => $response, "err" => $err);
}
