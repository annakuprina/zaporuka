<?php
/*
    Plugin Name: Liqpay&Wordpress
    Plugin URI: http://pfy.in.ua/liqpay/
    Description: Платежная система Liqpay for Wordpress
    Author: M.I. Simkin
    Version: 2.4
    Author URI: http://pfy.in.ua/liqpay/
*/
/*  Copyright 2013 Simkin Maksim  (email : dsqwared {at} ukr.net)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!function_exists('liqpay_load_resources')) {
    function liqpay_load_resources()
    {
        wp_register_script('cookie_script', plugins_url('/js/jquery.cookie.js', __FILE__), array('jquery'));
        wp_enqueue_script('cookie_script');

        wp_register_script('liqpay_form_script', plugins_url('/js/liqpay_form.js', __FILE__), array('jquery'));
        wp_enqueue_script('liqpay_form_script');

        wp_register_script('dataTables', '//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js', array('jquery'));
        wp_enqueue_script('dataTables');
        wp_register_script('dataTables_yadcf', plugins_url('/js/jquery.dataTables.yadcf.js', __FILE__), array('jquery', 'dataTables'));
        wp_enqueue_script('dataTables_yadcf');
        wp_register_script('fixedColumns', '//cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js', array('jquery', 'dataTables'));
        wp_enqueue_script('fixedColumns');

        wp_localize_script('liqpay_form_script', 'liqpay_object', array(
            'liqpay_converter_type' => get_option('liqpay_converter_type')
        ));
    }
}
add_action('wp_enqueue_scripts', 'liqpay_load_resources', 5);

if (!function_exists('admin_custom_js')) {
    function admin_custom_js()
    {
        if ((strpos($_SERVER['REQUEST_URI'], "liqpay_list") !== false) || (strpos($_SERVER['REQUEST_URI'], "liqpay_options") !== false)) {
            wp_register_script('dataTables', '//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js', array('jquery'));
            wp_enqueue_script('dataTables');
            wp_register_script('dataTables_yadcf', plugins_url('/js/jquery.dataTables.yadcf.js', __FILE__), array('jquery', 'dataTables'));
            wp_enqueue_script('dataTables_yadcf');
            wp_register_script( 'dataTables_js',plugins_url('/js/datatable.js', __FILE__), array('jquery', 'dataTables'));
            wp_localize_script( 'dataTables_js', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
            wp_enqueue_script('dataTables_js');
        }
        wp_register_script('liqpay_admin_script', plugins_url('/js/liqpay_admin.js', __FILE__), array('jquery'));
        wp_enqueue_script('liqpay_admin_script');
    }
}
add_action('admin_init', 'admin_custom_js');
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('woocommerce/woocommerce.php')) {
    require_once "woocommerce.php";
}

function get_timezone()
{
    $timezone = get_option('timezone_string');

    if (empty($timezone)) {
        $timezone = sprintf('%+.4g', get_option('gmt_offset', 0));
        $timezone = $timezone * -1;
        $timezone = sprintf('%+.4g', $timezone);
    }
    return $timezone;
}

date_default_timezone_set('Etc/GMT' . get_timezone());
require_once(ABSPATH . "wp-includes/pluggable.php");
function liqpay_options()
{
    //Add menu
    add_menu_page('Liqpay', __("Liqpay buy", "liqpay"), 'manage_options', 'liqpay_buy', 'liqpay_base');
    add_submenu_page('liqpay_buy', 'Liqpay', __('Payment Journal', 'liqpay'), "manage_options", 'liqpay_list', 'liqpay_list_page');
    add_submenu_page('liqpay_buy', 'Liqpay', __('Button generation', 'liqpay'), "manage_options", 'liqpay_generation_button', 'liqpay_generation_button_page');
    add_submenu_page('liqpay_buy', 'Liqpay', __('Product List', 'liqpay'), "manage_options", 'liqpay_product_page', 'liqpay_product_page');
    add_submenu_page('liqpay_buy', 'Liqpay', __('Discounts for members', 'liqpay'), "manage_options", 'liqpay_skidki_page', 'liqpay_skidki_page');
    if (is_plugin_active('liqpay_wordpress_secure_content/liqpay.php')) {
        add_submenu_page('liqpay_buy', 'Liqpay', __('Sale of codes / passwords', 'liqpay'), "manage_options", 'liqpay_secure_buy_pass_page', 'liqpay_secure_buy_pass_page');
    }
    add_submenu_page('liqpay_buy', 'Liqpay', __('Setting', 'liqpay'), "manage_options", 'liqpay_options', 'liqpay_options_page');
}


function func_vivod_skidki()
{
    $code_vivod_skidki = vivod_skidki();
    return $code_vivod_skidki;
}

add_shortcode('vivod_skidki', 'func_vivod_skidki');
function func_vivod_uslugi()
{
    $code_vivod_uslugi = vivod_uslugi();
    return $code_vivod_uslugi;
}

add_shortcode('vivod_uslugi', 'func_vivod_uslugi');


function liqpay_generation_button_page()
{
    global $wpdb;


    echo '<div class="wrap"><div id="icon-options-general" class="icon32">
    <br>
  </div>
  <h2>' . __('Button generation', 'liqpay') . '</h2>
  <h3>' . __('Please fill in the fields below and click "Generate Code", insert the code in the correct location on the site.', 'liqpay') . '</h3>';
    if (isset($_POST['comment1'])) {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $liqpay_gen_button_check_summa = $_POST['liqpay_gen_button_check_summa'];
        update_option('liqpay_gen_button_check_summa', $liqpay_gen_button_check_summa);
        $show_fio = $_POST['show_fio'];
        update_option('show_fio', $show_fio);
        $show_skidka = $_POST['show_skidka'];
        update_option('show_skidka', $show_skidka);
        $hidden_content = $_POST['hidden_content'];
        update_option('hidden_content', $hidden_content);
        $txt_vivod = "<div style='width: 160px'><form >";
        $txt_tmp = " <form action='" . WP_CONTENT_URL . "/plugins/liqpay_wordpress/liqpay-form.php' method='POST' style='width: 197px;'";
        if ($hidden_content) $txt_tmp .= " target='_blank' ";
        $txt_tmp .= " >";
        $txt2 = "<input type='hidden' name='date' value='\".date(\"d.m.Y H:i:s\" ).\"' required/>";
        $txt2 .= "<input type='hidden' name='liqpay_product_id'  value='" . $_POST['menu_products'] . "'/>";
        $txt2 .= "<input type='hidden' name='hidden_content'  value='" . $_POST['hidden_content'] . "'/>";
        $txt2 .= "<input type='hidden' name='url_page'  value=[url_page]/>";
        $txt2 .= "<input type='hidden' name='ip'  value=[ip]/>";
        $txt2 .= "<input type='hidden' name='pay_type'  value='" . $_POST['pay_type'] . "'/>";
        $txt2 .= "<input type='hidden' name='subscribe_type'  value='" . $_POST['subscribe_type'] . "'/>";
        if (!$_POST['show_fio']) $txt2 .= "<input  class='textarea' type='text' name='fio' value=''  placeholder='ФИО' required/><br />";
        $txt2 .= "<input  class='textarea' type='email' name='mail' value=''  placeholder='Email' required/> <br />";
        if ($hidden_content) $txt2 .= "<label for='change_day'>" . __('For how many days need access?', 'liqpay') . " </label> <br /><input  class='textarea' type='text' id='change_day' name='day' value='1'  required/> <br />";
        $txt2 .= "<label for='plata'>" . __('Purpose of payment', 'liqpay') . "</label><br /><input  class='textarea'";
        if (!$_POST['plata']) $txt2 .= " ";
        else $txt2 .= " readonly ";
        $txt2 .= " type='text' id='plata' name='plata'  value='" . $_POST['plata'] . "' /><br />";
        $txt2 .= "<input style='float: left;'    class='textarea val' type='text' id='paid' name='paid'  value='";
        if (get_option('liqpay_gen_button_check_summa'))
            $txt2 .= $_POST['liqpay_gen_button_check_summa'] . "' readonly required/> ";
        else
            $txt2 .= '\' required/> ';
        if (!$_POST['menu_valuta']) {
            $txt2 .= "<select class='textarea sel' style='float: left;' name='menu' size='1'> ";
            $txt2 .= "<option value='EUR'>EUR</option>";
            $txt2 .= "<option selected='selected' value='UAH'>UAH</option>";
            $txt2 .= "<option  value='USD'>USD</option>";
            $txt2 .= "<option  value='RUB'>RUB</option>";
            $txt2 .= "</select> ";
        } else {
            $txt2 .= "<input  class='textarea' style='width:50px; float: left;' type='text' readonly name='menu'   value='" . $_POST['menu_valuta'] . "' required/>";
        }
        $txt_vivod .= $txt2;
        $txt2 = $txt_tmp . $txt2;
        if ($_POST['show_skidka']) {
            $txt_vivod .= "[vivod_skidki]<br />";
            $txt2 .= "[vivod_skidki] <br />";
        } else {
            $txt_vivod .= "<br />";
            $txt2 .= "<br />";
        }
        $txt2 .= "  <input class='btn' type='submit' value='" . $_POST['name_button_buy'] . "' /></form>";
        $txt_vivod .= "<input class='btn' type='Button' value='" . $_POST['name_button_buy'] . "' /> </form></div>";
        if (($_POST['plata']) and ($_POST['menu_valuta']) and (get_option('liqpay_gen_button_check_summa')) and ($_POST['show_fio'])) {
            $txt2 = " <form  action='" . WP_CONTENT_URL . "/plugins/liqpay_wordpress/liqpay-form.php' method='POST'>";
            $txt2 .= "  <input type='hidden' name='date' value='\".date(\"d.m.Y H:i:s\" ).\"' required/>";
            $txt2 .= "<input type='hidden' name='fio' value='' required/>";
            $txt2 .= "<input type='hidden' name='plata' value='" . $_POST['plata'] . "'> ";
            $txt2 .= "<input type='hidden' name='paid'  value='" . $_POST['liqpay_gen_button_check_summa'] . "'/>";
            $txt2 .= "<input type='hidden' name='menu'  value='" . $_POST['menu_valuta'] . "'/>";
            $txt2 .= "<input type='hidden' name='liqpay_product_id'  value='" . $_POST['menu_products'] . "'/>";
            $txt2 .= "  <input class='btn' type='submit' value='" . $_POST['name_button_buy'] . " " . $_POST['plata'] . " : " . get_option('liqpay_gen_button_check_summa') . " " . $_POST['menu_valuta'] . "' > </form>";
            $txt_vivod = "<div style='width: 160px'><form >";
            $txt_vivod .= "<input class='btn' type='Button' value='" . $_POST['name_button_buy'] . " " . $_POST['plata'] . " : " . get_option('liqpay_gen_button_check_summa') . " " . $_POST['menu_valuta'] . "' > </form></div>";
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $loc = "self.location.href=\"javascript:window.location.reload()\"";

    echo " <form class='textarea' style ='padding: 8px;' method='POST'>";
    $table_products = $wpdb->prefix . 'liqpay_products';
    $products = $wpdb->get_results("SELECT id, name, cost, valuta FROM " . $table_products);
    if (count($products) > 0) {
        echo "<select class='textarea' id='menu_products' name='menu_products' size='1'> 
    <option selected='selected' value=''></option>";
        foreach ($products as $item) {
            echo "<option";
            if ($_POST['menu_products'] == $item->id) echo " selected='selected' ";
            echo " value='" . $item->id . "'>" . $item->name . " | " . $item->cost . "|" . $item->valuta . "</option>";
        }
        echo "</select> <span>" . __('Select a product', 'liqpay') . "</span> <br />";
    }
    echo "<input class='textarea' type='text' id='plata' name='plata' value='" . $_POST['plata'] . "'";
    echo "/> <span>" . __('Purpose of payment (if the field is filled, then client can not change the "Purpose of payment" )', 'liqpay') . "</span> <br />
<input class='textarea' style='width:50px' type='text' id='liqpay_gen_button_check_summa' name='liqpay_gen_button_check_summa' value='" . $_POST['liqpay_gen_button_check_summa'] . "' '/> 
<select class='textarea' id='menu_valuta'  name='menu_valuta' size='1'> 
    <option selected='selected' value=''></option>
    ";
    if ($_POST['menu_valuta'] == 'EUR') echo "<option selected='selected' value='EUR'>EUR</option>";
    else
        echo "<option value='EUR'>EUR</option>";
    if ($_POST['menu_valuta'] == 'UAH') echo "<option selected='selected' value='UAH'>UAH</option>";
    else
        echo "<option  value='UAH'>UAH</option>";
    if ($_POST['menu_valuta'] == 'USD') echo "<option selected='selected' value='USD'>USD</option>";
    else
        echo "<option  value='USD'>USD</option>";
    if ($_POST['menu_valuta'] == 'RUB') echo "<option selected='selected' value='RUB'>RUB</option>";
    else
        echo "<option  value='RUB'>RUB</option>";
    echo "</select> 
    <span>" . __('Amount and currency (if the field is filled, then client can not change the  amount)', 'liqpay') . " </span>  <br />
    <input class='textarea' type='text' id='name_button_buy' name='name_button_buy' value='" . $_POST['name_button_buy'] . "' required/> <span>" . __('The text for the "Pay" button (*)', 'liqpay') . " </span> 
    <br />";
    echo "<lable>
    <select class='textarea' id='pay_type'  name='pay_type' size='1'> 
    <option selected='selected' value='pay'>" . __('Pay', 'liqpay') . "</option>
    <option value='subscribe'>" . __('Subscribe', 'liqpay') . "</option>
    <option value='paydonate'>" . __('Paydonate', 'liqpay') . "</option>
    </select>";
    echo "
    <select class='textarea' id='subscribe_type'  name='subscribe_type' size='1'> 
    <option selected='selected' value='month'>" . __('Month', 'liqpay') . "</option>
    <option value='year'>" . __('Year', 'liqpay') . "</option>
    </select>" . __('Type of payment', 'liqpay') . "</lable>";

    echo "</br><lable><input type='checkbox' name='show_fio' value='1'";
    if (get_option('show_fio')) echo 'checked';
    echo "> " . __('Hide field name?', 'liqpay') . "</lable> <br />";
    echo "<lable><input type='checkbox' name='show_skidka' value='1'";
    if (get_option('show_skidka')) echo 'checked';
    echo "> " . __('Show discount field?', 'liqpay') . "</lable>
    <br />  ";
    if (is_plugin_active('liqpay_wordpress_secure_content/liqpay.php')) {
        echo "<lable><input type='checkbox' name='hidden_content' value='1'";
        if (get_option('hidden_content')) echo 'checked';
        echo "> " . __('Form for hidden content.', 'liqpay') . "</lable>
        <br />";
    }
    echo "<input class='btn' type='submit' name='comment1' value='" . __('Generate Code', 'liqpay') . "' >
    <input class='btn' type='button' value='Очистить' onclick='" . $loc . "'  />
</form>
";
    echo '</div><br />';
    echo "<form method='POST'>
<textarea  class='textarea'  readonly name='comment' cols='60' rows='10'>" . $txt2 . "</textarea><br /><span>" . __('Html code', 'liqpay') . "</span> 
<br /><br />
";
    echo __('Your form will be like this ...', 'liqpay') . "<br />" . $txt_vivod;
}


add_action('wp_ajax_nopriv_get_liqpay_exchange_courses', 'get_liqpay_exchange_courses');
add_action('wp_ajax_get_liqpay_exchange_courses', 'get_liqpay_exchange_courses');

function get_liqpay_exchange_courses()
{
    $translation_array = array(
        'default' => get_option('liqpay_def_cur'),
        'liqpay_exc_b_USD' => get_option('liqpay_exc_b_USD'),
        'liqpay_exc_s_USD' => get_option('liqpay_exc_s_USD'),
        'liqpay_exc_b_EUR' => get_option('liqpay_exc_b_EUR'),
        'liqpay_exc_s_EUR' => get_option('liqpay_exc_s_EUR'),
        'liqpay_exc_b_RUB' => get_option('liqpay_exc_b_RUB'),
        'liqpay_exc_s_RUB' => get_option('liqpay_exc_s_RUB'),
    );
    echo json_encode($translation_array);
    die();
}

add_action('wp_ajax_nopriv_get_liqpay_list_page', 'get_liqpay_list_page');
add_action('wp_ajax_get_liqpay_list_page', 'get_liqpay_list_page');

function get_liqpay_list_page()
{
    global $wpdb;


    $aColumns = array('id', 'xdate', 'transaction_id', 'status', 'err_code', 'summa', 'valuta', 'sender_phone', 'comments', 'email', 'ip');
    $Search_col = array();

    // SQL limit
    $sLimit = '';
    $filtr_col_set = 0;
    foreach ($aColumns as $col => $row) {
        if ($_POST['sSearch_' . $col]) $filtr_col_set = 1;
        $Search_col[] = $_POST['sSearch_' . $col];
    }
    $file = WP_CONTENT_DIR . '/log.txt';
    file_put_contents($file, print_r($Search_col, 1));
    $sIndexColumn = "id";
    if (isset($_POST['iDisplayStart']) && $_POST['iDisplayLength'] != '-1') {
        $sLimit = 'LIMIT ' . (int)$_POST['iDisplayStart'] . ', ' . (int)$_POST['iDisplayLength'];
    }


    // SQL order

    $sOrder = '';
    if (isset($_POST['iSortCol_0'])) {
        $sOrder = 'ORDER BY  ';
        for ($i = 0; $i < (int)$_POST['iSortingCols']; $i++) {
            if ($_POST['bSortable_' . (int)$_POST['iSortCol_' . $i]] == 'true') {
                $sOrder .= '`' . $aColumns[(int)$_POST['iSortCol_' . $i]] . '` ' .
                    ($_POST['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ', ';
            }
        }
        $sOrder = substr_replace($sOrder, '', -2);
        if ($sOrder == 'ORDER BY') {
            $sOrder = '';
        }
    }

    // SQL where
    $sWhere = '';
    if (isset($_POST['sSearch']) && $_POST['sSearch'] != '' || ($filtr_col_set == 1)) {
        $sWhere = 'WHERE';
        if ($filtr_col_set == 1) {
            for ($i = 0; $i < count($Search_col); $i++) {
                if ($Search_col[$i]) {
                    if ($i == 1) {
                        $date = explode("-yadcf_delim-", $Search_col[$i]);
                        if ($date[0] && !$date[1]) $sWhere .= ' `' . $aColumns[$i] . "` >=  '" . date('Y-m-d', strtotime($date[0])) . " 00:00:00" . "' AND  ";
                        else if (!$date[0] && $date[1]) $sWhere .= ' `' . $aColumns[$i] . "` <=  '" . date('Y-m-d', strtotime($date[1])) . " 23:59:59" . "' AND  ";
                        else if ($date[0] && $date[1]) $sWhere .= ' `' . $aColumns[$i] . "` BETWEEN  '" . date('Y-m-d', strtotime($date[0])) . " 00:00:00" . "' AND '" . date('Y-m-d', strtotime($date[1])) . " 23:59:59" . "' AND  ";
                    } else if ($i == 5) {
                        $num = explode("-yadcf_delim-", $Search_col[$i]);
                        if ($num[0] && !$num[1]) $sWhere .= ' `' . $aColumns[$i] . "` >=  '" . $num[0] . "' AND  ";
                        else if (!$num[0] && $num[1]) $sWhere .= ' `' . $aColumns[$i] . "` <=  '" . $num[1] . "' AND  ";
                        else if ($num[0] && $num[1]) $sWhere .= " `" . $aColumns[$i] . "` BETWEEN  " . $num[0] . ' AND ' . $num[1] . " AND  ";
                    } else {
                        $sWhere .= " $aColumns[$i]  LIKE '%" . $Search_col[$i] . "%' AND  ";
                    }
                }
            }
        } else
            for ($i = 0; $i < count($aColumns); $i++) {
                if (isset($_POST['bSearchable_' . $i]) && $_POST['bSearchable_' . $i] == 'true') {
                    $sWhere .= ' `' . $aColumns[$i] . "` LIKE '%" . $_POST['sSearch'] . "%' OR   ";
                }
            }
        $sWhere = substr_replace($sWhere, '', -5);
    }

    $table_liqpay = $wpdb->prefix . 'liqpay';
    $query = " SELECT SQL_CALC_FOUND_ROWS w.order_id id, w.xdate, w.transaction_id,w.status, w.err_code, w.summa, w.valuta, w.sender_phone,   w.comments, w.email, w.ip
            FROM $table_liqpay as w ";
    $query .= " $sWhere ";
    $query .= " $sOrder ";
    $query .= " $sLimit ";

    $result_sql = $wpdb->get_results($query, ARRAY_N);
    $query = "
        SELECT FOUND_ROWS() as col
    ";
    $iFilteredTotal = $wpdb->get_results($query, ARRAY_N);
    $iFilteredTotal = $iFilteredTotal[0][0];
    /* Total data set length */
    $query = "
        SELECT COUNT(" . $sIndexColumn . ") as col
        FROM   $table_liqpay
    ";
    $iTotal = $wpdb->get_results($query, ARRAY_N);
    $iTotal = $iTotal[0][0];

    /*
     * Output
     */
    $output = array(
        "draw" => 0,
        "recordsTotal" => $iTotal,
        "recordsFiltered" => $iFilteredTotal,
        "data" => array()
    );

    foreach ($result_sql as $aRow) {
        $row = array();

        for ($i = 0; $i < count($aColumns); $i++) {
            if ($i == 5) {
                $row[] = $aRow[$i] . " " . $aRow[6];
            } elseif ($aColumns[$i] != ' ') {
                $row[] = $aRow[$i];
            }

        }

        $output['data'][] = $row;

    }

    echo json_encode($output);
    wp_die();
}


function liqpay_list_page()
{
    global $paid, $user_identity, $current_user, $wpdb;

    if (wp_get_current_user()->exists()) {
        $current_user = wp_get_current_user();
    }
    if (isset($_POST['liqpay_reset_filter'])) {
        update_option('liqpay_check_disable_failure', '');
        update_option('liqpay_search_order_id', '');
        update_option('liqpay_search_date_begin', '');
        update_option('liqpay_search_date_end', '');
    }
    if (isset($_POST['liqpay_filter'])) {
        $liqpay_check_disable_failure = $_POST['liqpay_check_disable_failure'];
        update_option('liqpay_check_disable_failure', $liqpay_check_disable_failure);
    }
    if (isset($_POST['liqpay_search'])) {
        $liqpay_search_order_id = $_POST['liqpay_search_order_id'];
        update_option('liqpay_search_order_id', $liqpay_search_order_id);
        $liqpay_search_date_begin = $_POST['liqpay_search_date_begin'];
        $liqpay_search_date_end = $_POST['liqpay_search_date_end'];
        update_option('liqpay_search_date_begin', $liqpay_search_date_begin);
        update_option('liqpay_search_date_end', $liqpay_search_date_end);
    }


    echo '<div class="wrap"><div id="icon-options-general" class="icon32">
    <br>
</div>


<h2>' . __('Payment Journal', 'liqpay') . '</h2>';
    echo "<table id='table_list' class='display' width='100%'>
<thead>
  <tr style='text-align: center;'>
    <th>" . __('Order_id', 'liqpay') . "</th>
    <th>" . __('Date', 'liqpay') . "</th>
    <th>" . __('Transaction #', 'liqpay') . "</th>
    <th>" . __('Status', 'liqpay') . "</th>
    <th>" . __('Error code', 'liqpay') . "</th>
    <th>" . __('Sum', 'liqpay') . "</th>
    <th>" . __('Currency', 'liqpay') . "</th>
    <th>" . __('Phone', 'liqpay') . "</th>
    <th>" . __('Comment', 'liqpay') . "</th>
    <th>" . __('email', 'liqpay') . "</th>
    <th>" . __('IP', 'liqpay') . "</th>
  </tr>
  </thead>
  <tfoot>
  <tr>
   <th style='padding: 0;'>" . __('Order ID', 'liqpay') . "</th>
    <th>" . __('Date', 'liqpay') . "</th>
    <th>" . __('Transaction #', 'liqpay') . "</th>
    <th>" . __('Status', 'liqpay') . "</th>
    <th>" . __('Error code', 'liqpay') . "</th>
    <th>" . __('Sum', 'liqpay') . "</th>
    <th>" . __('Currency', 'liqpay') . "</th>
    <th>" . __('Phone', 'liqpay') . "</th>
    <th>" . __('Comment', 'liqpay') . "</th>
    <th>" . __('email', 'liqpay') . "</th>
    <th>" . __('IP', 'liqpay') . "</th>
  </tr>
  </tfoot>

</table>";
    echo "<div id='chart_div' style='width: 1200px; height: 500px;'></div>";

}

function liqpay_base()
{
    global $paid, $user_identity, $current_user, $wpdb;
    if (wp_get_current_user()->exists()) {
        $current_user = wp_get_current_user();
    }
    echo '<div class="wrap"><div id="icon-options-general" class="icon32">
            <br>
        </div>
        <h2>' . __('Liqpay buy', 'liqpay') . '</h2>
        <h3>' . __("Please fill in the fields below and click 'Buy', then you'll be taken to a secure site LiqPay.ua, in which you need to fill in details of your card (Visa / MasterCard)", 'liqpay') . '</h3>';
    $fio = $current_user->user_firstname . " " . $current_user->user_lastname;
    if ($fio == " ") $fio = "";
    echo(" <form action='" . WP_CONTENT_URL . "/plugins/liqpay_wordpress/liqpay-form.php' method='POST'>
            <input type='hidden' name='date' value='" . date("d.m.Y H:i:s") . "' required/>
            <input  class='textarea' type='text' name='fio' value='" . $fio . "' required/> <span>" . __('First name', 'liqpay') . "</span> 
            <br />
            <input  class='textarea' type='text' name='plata' value='' required/> <span>" . __('Purpose of payment', 'liqpay') . "</span><br />
            <input  class='textarea' type='text' name='paid'  value='' required/> <span>" . __('Amount', 'liqpay') . "</span> 
            <select  class='textarea' name='menu' size='1'> 
                <option value='EUR'>EUR</option>
                <option selected='selected' value='UAH'>UAH</option>
                <option value='USD'>USD</option>
                <option value='RUB'>RUB</option>
            </select> <span>" . __('Select a currency', 'liqpay') . "</span>
            <br />
            <input class='btn' type='submit' value='" . __('Buy', 'liqpay') . "' >
        </form>
        ");
    echo '</div>';
}

function liqpay_options_page()
{
    //Если форма была отправлена, то применить изменения магазина
    if (isset($_POST['liqpay_base_setup_btn'])) {
        if (function_exists('current_user_can') && !current_user_can('manage_options')) die (_e('Hacker?', 'liqpay'));
        if (function_exists('check_admin_referer')) {
            check_admin_referer('liqpay_base_setup_form_#@r@@t');
        }
        $liqpay_merchant_id = $_POST['liqpay_merchant_id'];
        $liqpay_signature_id = $_POST['liqpay_signature_id'];
        $liqpay_phone = $_POST['liqpay_phone'];
        $liqpay_mail = $_POST['liqpay_mail'];
        $liqpay_mail_sender = $_POST['liqpay_mail_sender'];
        $liqpay_ip_buyer = $_POST['liqpay_ip_buyer'];
        $liqpay_magazin = $_POST['liqpay_magazin'];
        $liqpay_komissiya = $_POST['liqpay_komissiya'];
        $extra_fee_option_label = $_POST['extra_fee_option_label'];
        $liqpay_fees = $_POST['liqpay_fees'];
        $liqpay_fees_type = $_POST['liqpay_fees_type'];
        $liqpay_def_cur = $_POST['liqpay_def_cur'];
        $liqpay_check_testmode = $_POST['liqpay_check_testmode'];
        $liqpay_converter_type = $_POST['liqpay_converter_type'];
        $liqpay_lang = $_POST['liqpay_lang'];
        $liqpay_thanks = $_POST['liqpay_thanks'];
        $thank_page_content_success = $_POST['thank_page_content_success'];
        $thank_page_content_error = $_POST['thank_page_content_error'];
        $liqpay_code_expiration = $_POST['liqpay_code_expiration'];

        $liqpay_exc_b_USD = $_POST['liqpay_exc_b_USD'];
        $liqpay_exc_s_USD = $_POST['liqpay_exc_s_USD'];
        $liqpay_exc_b_EUR = $_POST['liqpay_exc_b_EUR'];
        $liqpay_exc_s_EUR = $_POST['liqpay_exc_s_EUR'];
        $liqpay_exc_b_RUB = $_POST['liqpay_exc_b_RUB'];
        $liqpay_exc_s_RUB = $_POST['liqpay_exc_s_RUB'];


        $liqpay_result_url = $_POST['liqpay_result_url'];
        $protocol = strtolower($_SERVER["SERVER_PROTOCOL"]);
        $protocol = substr($protocol, 0, strpos($protocol, "/"));
        $url = $protocol . "://" . $_SERVER['SERVER_NAME'];
        //if (!$liqpay_result_url) $liqpay_result_url = $url;
        update_option('liqpay_code_expiration', $liqpay_code_expiration);
        update_option('liqpay_merchant_id', $liqpay_merchant_id);
        update_option('liqpay_signature_id', $liqpay_signature_id);
        update_option('liqpay_phone', $liqpay_phone);
        update_option('liqpay_mail', $liqpay_mail);
        update_option('liqpay_ip_buyer', $liqpay_ip_buyer);
        update_option('liqpay_mail_sender', $liqpay_mail_sender);
        update_option('liqpay_magazin', $liqpay_magazin);
        update_option('liqpay_check_testmode', $liqpay_check_testmode);
        update_option('liqpay_komissiya', $liqpay_komissiya);
        update_option('extra_fee_option_label', $extra_fee_option_label);
        update_option('liqpay_fees', $liqpay_fees);
        update_option('liqpay_fees_type', $liqpay_fees_type);
        update_option('liqpay_def_cur', $liqpay_def_cur);
        update_option('liqpay_converter_type', $liqpay_converter_type);
        update_option('liqpay_lang', $liqpay_lang);
        update_option('liqpay_thanks', $liqpay_thanks);
        update_option('thank_page_content_success', stripslashes($thank_page_content_success));
        update_option('thank_page_content_error', stripslashes($thank_page_content_error));
        update_option('liqpay_result_url', $liqpay_result_url);

        update_option('liqpay_exc_b_USD', $liqpay_exc_b_USD);
        update_option('liqpay_exc_s_USD', $liqpay_exc_s_USD);
        update_option('liqpay_exc_b_EUR', $liqpay_exc_b_EUR);
        update_option('liqpay_exc_s_EUR', $liqpay_exc_s_EUR);
        update_option('liqpay_exc_b_RUB', $liqpay_exc_b_RUB);
        update_option('liqpay_exc_s_RUB', $liqpay_exc_s_RUB);


    }
    if ($_POST['liqpay_converter_type'] == 'privatb')
        liqpay_currency_exchange_function();
    else {
        wp_clear_scheduled_hook('liqpay_currency_exchange');
    }

    //Info about magazne
    echo " <div class='wrap'>  <div class='icon32' id='icon-options-general'><br /></div><h2>" . __('Settings for Liqpay&Wordpress!', 'liqpay') . "</h2>";
    echo "          <form name='liqpay_base_setup' method='post' action='" . $_SERVER['REQUEST_URI'] . "'>
        ";
    if (function_exists('wp_nonce_field')) {
        wp_nonce_field('liqpay_base_setup_form_#@r@@t');
    }
    $dey_left = get_option('days_left');
    if ($dey_left < 0) {
        $dey_left = 0;
        $color = 'red';
    } elseif ($dey_left > 0) {
        $color = 'green';
    }

    echo "<div style='color:" . $color . "; font-size:25px; position: absolute;'>" . __('Days left', 'liqpay') . " - " . $dey_left . "</div>";
    echo "
        <table width=auto>
            <tr>
                <td style='text-align:right;'>" . __('Public key:', 'liqpay') . "</td>
                <td style='width: 165px;'><input  class='textarea' type='text' name='liqpay_merchant_id' value='" . get_option('liqpay_merchant_id') . "'/></td>
                <td style='color:#666666;'><i>" . __('Public key (merchant_id) is a unique record of the merchant, which is issued at the time of registration of your store in liqpay system.', 'liqpay') . "</i></td>
            </tr>
            <tr>
                <td style='text-align:right;'>" . __('Private key:', 'liqpay') . "</td>
                <td><input  class='textarea' type='text' name='liqpay_signature_id' value='" . get_option('liqpay_signature_id') . "'/></td>
                <td width='600px' style='color:#666666;'><i>" . __('The private key (signature_id) is the unique signature of the merchant, which is issued at the time of registration of your store in liqpay system.', 'liqpay') . "</i></td>
            </tr>
            <tr>
                <td style='text-align:right;'>" . __('Your phone number:', 'liqpay') . "</td>
                <td><input  class='textarea' type='text' name='liqpay_phone' value='" . get_option('liqpay_phone') . "'/></td>
                <td style='color:#666666;'><i>" . __('Your phone number that is connected to your store, entered in the international format (380501234567).', 'liqpay') . "</i></td>
            </tr>
            <tr>
                <td style='text-align:right;'>" . __('Email:', 'liqpay') . "</td>
                <td><input  class='textarea' type='text' name='liqpay_mail' value='" . get_option('liqpay_mail') . "'/></td>
                <td style='color:#666666;'><i>" . __('Your mail that will receive reports on payment.', 'liqpay') . "</i></td>
            </tr>
            <tr>
                <td style='text-align:right;'>" . __('Name of your company:', 'liqpay') . "</td>
                <td><input  class='textarea' type='text' name='liqpay_magazin' value='" . get_option('liqpay_magazin') . "'/></td>
                <td style='color:#666666;'><i>" . __("Enter the name of your company (store). This text clients will see in the message field (from whom) it will look something like this (from whom: 'The name of your company' / Mail Address from the next field) /", 'liqpay') . "</i></td>
            </tr>
            <tr>            
                <td style='text-align:right;'>" . __('Your mail sender:', 'liqpay') . "</td>
                <td><input  class='textarea' type='text' name='liqpay_mail_sender' value='" . get_option('liqpay_mail_sender') . "'/></td>
                <td style='color:#666666;'><i>" . __('Your mail will be sent with the letter which your customers  that paid for your services', 'liqpay') . "</i></td>
            </tr>
            <tr bgcolor='#999999'><td></td> <td></td><td></td></tr> 
            <tr>
                <td style='text-align:right;'>" . __('Commission:', 'liqpay') . "</td>
                <td><input  class='textarea' type='text' pattern=\"[0-9]{,3}\" name='liqpay_komissiya' value='" . get_option('liqpay_komissiya') . "'/></td>
                <td style='color:#666666;'><i>" . __('Enter only numbers without any signs, the commission charged to the customer, if you don\'t need any fee, please type 0', 'liqpay') . "</i></td>
            </tr>
            
            <tr>
                <td style='text-align:right;'>" . __("Commission's field name:", 'liqpay') . "</td>
                <td style='width: 165px;'><input  class='textarea' type='text' name='extra_fee_option_label' value='" . get_option('extra_fee_option_label') . "'/></td>
                <td style='color:#666666;'><i>" . __("The name of the commission of the field on the Checkout page", 'liqpay') . "</i></td>
            </tr>
            
        <tr>
                <td style='text-align:right;'>" . __("Commission on checkout (YES)/ in Liqpay page (NO):", 'liqpay') . "</td>
                <td><select class='textarea' style='width: 157px;' name='liqpay_fees' size='1'>
    ";
    if (get_option('liqpay_fees') == 'yes') echo "<option selected='selected' value='yes'>" . __('Yes', 'liqpay') . "</option>";
    else
        echo "<option value='yes'>" . __('Yes', 'liqpay') . "</option>";
    if (get_option('liqpay_fees') == 'no') echo "<option selected='selected' value='no'>" . __('No', 'liqpay') . "</option>";
    else
        echo "<option value='no'>" . __('No', 'liqpay') . "</option>";
    echo "</select> 
                </td>
                <td style='color:#666666;'><i>" . __("Choose where to apply the Commission: Yes - at Checkout page; No - on the side of Liqpay", 'liqpay') . "</i></td>         
   </tr>
                
    <tr> 
    <td style='text-align:right;'>" . __("Commission Type:", 'liqpay') . "</td>
    <td><select class='textarea' style='width: 157px;' name='liqpay_fees_type' size='1'>
    ";
    if (get_option('liqpay_fees_type') == 'perc') echo "<option selected='selected' value='perc'>" . __('Percent', 'liqpay') . "</option>";
    else
        echo "<option value='perc'>" . __("Percent", 'liqpay') . "</option>";
    if (get_option('liqpay_fees_type') == 'fix') echo "<option selected='selected' value='fix'>" . __('Custom', 'liqpay') . "</option>";
    else
        echo "<option value='fix'>" . __("Custom", 'liqpay') . "</option>";
    echo "</select> 
    </td>
    <td style='color:#666666;'><i>" . __("Type of commission or a percentage or fixed amount", 'liqpay') . "</i></td>           
    </tr>
    
    <tr> 
    <td style='text-align:right;'>" . __("Use Currency Converter?:", 'liqpay') . "</td>
    <td><select class='textarea' style='width: 157px;' id='liqpay_converter_type' name='liqpay_converter_type' size='1'>
    ";
    if (get_option('liqpay_converter_type') == 'none') echo "<option selected='selected' value='none'>" . __('No', 'liqpay') . "</option>";
    else
        echo "<option value='none'>" . __('No', 'liqpay') . "</option>";
    if (get_option('liqpay_converter_type') == 'privatb') echo "<option selected='selected' value='privatb'>" . __('Privatbank', 'liqpay') . "</option>";
    else
        echo "<option value='privatb'>" . __('Privatbank', 'liqpay') . "</option>";
    if (get_option('liqpay_converter_type') == 'custom') echo "<option selected='selected' value='custom'>" . __('Custom', 'liqpay') . "</option>";
    else
        echo "<option value='custom'>" . __("Custom Exchange", 'liqpay') . "</option>";
    echo "</select> 
    </td>
    <td style='color:#666666;'><i>" . __("Type of Currency Converter for generated form", 'liqpay') . "</i></td>            
    </tr>";
    echo "<tr>
                <td style='text-align:right;'>" . __("Default currency", 'liqpay') . "</td>
                <td><select class='textarea' style='width: 157px;' name='liqpay_def_cur' size='1'>
    ";

    if (get_option('liqpay_def_cur') == 'uah') echo "<option selected='selected' value='uah'>UAH</option>";
    else
        echo "<option value='uah'>UAH</option>";
    if (get_option('liqpay_def_cur') == 'usd') echo "<option selected='selected' value='usd'>USD</option>";
    else
        echo "<option value='usd'>USD</option>";
    if (get_option('liqpay_def_cur') == 'eur') echo "<option selected='selected' value='eur'>EUR</option>";
    /*else
        echo "<option value='eur'>EUR</option>";
    if (get_option('liqpay_def_cur') == 'rub') echo "<option selected='selected' value='rub'>RUB</option>";
    else
        echo "<option value='rub'>RUB</option>";*/
    echo "</select> 
                </td>
                <td style='color:#666666;'><i>" . __("Select default currency for products.", 'liqpay') . "</i></td>
                </tr>";


    echo "<tr class='currency_exchange'>
    <th></th>
    <th>" . __('Purchase', 'liqpay') . "</th>
    <th>" . __('Sale', 'liqpay') . "</th>
    </tr>
    <tr class='currency_exchange'>
     <td>USD</td>
     <td>" . get_option('liqpay_exc_b_USD') . "</td>
     <td>" . get_option('liqpay_exc_s_USD') . "</td>
    </tr>                       
    <tr class='currency_exchange'>
     <td>EUR</td>
     <td>" . get_option('liqpay_exc_b_EUR') . "</td>
     <td>" . get_option('liqpay_exc_s_EUR') . "</td>
    </tr>       
    <tr class='currency_exchange'>
     <td>RUB</td>
     <td>" . get_option('liqpay_exc_b_RUB') . "</td>
     <td>" . get_option('liqpay_exc_s_RUB') . "</td>
    </tr>   
    
    <tr class='currency_exchange custom'>
    <th></th>
    <th>" . __('Purchase', 'liqpay') . "</th>
    <th>" . __('Sale', 'liqpay') . "</th>
    </tr>
    <tr class='currency_exchange custom'>
     <td>USD</td>
     <td><input type='text' id='liqpay_exc_b_USD' name='liqpay_exc_b_USD' value='" . get_option('liqpay_exc_b_USD') . "'/></td>
     <td><input type='text' id='liqpay_exc_s_USD' name='liqpay_exc_s_USD' value='" . get_option('liqpay_exc_s_USD') . "'/></td>
    </tr>                       
    <tr class='currency_exchange custom'>
     <td>EUR</td>
     <td><input type='text' id='liqpay_exc_b_EUR' name='liqpay_exc_b_EUR' value='" . get_option('liqpay_exc_b_EUR') . "'/></td>
     <td><input type='text' id='liqpay_exc_s_EUR' name='liqpay_exc_s_EUR' value='" . get_option('liqpay_exc_s_EUR') . "'/></td>
    </tr>       
    <tr class='currency_exchange custom'>
     <td>RUB</td>
     <td><input type='text' id='liqpay_exc_b_RUB' name='liqpay_exc_b_RUB' value='" . get_option('liqpay_exc_b_RUB') . "'/></td>
     <td><input type='text' id='liqpay_exc_s_RUB' name='liqpay_exc_s_RUB' value='" . get_option('liqpay_exc_s_RUB') . "'/></td>
    </tr>       
        
            <tr>
                <td style='text-align:right;'>" . __("Language", 'liqpay') . "</td>
                <td><select class='textarea' style='width: 157px;' name='liqpay_lang' size='1'> 
                    ";

    if (get_option('liqpay_lang') == 'ru') echo "<option selected='selected' value='ru'>RU</option>";
    else
        echo "<option value='ru'>RU</option>";
    if (get_option('liqpay_lang') == 'en') echo "<option selected='selected' value='en'>EN</option>";
    else
        echo "<option value='en'>EN</option>";
    echo "</select> 
                </td>
                <td style='color:#666666;'><i>" . __("Select interface language.", 'liqpay') . "</i></td>           </tr>
                <tr class='link_to_page'>
                    <td style='text-align:right;'>" . __("Link to the page:", 'liqpay') . "</td>
                    <td><input  class='textarea' type='text' name='liqpay_result_url' value='" . get_option('liqpay_result_url') . "'/></td>
                    <td style='color:#666666;'><i>" . __("Link to the page on which the user will be taken after the payment (up to 510 characters).", 'liqpay') . "</i></td>           
                    </tr>";

    echo "<tr>
                <td style='text-align:right;'>" . __("Dynamic Thank You Page:", 'liqpay') . "</td>
                <td><select class='textarea' style='width: 157px;' name='liqpay_thanks' size='1'>
    ";
    if (get_option('liqpay_thanks') == 'yes') echo "<option selected='selected' value='yes'>" . __('Yes', 'liqpay') . "</option>";
    else
        echo "<option value='yes'>" . __('Yes', 'liqpay') . "</option>";
    if (get_option('liqpay_thanks') == 'no') echo "<option selected='selected' value='no'>" . __('No', 'liqpay') . "</option>";
    else
        echo "<option value='no'>" . __('No', 'liqpay') . "</option>";
    echo "</select> 
                </td>
                <td style='color:#666666;'><i>" . __("Use dynamic Thank YoU Page", 'liqpay') . "</i></td>           
   </tr>";

    $content = stripslashes(get_option('thank_page_content_success'));
    $editor_id = 'thank_page_content_success';
    $settings = array("editor_height"=>100,"textarea_name"=>"thank_page_content_success");
    ob_start();
    wp_editor( $content, $editor_id ,$settings);
    $editor_contents_succes = ob_get_clean();

    $content = stripslashes(get_option('thank_page_content_error'));
    $editor_id = 'thank_page_content_error';
    $settings = array("editor_height"=>100,"textarea_name"=>"thank_page_content_error");
    ob_start();
    wp_editor( $content, $editor_id ,$settings);
    $editor_contents_error = ob_get_clean();

    echo "<tr class='thank_page_content'>
                <td colspan='1'><i>" . __("Success page template", 'liqpay') . "</i></td>       
                <td colspan='1'></td>       
                <td colspan='1'><i>" . __("Error page template", 'liqpay') . "</i></td>     
   </tr>";
    echo "<tr class='thank_page_content'>
                <td colspan='1'>".$editor_contents_succes."</td>    
                <td colspan='1'></td>       
                <td colspan='1'>".$editor_contents_error."</td>         
   </tr>";


    echo "<tr>
                                <td>
                                    <b><lable><input  class='textarea' type='checkbox' name='liqpay_check_testmode' id='liqpay_check_testmode' value='1'";
    if (get_option('liqpay_check_testmode')) echo 'checked';
    echo "> " . __("Activate test mode (In test mode, the transfer takes place, but the money will not be charged) is only used to verify the operation be sure to disconnect AFTER THE TEST.", 'liqpay') . "</lable></b></td> 
                                </tr>
                                <td></td>
                                <td style='text-align:center'>
                                    <input class='btn' type='submit' name='liqpay_base_setup_btn' value='" . __("Save", 'liqpay') . "'/>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                </div>";
}

function liqpay_product_page()
{
    //Добавление товара
    echo "<h3>Добавить товара</h3>";
    liqpay_add_product();
    //Изменение информации о товаре
    echo "<h3>Список товаров</h3>";
    liqpay_change_product();
}//Изменение информации о товаре
function liqpay_change_product()
{
    global $wpdb;
    $table_products = $wpdb->prefix . 'liqpay_products';
    //Сохранение изменений товаров
    if (isset($_POST['liqpay_products_setup_btn'])) {
        if (function_exists('current_user_can') && !current_user_can('manage_options')) die (_e('Hacker?', 'liqpay'));
        if (function_exists('check_admin_referer')) {
            check_admin_referer('liqpay_products_setup_form');
        }
        $liqpay_product_name = $_POST['liqpay_product_name'];
        $liqpay_product_cost = $_POST['liqpay_product_cost'];
        $liqpay_product_id = $_POST['liqpay_product_id'];
        $liqpay_product_valuta = $_POST['menu_product_valuta_add'];
        $liqpay_product_url = $_POST['liqpay_product_url'];
        $wpdb->update($table_products, array('name' => $liqpay_product_name, 'cost' => $liqpay_product_cost, 'valuta' => $liqpay_product_valuta, 'url' => $liqpay_product_url), array('id' => $liqpay_product_id), array('%s', '%s', '%s', '%s'), array('%d'));
    }
    //Удаление товара
    if (isset($_POST['liqpay_products_delete_btn'])) {
        if (function_exists('current_user_can') && !current_user_can('manage_options')) die (_e('Hacker?', 'liqpay'));
        if (function_exists('check_admin_referer')) {
            check_admin_referer('liqpay_products_setup_form');
        }
        $liqpay_product_id = $_POST['liqpay_product_id'];
        $wpdb->query("DELETE FROM $table_products WHERE id = $liqpay_product_id order by id");
    }
    //Вывод формы информации по товарам
    $products = $wpdb->get_results("SELECT * FROM $table_products order by id");
    foreach ($products as $item) {
        echo "
        <form name='liqpay_products_setup' method='post' action='" . $_SERVER['REQUEST_URI'] . "'>
            ";
        if (function_exists('wp_nonce_field')) {
            wp_nonce_field('liqpay_products_setup_form');
        }
        echo "
            <p style='padding-top:30px;'><b>Товар ID = " . $item->id . "</b></p>
            <table>
                <tr>
                    <td style='text-align:right;'>Название:</td>
                    <td><input  class='textarea' type='text' name='liqpay_product_name' value='" . $item->name . "' style='width:300px;'/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style='text-align:right;'>Цена:</td>
                    <td>
                        <input  class='textarea' type='text' name='liqpay_product_cost' value='" . $item->cost . "'/>
                        <input  class='textarea' type='hidden' name='liqpay_product_id' value='" . $item->id . "'/>
                        <select class='textarea' name='menu_product_valuta_add' size='1'> ";
        if ($item->valuta == 'EUR') echo "<option selected='selected' value='EUR'>EUR</option>";
        else
            echo "<option value='EUR'>EUR</option>";
        if ($item->valuta == 'UAH') echo "<option selected='selected' value='UAH'>UAH</option>";
        else
            echo "<option  value='UAH'>UAH</option>";
        if ($item->valuta == 'USD') echo "<option selected='selected' value='USD'>USD</option>";
        else
            echo "<option  value='USD'>USD</option>";
        if ($item->valuta == 'RUB') echo "<option selected='selected' value='RUB'>RUB</option>";
        else
            echo "<option  value='RUB'>RUB</option>";
        echo "</select> 
                        </td>
                        <td style='color: #666666;'><i>Соблюдайте формат поля - целая часть от дробной отделяется точкой, в дробной обязательно присутствуют два разряда.</i></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style='padding-left:5px; font-size:10px; color:#666666'>Пример: 1.00</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style='text-align:right;'>URL товара:</td>
                        <td>
                            <input  class='textarea' type='text' name='liqpay_product_url' value='" . $item->url . "' style='width:300px;'/>
                        </td>
                        <td style='color:#666666;'><i>Ссылка на товар, для его загрузки после успешной оплаты.</i></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style='padding-left:5px; font-size:10px; color:#666666'>Пример: http://www.moysite.ru/uploads/product1.zip</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input class='btn' type='submit' name='liqpay_products_setup_btn' value='Сохранить' style='width:140px; height:25px'/>
                            <input class='btn' type='submit' name='liqpay_products_delete_btn' value='Удалить' style='width:140px; height:25px'/>
                        </td>
                    </tr>
                </table>
            </form>
            ";
    }
}

//Добавление товара
function liqpay_add_product()
{
    global $wpdb;
    $table_products = $wpdb->prefix . 'liqpay_products';
    //Сохранение добавленного товара в базу
    if (isset($_POST['liqpay_add_product_btn'])) {
        if (function_exists('current_user_can') && !current_user_can('manage_options')) die (_e('Hacker?', 'liqpay'));
        if (function_exists('check_admin_referer')) {
            check_admin_referer('liqpay_add_product_form');
        }
        $liqpay_product_name = $_POST['liqpay_product_name'];
        $liqpay_product_cost = $_POST['liqpay_product_cost'];
        $liqpay_product_valuta = $_POST['menu_product_valuta'];
        $liqpay_product_url = $_POST['liqpay_product_url'];
        $wpdb->insert(
            $table_products, array('name' => $liqpay_product_name, 'cost' => $liqpay_product_cost, 'valuta' => $liqpay_product_valuta, 'url' => $liqpay_product_url), array('%s', '%s', '%s', '%s'));
    }
    //Форма добавления товара
    echo "
        <form name='liqpay_add_product' method='post' action='" . $_SERVER['REQUEST_URI'] . "'>
            ";
    if (function_exists('wp_nonce_field')) {
        wp_nonce_field('liqpay_add_product_form');
    }
    echo "
            <table>
                <tr>
                    <td style='text-align:right;'>Название:</td>
                    <td><input  class='textarea' type='text' name='liqpay_product_name' style='width:300px;'/></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style='text-align:right;'>Цена:</td>
                    <td>
                        <input  class='textarea' type='text' name='liqpay_product_cost'/>
                        <select class='textarea' name='menu_product_valuta' size='1'> 
                            <option value='EUR'>EUR</option>
                            <option selected='selected' value='UAH'>UAH</option>
                            <option  value='USD'>USD</option>   
                            <option  value='RUB'>RUB</option>
                        </select> 
                    </td>
                    <td style='color: #666666;'><i>Соблюдайте формат поля - целая часть от дробной отделяется точкой, в дробной обязательно присутствуют два разряда.</i></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style='padding-left:5px; font-size:10px; color:#666666'>Пример: 1.00</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td style='text-align:right;'>URL товара:</td>
                    <td>
                        <input  class='textarea' type='text' name='liqpay_product_url' style='width:300px;'/>
                    </td>
                    <td style='color:#666666;'><i>Ссылка на товар, для его загрузки после успешной оплаты.</i></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style='padding-left:5px; font-size:10px; color:#666666'>Пример: http://www.moysite.ru/uploads/product1.zip</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input class='btn' type='submit' name='liqpay_add_product_btn' value='Добавить' style='width:140px; height:25px'/>
                    </td>
                </tr>
            </table>
        </form>
        ";
}

if (isset($_POST['liqpay_download'])) {
    liqpay_start_download($_POST['liqpay_code'], 1);
};
function liqpay_delete_expired_codes()
{
    global $wpdb, $table_prefix;
    $final_time = time() - get_option('liqpay_code_expiration') * 60;
    $table_downloadcode = $table_prefix . 'liqpay_downloadcodes';
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM $table_downloadcode WHERE ctime < %d", $final_time));
}

function getExtension4($filename)
{
    return substr(strrchr($fileName, '.'), 1);
}

function liqpay_start_download($dcode_ok, $dwnload_btn_ok)
{
    global $wpdb, $table_prefix, $code;
    liqpay_delete_expired_codes();
    $dcode = $dcode_ok;
    $table_downloadcode = $table_prefix . 'liqpay_downloadcodes';
    $table_products = $table_prefix . 'liqpay_products';
    $code_product = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_downloadcode WHERE downloadcode = %d", $dcode));
    if ($code_product) {
        $product_code_id = $code_product->product_id;
        $product = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_products WHERE id = %d", $product_code_id));
        $url = $product->url;
        if ($dwnload_btn_ok) liqpay_download_file($url);
        else
            return $url;
    } else
        echo "Ссылка не активна" . "   " . $dcode;
}

function get_zip_originalsize($filename)
{
    $size = 0;
    $resource = zip_open($filename);
    while ($dir_resource = zip_read($resource)) {
        $size += zip_entry_filesize($dir_resource);
    }
    zip_close($resource);
    return $size;
}

function liqpay_download_file($filename)
{
    preg_match('/^.+\/([^\/]+)$/i', $filename, $matches);
    header('Content-Disposition: attachment; filename=' . $matches[1]);
    clearstatcache();
    $extent = substr(strrchr($filename, '.'), 1);
    if ($extent = 'zip') $size = get_zip_originalsize($filename);
    else
        $size = filesize($filename);
    header('Content-Length: ' . $size);
    header('Keep-Alive: timeout=5, max=100');
    header('Connection: Keep-Alive');
    header('Content-Type: octet-stream');
    readfile($filename);
    exit;
}

function liqpay_random_string($number)
{
    //$number - кол-во символов
    $arr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
    // Генерируем
    $code_gen = "";
    for ($i = 0; $i < $number; $i++) {
        // Вычисляем случайный индекс массива
        $index = rand(0, count($arr) - 1);
        $code_gen .= $arr[$index];
    }
    return $code_gen;
}


function liqpay_activate()
{
    global $wpdb;
    $api_url = 'aHR0cDovL3BmeS5pbi51YS9saXFwYXkvd3AtY29udGVudC9wbHVnaW5zL2FwaS5waHA=';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, base64_decode($api_url));
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $curl, CURLOPT_POSTFIELDS, array('servername' => $_SERVER['SERVER_NAME']));
    curl_setopt($curl, CURLOPT_USERAGENT, 'MSIE 5');
    curl_setopt($curl, CURLOPT_REFERER, base64_decode($api_url));
    $res = curl_exec($curl);
    curl_close($curl);

    $table_liqpay = $wpdb->prefix . 'liqpay';
    $sql = "CREATE TABLE IF NOT EXISTS {$table_liqpay} (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `order_id` VARCHAR(10) NULL DEFAULT NULL,
            `xdate` DATETIME NOT NULL,
            `transaction_id` INT(11) NOT NULL,
            `status` TINYTEXT NOT NULL,
            `err_code` INT(11) NULL DEFAULT NULL,
            `summa` FLOAT NOT NULL,
            `valuta` TINYTEXT NOT NULL,
            `sender_phone` TINYTEXT NOT NULL,
            `comments` TEXT NOT NULL,
            `email` TEXT NULL,
            `ip` TEXT NULL,
            UNIQUE INDEX `id` (`id`),
            UNIQUE INDEX `order_id_UNIQUE` (`order_id`)
        )
        COLLATE='utf8_general_ci'
        ENGINE=MyISAM";
    $wpdb->query($sql);
    $alter_sql = "
IF NOT EXISTS( SELECT NULL
            FROM INFORMATION_SCHEMA.COLUMNS
           WHERE table_name = {$table_liqpay}
             AND table_schema = 'db_name'
             AND column_name = 'email')  THEN

ALTER TABLE {$table_liqpay} ADD COLUMN email TEXT AFTER comments
END IF;
";
    $wpdb->query($alter_sql);
    $alter_sql = "ALTER TABLE {$table_liqpay} ADD COLUMN ip TEXT AFTER email";
    $wpdb->query($alter_sql);
    $alter_sql = "ALTER TABLE {$table_liqpay} 
    CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ,
    ADD COLUMN `order_id` VARCHAR(10) NULL AFTER `id`;";
    $wpdb->query($alter_sql);
    $alter_sql = "ALTER TABLE {$table_liqpay} 
    ADD UNIQUE INDEX `order_id_UNIQUE` (`order_id` ASC);";
    $wpdb->query($alter_sql);
    $table_products = $wpdb->prefix . 'liqpay_products';
    $table_answer_code = $wpdb->prefix . 'liqpay_answer_code';
    $table_downloadcodes = $wpdb->prefix . 'liqpay_downloadcodes';
    $table_uslugi = $wpdb->prefix . 'liqpay_uslugi';
    $table_skidki = $wpdb->prefix . 'liqpay_skidki';
    $table_project_history = $wpdb->prefix . 'liqpay_project_history';

    $mirgate_ordre_id = "Update {$table_liqpay} set order_id = id where order_id is null;";
    $wpdb->query($mirgate_ordre_id);

    $sql1 = "
CREATE TABLE IF NOT EXISTS `" . $table_downloadcodes . "` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`downloadcode` varchar(64) NOT NULL,
`product_id` int(11) NOT NULL,
`ctime` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
    $sql2 = "
CREATE TABLE IF NOT EXISTS `" . $table_products . "` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`name` varchar(250) NOT NULL,
`cost` varchar(250) NOT NULL,
`valuta` varchar(250) NOT NULL,
`url` varchar(250) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
    $sql3 = "
CREATE TABLE IF NOT EXISTS `" . $table_answer_code . "` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`code` varchar(20) NOT NULL,
`status` varchar(20) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
    $sql4 = "
CREATE TABLE IF NOT EXISTS `" . $table_uslugi . "` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`date_uslugi` DATE NOT NULL,
`time_uslugi` TIME NOT NULL,
`uslugi_tema` varchar(100) NOT NULL,
`uslugi_text` varchar(850) NOT NULL,
`cost` varchar(20) NOT NULL,
`valuta` varchar(20) NOT NULL,        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
    $sql5 = "
CREATE TABLE IF NOT EXISTS `" . $table_skidki . "` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`users_id` int(10) NOT NULL,
`users_name` varchar(100) NOT NULL,
`users_skidka` int(10) NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

    $sql6 = "
CREATE TABLE IF NOT EXISTS `" . $table_project_history . "` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`project_id` VARCHAR(20) NULL DEFAULT NULL,
`transaction_id` INT(11) NOT NULL,
`date` DATETIME NOT NULL,
`users_name` varchar(100) NOT NULL,
`users_phone` varchar(100) NOT NULL,
`users_email` varchar(100) NOT NULL,
`summa` FLOAT NOT NULL,
`type_operation` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";
    $wpdb->query($sql1);
    $wpdb->query($sql2);
    $wpdb->query($sql3);
    $wpdb->query($sql4);
    $wpdb->query($sql5);
    $wpdb->query($sql6);
    //Значения по умолчанию для настроек магазина
    add_option('liqpay_shop_id', 'Не задано');
    add_option('liqpay_secret_key', 'Не задано');
    add_option('liqpay_status_url', 'http://myblog.loc/status');
    add_option('liqpay_code_expiration', '10');
    add_option('liqpay_merchant_id', '');
    add_option('liqpay_signature_id', '');
    add_option('liqpay_phone', '');
    add_option('liqpay_domain', $_SERVER['SERVER_NAME']);
    add_option('liqpay_mail', '');
    add_option('liqpay_ip_buyer', '');
    add_option('liqpay_mail_sender', '');
    add_option('liqpay_magazin', '');
    add_option('liqpay_product_id', '');
    add_option('liqpay_mail_buyer', '');
    add_option('liqpay_gen_button_check_summa', '');
    add_option('liqpay_check_disable_failure', '');
    add_option('liqpay_search_order_id', '');
    add_option('liqpay_search_date_begin', '');
    add_option('liqpay_search_date_end', '');
    add_option('show_fio', '');
    add_option('show_skidka', '');
    add_option('liqpay_code_expiration', '');
    add_option('liqpay_check_testmode', '');
    add_option('liqpay_komissiya', '');
    add_option('extra_fee_option_label', '');
    add_option('liqpay_lang', 'RU');
    add_option('liqpay_thanks', 'yes');
    add_option('thank_page_content_success', '');
    add_option('thank_page_content_error', '');
    add_option('liqpay_current_user', '');
    add_option('liqpay_result_url', '');
    update_option('liqpay_code_expiration', '10');
    update_option('liqpay_check_disable_failure', '0');
    update_option('liqpay_search_order_id', '');
    update_option('liqpay_check_testmode', '0');
    update_option('show_fio', '0');
    update_option('show_skidka', '0');
    update_option('liqpay_komissiya', '3');
    update_option('extra_fee_option_label', 'Liqpay Fee');
    update_option('liqpay_fees', 'yes');
    update_option('liqpay_fees_type', 'perc');
    update_option('liqpay_def_cur', 'uah');
    update_option('liqpay_converter_type', 'none');
    update_option('liqpay_lang', 'ru');
    update_option('liqpay_thanks', 'yes');
    update_option('thank_page_content_success', '<div class="jumbotron text-xs-center">
  <h1 class="display-3">Transacton successful!</h1>
  <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
  <hr>
  <p>
    Having trouble? <a href="">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="/" role="button">Continue to homepage</a>
  </p>
</div>');
    update_option('thank_page_content_error', '<div class="jumbotron text-xs-center">
  <h1 class="display-3">Transacton is error!</h1>
  <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
  <hr>
  <p>
    Having trouble? <a href="">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="/" role="button">Continue to homepage</a>
  </p>
</div>');
    update_option('liqpay_result_url', get_site_url());
    update_option('liqpay_domain', get_site_url());
}

register_activation_hook(__FILE__, 'liqpay_activate');


function url_page_func($atts, $content = null)
{
    $url_page = get_permalink();
    return $url_page;
}

add_shortcode('url_page', 'url_page_func');

function ip_adress()
{
    $ip_adress = GetRealIp();
    return $ip_adress;
}

add_shortcode('ip', 'ip_adress');


function GetRealIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function liqpay_styles_with_the_lot_secure()
{  // Регистрируем стили для плагина:
    wp_register_style('liqpay_base', plugins_url('/css/liqpay.css', __FILE__));
    wp_register_style('datatables', "//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css");
    wp_enqueue_style('datatables');

}

add_action('wp_head', 'liqpay_ajaxurl');

function liqpay_ajaxurl()
{

    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

function liqpay_head_secure()
{
    wp_enqueue_style('liqpay_base', plugins_url('/css/liqpay.css', __FILE__));
    wp_register_style('datatables', "//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css");
    wp_enqueue_style('datatables');
    wp_register_style('jquery-ui', "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
    wp_enqueue_style('jquery-ui');
    wp_register_style('dataTables_yadcf', plugins_url('/css/jquery.dataTables.yadcf.css', __FILE__));
    wp_enqueue_style('dataTables_yadcf');
}

add_action('init', 'liqpay_head_secure');
if (is_admin()) {
    add_action('admin_menu', 'liqpay_options');
}


add_action('wp_ajax_nopriv_update_payment_mathod', 'update_payment_mathod');
add_action('wp_ajax_update_payment_mathod', 'update_payment_mathod');

function update_payment_mathod()
{
    global $woocommerce;

    $payment_mathod = $_REQUEST['payment_mathod'];
    $woocommerce->session->chosen_payment_method = $payment_mathod;
    do_action('woocommerce_cart_calculate_fees');
    echo json_encode($woocommerce->session->chosen_payment_method);
    die();
}

add_action('wp_ajax_nopriv_get_payment_status', 'get_payment_status');
add_action('wp_ajax_get_payment_status', 'get_payment_status');

function get_payment_status()
{
    global $woocommerce;
    if (isset($_REQUEST['server_order_id'])) {
        $status = get_option("liqpay_thankyou_" . $_REQUEST['server_order_id']);
        echo $status;
    }
    die();
}

add_action('woocommerce_cart_calculate_fees', 'woo_add_extra_fee');
/**
 * Set the extra fee with min order total limit
 */
function woo_add_extra_fee()
{
    global $woocommerce;

    if ($woocommerce->session->chosen_payment_method == 'liqpay') {
        $extra_fee_option_label = get_option('extra_fee_option_label') ? get_option('extra_fee_option_label') : 'Extra Fee';
        $extra_fee_option_cost = get_option('liqpay_komissiya') ? get_option('liqpay_komissiya') : '0';
        $extra_fee_option_type = get_option('liqpay_fees_type') ? get_option('liqpay_fees_type') : 'perc';
        $extra_fee_option_taxable = get_option('extra_fee_option_taxable') ? get_option('extra_fee_option_taxable') : false;
        $extra_fee_option_minorder = get_option('extra_fee_option_minorder') ? get_option('extra_fee_option_minorder') : '0';
        $liqpay_fees = get_option('liqpay_fees');

        //get cart total
        $total = $woocommerce->cart->subtotal;

        //check for fee type (fixed fee or cart %)
        if ($extra_fee_option_type == 'perc') {
            //$extra_fee_option_cost = ceil($extra_fee_option_cost * ($total + WC()->cart->shipping_total) / 100);
            $extra_fee_option_cost = round($extra_fee_option_cost * ($total + WC()->cart->shipping_total) / 100, 2);
        }

        //if cart total less or equal than $min_order, add extra fee
        if ($extra_fee_option_cost > 0) {
            if ($liqpay_fees == 'yes') {
                if ($extra_fee_option_minorder > 0) {
                    if ($total <= $extra_fee_option_minorder) {
                        $woocommerce->cart->add_fee(__($extra_fee_option_label, 'woocommerce'), $extra_fee_option_cost, $extra_fee_option_taxable);
                    }
                } else {
                    $woocommerce->cart->add_fee(__($extra_fee_option_label, 'woocommerce'), $extra_fee_option_cost, $extra_fee_option_taxable);
                }
            }
        }
    }
}

add_action('plugins_loaded', 'liqpay_load_languages');

function liqpay_load_languages()
{
    load_plugin_textdomain('liqpay', false, dirname(plugin_basename(__FILE__)) . '/language');
}

function get_exchange_rate()
{
    $url = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3';

    $res = liq_file_get_contents_curl($url);

    $currency_data = json_decode($res, true);
    $rates = array();

    if (count($currency_data) > 0) {
        foreach ($currency_data as $c) {
            if (($c['base_ccy'] == 'UAH') && (($c['ccy'] == 'USD') || ($c['ccy'] == 'EUR') || ($c['ccy'] == 'RUR'))) {
                $rates[$c['ccy']]['sale'] = floatval($c['sale']);
                $rates[$c['ccy']]['buy'] = floatval($c['buy']);
            }
        }
    }

    return $rates;

}

function liq_file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}


if (!wp_next_scheduled('liqpay_currency_exchange')) {
    wp_schedule_event(time(), 'hourly', 'liqpay_currency_exchange');
}


add_action('liqpay_currency_exchange', 'liqpay_currency_exchange_function');

function liqpay_currency_exchange_function()
{
    $rete = get_exchange_rate();

    if (get_option('liqpay_converter_type') == 'privatb') {
        update_option('liqpay_exc_b_USD', $rete['USD']['buy']);
        update_option('liqpay_exc_s_USD', $rete['USD']['sale']);
        update_option('liqpay_exc_b_EUR', $rete['EUR']['buy']);
        update_option('liqpay_exc_s_EUR', $rete['EUR']['sale']);
        update_option('liqpay_exc_b_RUB', $rete['RUR']['buy']);
        update_option('liqpay_exc_s_RUB', $rete['RUR']['sale']);

    } else {
        wp_clear_scheduled_hook('liqpay_currency_exchange');
    }

    $translation_array = array(
        'liqpay_exc_b_USD' => get_option('liqpay_exc_b_USD'),
        'liqpay_exc_s_USD' => get_option('liqpay_exc_s_USD'),
        'liqpay_exc_b_EUR' => get_option('liqpay_exc_b_EUR'),
        'liqpay_exc_s_EUR' => get_option('liqpay_exc_s_EUR'),
        'liqpay_exc_b_RUB' => get_option('liqpay_exc_b_RUB'),
        'liqpay_exc_s_RUB' => get_option('liqpay_exc_s_RUB'),
    );
    wp_localize_script('jquery', 'liqpay_form_script', $translation_array);

}




include "skidki.php";

?>