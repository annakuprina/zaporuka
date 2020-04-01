<?php
/**
 * Theme functions and definitions.
 *
 * @package WordPress
 * @subpackage U-Design
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }
define( 'CHILD_DIR', get_stylesheet_directory_uri() );
define("THEME_DIR", get_stylesheet_directory());
define("THEME_INCLUDES", THEME_DIR . "/inc");
/**
 * Right-to-left (RTL) Support.
 * Determines whether the current locale is right-to-left (RTL).
 * If yes then load the parent rtl.css file.
 * 
 */
function udesign_child_theme_styles() {
    // Load the rtl.css stylesheet.
    if ( is_rtl() ) {
        wp_enqueue_style( 'u-design-rtl', trailingslashit( get_template_directory_uri() ) . 'rtl.css' );
    }    
    wp_enqueue_style( 'slick', CHILD_DIR . '/assets/slick/slick.css' );
    wp_enqueue_style( 'slick-lightbox-css', CHILD_DIR . '/assets/slick/slick-lightbox.css' );
    wp_enqueue_style( 'slick-theme', CHILD_DIR . '/assets/slick/slick-theme.css' );
    wp_enqueue_style( 'main', CHILD_DIR . '/assets/css/main.css' );
    wp_enqueue_style( 'reset-child', CHILD_DIR . '/assets/css/reset.css' );
    wp_enqueue_style( 'anna-child', CHILD_DIR . '/assets/css/anna.css' );
    wp_enqueue_style( 'yana-child', CHILD_DIR . '/assets/css/yana.css' );    
    wp_enqueue_style( 'animate-child', CHILD_DIR . '/assets/css/animate.min.css' );
    wp_enqueue_script( 'validate-js', CHILD_DIR . '/assets/js/jquery.validate.min.js' );
    wp_enqueue_script( 'slick-js', CHILD_DIR . '/assets/slick/slick.min.js' );
    wp_enqueue_script( 'slick-lightbox-js', CHILD_DIR . '/assets/slick/slick-lightbox.min.js' );
    wp_enqueue_script( 'wow-js', CHILD_DIR . '/assets/js/wow.min.js' );

    wp_enqueue_script( 'main-js', CHILD_DIR . '/assets/js/main.js' );
    wp_register_script( 'yana-js', CHILD_DIR . '/assets/js/custom_scrypt_yana.js' );
    wp_localize_script( 'yana-js', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    wp_enqueue_script('yana-js');

    wp_register_script( 'anya-js', CHILD_DIR . '/assets/js/custom_scrypt_anya.js' );
    wp_localize_script( 'anya-js', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )) );
    wp_enqueue_script('anya-js');

    wp_enqueue_script( 'jquery-ui-js', CHILD_DIR . '/assets/js/jquery-ui.min.js' );

}
add_action( 'wp_enqueue_scripts', 'udesign_child_theme_styles', 99 );

function udesign_child_theme_admin_styles() {
    wp_enqueue_style( 'fooTables-css', CHILD_DIR . '/assets/css/dataTables/datatables.min.css' );
    wp_enqueue_script( 'fooTables-js',  CHILD_DIR . '/assets/js/dataTables/datatables.min.js' );
    wp_enqueue_script( 'custom-admin-js',  CHILD_DIR . '/assets/js/custom_admin.js' );
}
add_action( 'admin_enqueue_scripts', 'udesign_child_theme_admin_styles', 99);

/***************** BEGIN ADDING YOUR CODE BELOW: *****************/

// Add category metabox to page
function voras_category_for_page() {    
    register_taxonomy_for_object_type('category', 'page');  
}
add_action( 'init', 'voras_category_for_page' );
 if( is_admin() ){
     /**
     * Theme options.
     */
     require_once THEME_INCLUDES . '/options/theme-options.php';
 }
require_once THEME_INCLUDES . '/shortcodes.php';
require_once THEME_INCLUDES . '/custom_functions.php';
require_once THEME_INCLUDES . '/custom_ajax.php';
require_once THEME_INCLUDES . '/api.php';

// Secondary navigation bar.

// Insert Secondary Navigation bar at the very top.
add_action( 'udesign_top_wrapper_top', 'udesign_add_secondary_navigation_bar_custom', 10);
function udesign_add_secondary_navigation_bar_custom() {
    $options = get_option('ThemeOptions');
    $phone_number = !empty($options['main_phone_number']) ? $options['main_phone_number'] : false;
    $email = !empty($options['main_email']) ? $options['main_email'] : false;
    $help_with_sms_label = !empty($options['popup_sms_title_' . ICL_LANGUAGE_CODE]) ? $options['popup_sms_title_' . ICL_LANGUAGE_CODE] : false;
    ?>
    <nav id="custom-top-bar">
        <div class="container_24">
            <div id="custom-top-bar-content">
                <div class="custom-top-bar-content-left">
                    <div class="top-bar-tel-block"><a href="tel:<?php echo $phone_number; ?>" class="tel-block-a"><i class="fa fa-phone" aria-hidden="true"></i></i><?php echo $phone_number; ?></a></div>
                    <div class="top-bar-email-block"><a href="mailto:<?php echo $email; ?>" class="email-block-a"><i class="top-bar-mail-icon"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 10 7"><g><g opacity=".4"><path fill="#333" d="M1.55 1.195L4.646 4.23c.193.19.509.19.703 0l3.101-3.035a.25.25 0 1 1 .352.356L6.773 3.539l2.024 1.902a.25.25 0 0 1-.344.364L6.418 3.887l-.719.703a1.01 1.01 0 0 1-1.406 0l-.711-.7-2.035 1.915a.25.25 0 0 1-.344-.364l2.02-1.902-2.024-1.988a.25.25 0 1 1 .352-.356zM0 .75v5.5c0 .415.335.75.75.75h8.5c.415 0 .75-.335.75-.75V.75A.748.748 0 0 0 9.25 0H.75A.748.748 0 0 0 0 .75z"/></g></g></svg></i><?php echo $email; ?></a></div>
                </div>
                <div class="custom-top-bar-content-right">
                    <span class="top-bar-help-block"><a href="#"><?php echo $help_with_sms_label; ?></a></span>
                </div>
            </div>
        </div>
    </nav>
    <div class="clear"></div>
    <?php
}

//add 5 column to footer
register_sidebar(array(
                'name' => esc_html__('Основание 5', 'u-design'),
                'id' => 'bottom-widget-area-5',
                'description' => esc_html__('Область виджета, используемая как 5я колонка в Нижней части (над футером).', 'u-design'),
                'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
                'before_title' => '<h3 class="bottom-col-title">',
                'after_title' => '</h3>',
                'after_widget' => '</div>',
));

//add widget for footer mobile menu
register_sidebar(array(
                'name' => esc_html__('Футер моб левая секция', 'u-design'),
                'id' => 'widget-footer-mob-left',
                'description' => esc_html__('Область виджета, используемая как левая колонка в мобильной версии футера', 'u-design'),
                'before_widget' => '<div class="bottom-col-content %2$s custom-formatting">',
                'before_title' => '<h3 class="bottom-col-title">',
                'after_title' => '</h3>',
                'after_widget' => '</div>',
));

//string translation
add_action('init', function() {
  pll_register_string('u-design-child', 'Таймлайн проекту');
  pll_register_string('u-design-child', 'Залишилось  зiбрати:');
  pll_register_string('u-design-child', 'залучено');
  pll_register_string('u-design-child', 'Допомогти');
  pll_register_string('u-design-child', 'Проекти');
  pll_register_string('u-design-child', 'Поширити у');
  pll_register_string('u-design-child', 'сторiнка з');
  pll_register_string('u-design-child', 'Залишилось');
  pll_register_string('u-design-child', 'з');
  pll_register_string('u-design-child', 'Подiлитися');
  pll_register_string('u-design-child', 'Супутнi документи');
  pll_register_string('u-design-child', 'Вiдео');
  pll_register_string('u-design-child', 'Фотографiї');
  pll_register_string('u-design-child', 'Сума допомоги');
  pll_register_string('u-design-child', 'Завантажити');
  pll_register_string('u-design-child', 'Дивитись вiдео');
  pll_register_string('u-design-child', 'Долучайтесь до БФ Запорука у соцмережах');
  pll_register_string('u-design-child', 'Партнери');
  pll_register_string('u-design-child', 'Партнери та друзі фонду');
  pll_register_string('u-design-child', 'Волонтери');
  pll_register_string('u-design-child', 'Дякуємо за ваше добро!');
  pll_register_string('u-design-child', 'Ви скасували оплату!');
  pll_register_string('u-design-child', 'Выберите год');
  pll_register_string('liqpay_wordpress', 'Звіт по оплаті');
  pll_register_string('liqpay_wordpress', 'Вітаємо!');
  pll_register_string('liqpay_wordpress', 'відхилено');
  pll_register_string('liqpay_wordpress', 'Вибачте але Ваш платіж відхилено');
  pll_register_string('liqpay_wordpress', 'Дата');
  pll_register_string('liqpay_wordpress', 'Номер заказу');
  pll_register_string('liqpay_wordpress', 'Номер транзакції в системе LiqPay');
  pll_register_string('liqpay_wordpress', 'Статус транзакції');
  pll_register_string('liqpay_wordpress', 'Сума');
  pll_register_string('liqpay_wordpress', 'Телефон');
  pll_register_string('liqpay_wordpress', 'успiшна');
  pll_register_string('liqpay_wordpress', 'платіж знаходиться на перевірці');
  pll_register_string('liqpay_wordpress', 'Ваш платіж очікує на перевірку');
  pll_register_string('liqpay_wordpress', 'Если долгое время платеж не проходит, Вам следует обратится в онлайн чат службы поддержки Liqpay, по адресу');
  pll_register_string('liqpay_wordpress', 'Дякуємо за ваше добре серце! Завдяки вам підопічні фонду \'Запорука\' зможуть вчасно отримати необхідну допомогу.');
  pll_register_string('liqpay_wordpress', 'Разом змінюємо світ на краще!');
  pll_register_string('liqpay_wordpress', 'З вдячністю,');
  pll_register_string('liqpay_wordpress', "Благодійний Фонд 'Запорука'");
});

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
    if(ICL_LANGUAGE_CODE=='uk'){
        $symbol =  'грн.';
    }
    elseif(ICL_LANGUAGE_CODE=='ru'){
        $symbol =  'грн.';
    }
    elseif(ICL_LANGUAGE_CODE=='en'){
        $symbol =  '₴';
    }
    switch( $currency ) {
      case 'UAH': $currency_symbol =  $symbol; break;
    }
    return $currency_symbol;
}

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();
    if($woocommerce->cart->cart_contents_count > 0):
    ?>
    <span class="cart-customlocation cart-count"><span class="plus"></span><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></span>
    <?php
    else: ?>
        <span class="cart-customlocation cart-count"></span>
    <?php 
    endif;

    $fragments['span.cart-customlocation.cart-count'] = ob_get_clean();
    return $fragments;
}

/*   Remove zoom effect on WooCommerce product image   */
add_action( 'wp', 'remove_image_zoom_support', 100 );
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}

/* Add custom column "ON home" to post type projects  */
add_filter( 'manage_projects_posts_columns', 'set_custom_projects_columns' );
function set_custom_projects_columns( $columns ) {
  $columns['displayOnHome'] = __( 'На главной' );
  $columns['projects_category'] = __( 'Категорія' );
  return $columns;
}
add_filter( 'manage_novini_posts_columns', 'set_custom_novini_columns' );
function set_custom_novini_columns( $columns ) {
    $columns['news_category'] = __( 'Проект' );
    return $columns;
}

add_filter( 'manage_write_about_us_posts_columns', 'set_custom_write_about_us_columns' );
function set_custom_write_about_us_columns( $columns ) {
    $columns['write_about_category'] = __( 'Категорія' );
    return $columns;
}

add_filter( 'manage_partners_posts_columns', 'set_custom_partners_columns' );
function set_custom_partners_columns( $columns ) {
    $columns['partners_category'] = __( 'Категорія' );
    return $columns;
}

/* Add the data to the custom columns for the book post type:*/
add_action( 'manage_projects_posts_custom_column' , 'set_custom_projects_columns_data', 10, 2 );
function set_custom_projects_columns_data( $column ) {
    global $post;
    if ( 'displayOnHome' === $column ) {
        $display_mark =  get_field("show-on-home-page", $post->ID);
        if ($display_mark[0]=="Да"){
            echo "Да";
        }
        else{
            echo "-";
        }      
    }
    if ( 'projects_category' === $column ) {
        $project_category = wp_get_post_terms($post->ID, 'projects_category',  array("fields" => "names"));
        $count_categories = count($project_category);
        $last_arr_key = array_keys($project_category)[count($project_category)-1];

        if ( $count_categories > 1 ){
            for ($i=0; $i < $count_categories; ++$i){
                if ( $i != $last_arr_key){
                    echo $project_category[$i] . ', ';
                } else{
                    echo $project_category[$i];
                }
            }
        } else{
            echo $project_category[0];
        }
    }
}

add_action( 'manage_novini_posts_custom_column' , 'set_custom_novini_columns_data', 10, 2 );
function set_custom_novini_columns_data( $column ) {
    global $post;
    if ( 'news_category' === $column ) {
        $project_category = wp_get_post_terms($post->ID, 'news_category',  array("fields" => "names"));
        $count_categories = count($project_category);
        $last_arr_key = array_keys($project_category)[count($project_category)-1];

        if ( $count_categories > 1 ){
            for ($i=0; $i < $count_categories; ++$i){
                if ( $i != $last_arr_key){
                    echo $project_category[$i] . ', ';
                } else{
                    echo $project_category[$i];
                }
            }
        } else{
            echo $project_category[0];
        }
    }
}

add_action( 'manage_write_about_us_posts_custom_column' , 'set_custom_write_about_us_columns_data', 10, 2 );
function set_custom_write_about_us_columns_data( $column ) {
    global $post;
    if ( 'write_about_category' === $column ) {
        $project_category = wp_get_post_terms($post->ID, 'write_about_category',  array("fields" => "names"));
        $count_categories = count($project_category);
        $last_arr_key = array_keys($project_category)[count($project_category)-1];

        if ( $count_categories > 1 ){
            for ($i=0; $i < $count_categories; ++$i){
                if ( $i != $last_arr_key){
                    echo $project_category[$i] . ', ';
                } else{
                    echo $project_category[$i];
                }
            }
        } else{
            echo $project_category[0];
        }
    }
}

add_action( 'manage_partners_posts_custom_column' , 'set_custom_partners_columns_data', 10, 2 );
function set_custom_partners_columns_data( $column ) {
    global $post;
    if ( 'partners_category' === $column ) {
        $project_category = wp_get_post_terms($post->ID, 'partners_category',  array("fields" => "names"));
        $count_categories = count($project_category);
        $last_arr_key = array_keys($project_category)[count($project_category)-1];

        if ( $count_categories > 1 ){
            for ($i=0; $i < $count_categories; ++$i){
                if ( $i != $last_arr_key){
                    echo $project_category[$i] . ', ';
                } else{
                    echo $project_category[$i];
                }
            }
        } else{
            echo $project_category[0];
        }
    }
}

/*  Add languages for  wc ukr shipping*/
add_filter('wc_ukr_shipping_language', function ($lang) {
    if (pll_current_language() === 'uk') {
        return 'uk';
    }
    if (pll_current_language() === 'en') {
        return 'en';
    }
    return 'ua';
});

/*  Add translations for  wc ukr shipping*/
add_filter('wc_ukr_shipping_get_nova_poshta_translates', function ($translates) {
    $currentLanguage = wp_doing_ajax() ? $_COOKIE['pll_language'] : pll_current_language();
  
    if ($currentLanguage === 'ru') {
        return [
            'method_title' => 'Доставка службой Новая почта',
            'block_title' => 'Укажите отделение Новой почты',
            'placeholder_area' => 'Выберите область',
            'placeholder_city' => 'Выберите город',
            'placeholder_warehouse' => 'Выберите отделение',
            'address_title' => 'Нужна адресная доставка?',
            'address_placeholder' => 'Введите адрес доставки'
        ];
    }

    if ($currentLanguage === 'en') {
        return [
            'method_title' => 'Nova Posta',
            'block_title' => 'Enter Nova Posta department',
            'placeholder_area' => 'Select region',
            'placeholder_city' => 'Select City',
            'placeholder_warehouse' => 'Select department',
            'address_title' => 'Need address delivery?',
            'address_placeholder' => 'Enter shipping address'
        ];
    }

    return [
        'method_title' => 'Доставка службою Нова пошта',
        'block_title' => 'Вкажіть відділення Нової пошти',
        'placeholder_area' => 'Оберіть область',
        'placeholder_city' => 'Оберіть місто',
        'placeholder_warehouse' => 'Оберіть відділення',
        'address_title' => 'Потрібна адресна доставка?',
        'address_placeholder' => 'Введіть адресу доставки'
    ];
   
});

/* read only for ACF fields for total-collected field*/
add_filter('acf/load_field/name=total-collected', 'acf_read_only');
function acf_read_only($field) {
    $field['readonly'] = 1;
    return $field;
}

/*  зачисление/списание средств на проект администратором  */
add_action( 'admin_menu', 'register_page_load_money_to_project' );
function register_page_load_money_to_project(){
    add_menu_page( 'Зачислить/списать вручную', 'Зачислить/списать вручную', 'edit_others_posts', 'page_load_money_to_project', 'page_load_money_to_project_function' ); 
}
function page_load_money_to_project_function(){
    $projects_array = get_posts( array(
        'numberposts' => -1,
        'post_type'   => 'projects'
    )); 
?>
    <style>
        .load_money_to_project{
            font-size: 1.1em;
        }
        .load_money_to_project .type_operation_group{
            margin-bottom: 10px;
        }
        .load_money_to_project .type_operation_group legend{
            font-weight: bold;
            margin-bottom: 5px;
        }
        .load_money_to_project .send_load_money_form,
        .load_money_to_project .amount_for_project
        {
            margin-top: 10px;
        }
        .load_money_to_project_wrapper sup{
            font-weight: normal;font-size: 0.8em;
        }
    </style>
    <div class="load_money_to_project_wrapper">
        <h3>Зачислить/списать сумму вручную <br><sup>(зачисление/списание средств автоматически применяется для проектов других языковых версий (список проектов зависит от выбранной языковой опции (все языки или один)))</sup></h3>
        <form action method="POST" class="load_money_to_project">
            <fieldset class="type_operation_group">
                <legend>Выберите вид операции:</legend>
                <label><input type="radio" value="zachislit" name="type_operation" required>Зачислить средства на проект</label><br>
                <label><input type="radio" value="spisat" name="type_operation">Списать сумму с проекта</label>
            </fieldset>
            <select class="project_list_for_load_money" name="project_list_for_load_money" required>
                <option disabled selected value="">Выберите проект</option>
                <?php foreach( $projects_array as $post ){ ?>
                    <option value="<?php echo $post->ID;?>"><?php echo $post->post_title;?></option>
                <?php } ?>
            </select><br>
            <input type="number" name="amount_for_project" class="amount_for_project" value="" placeholder="Введите сумму"><br>
            <input type="submit" name="send_load_money_form" class="button-primary send_load_money_form" value="Отправить">
        </form>
    <div>
<?php
    if (isset($_POST['send_load_money_form'])){
        $post_id = $_POST['project_list_for_load_money'];
        $current_value = get_field( "total-collected", $post_id );
        $total_amount = get_field( "total-amount", $post_id );
        $new_value=0;
        global $wpdb, $table_prefix;
        if( $_POST['type_operation'] == 'zachislit'){
            $new_value = $current_value + $_POST['amount_for_project'];
            $type_operation = 'зачислено';
            if($new_value >= $total_amount){
                $all_posts = $wpdb->get_var( 'SELECT description FROM ' . $wpdb->term_taxonomy . ' WHERE taxonomy = "post_translations" AND description LIKE "%i:' . $post_id . ';%"' );
                $all_ids = unserialize($all_posts);
                $category = get_category_by_slug( 'zaversheni' );
                wp_set_post_categories($all_ids['uk'], array( $category->term_id ));
            }
        }
        else{
            $new_value = $current_value - $_POST['amount_for_project'];
            $type_operation = 'списано';
            if($new_value < $total_amount){
                if(has_category(array('zaversheni', 'zaversheni-ru', 'zaversheni-en'), $post_id)){
                    $all_posts = $wpdb->get_var( 'SELECT description FROM ' . $wpdb->term_taxonomy . ' WHERE taxonomy = "post_translations" AND description LIKE "%i:' . $post_id . ';%"' );
                    $all_ids = unserialize($all_posts);
                    $category = get_category_by_slug( 'dijuchi' );
                    wp_set_post_categories($all_ids['uk'], array( $category->term_id ));
                }
            }
        }
        update_field('total-collected', $new_value , $_POST['project_list_for_load_money']);


        $date_operation = date('Y-m-d H:i:s');
        $admin_email = wp_get_current_user()->user_email;
        $table_liqpay_project_history = $table_prefix . 'liqpay_project_history';
        $sql = "insert into {$table_liqpay_project_history} (`project_id`,`transaction_id`,`order_date`,`users_name`,`users_phone`,`users_email`,`summa`,`type_operation`) values ('" . $post_id . "','" . $post_id . "','" . $date_operation . "','admin','','" . $admin_email . "','" . $_POST['amount_for_project'] . "','" . $type_operation . "')
         on duplicate key update project_id=VALUES(project_id),transaction_id=VALUES(transaction_id),order_date=VALUES(order_date),users_name=VALUES(users_name),users_phone=VALUES(users_phone),users_email=VALUES(users_email),summa=VALUES(summa),type_operation=VALUES(type_operation);";
        $wpdb->query($sql);
        ?>
        <h3 style="color:#00669b;">Проект "<?php echo get_the_title($_POST['project_list_for_load_money']); ?>" был обновлен</h3>
    <?php }
}

add_filter( 'pll_copy_post_metas', 'copy_post_metas' );
function copy_post_metas( $metas ) {
    return array_merge( $metas, array( 'total-collected','total-amount', 'show-on-home-page','current-completed','post_payment_history' ) );
}

function check_currency(){
    if(ICL_LANGUAGE_CODE=='uk'){
        $symbol =  'грн.';
    }
    elseif(ICL_LANGUAGE_CODE=='ru'){
        $symbol =  'грн.';
    }
    elseif(ICL_LANGUAGE_CODE=='en'){
        $symbol =  '₴';
    }
    return $symbol;
}


if (false !== strpos($_SERVER['REQUEST_URI'], '/new-order' )) {
    if(ICL_LANGUAGE_CODE=='uk'){
        $home_url =  '';
    }
    elseif(ICL_LANGUAGE_CODE=='ru'){
        $home_url =  '/ru';
    }
    elseif(ICL_LANGUAGE_CODE=='en'){
        $home_url =  '/en';
    }
    $answer_order_id = $_GET['answer_order_id'];
    wp_safe_redirect($home_url . '/?answer_order_id='. $answer_order_id );
    exit;
}

if ( ! wp_next_scheduled( 'check_liqpay_archive' ) ) {
    wp_schedule_event( strtotime('03:00:00'), 'daily', 'check_liqpay_archive' );
}
// добавляем крон хук
add_action( 'check_liqpay_archive', 'check_liqpay_archive_function' );
function check_liqpay_archive_function() {
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
    if ( ! empty( $res ) ) {
        global $wpdb, $table_prefix;
        $table_liqpay = $table_prefix . 'liqpay';
        $table_liqpay_history = $table_prefix . 'liqpay_project_history';
        if (!isset($wpdb))
            require_once('../../../wp-config.php');
        for ($i=0; $i<count($res->data); ++$i) {
            $sql = "Select * from {$table_liqpay} where transaction_id = {$res->data[$i]->transaction_id}";
            $sql_res = $wpdb->get_results($sql);
            if( empty($sql_res) ) {
                $additional_info = (isset($res->data[$i]->info)) ? unserialize($res->data[$i]->info) : '';
                $order_id = $res->data[$i]->order_id;
                $project_id = (!empty($additional_info)) ? $additional_info['post_id'] : 823;
                $summa = $res->data[$i]->amount;
                $users_email = (!empty($additional_info)) ? $additional_info['user_email'] : '';
                $users_phone = (!empty($additional_info)) ? $additional_info['user_phone'] : '';
                $datas = $res->data[$i]->description;
                $current_value = get_field( "total-collected", $project_id );
                $total_amount = get_field('total-amount', $project_id);
                if ( $current_value >= $total_amount ) {
                    $all_posts = $wpdb->get_var( 'SELECT description FROM ' . $wpdb->term_taxonomy . ' WHERE taxonomy = "post_translations" AND description LIKE "%i:' . $project_id . ';%"' );
                    $all_ids = unserialize($all_posts);
                    $category = get_category_by_slug( 'zaversheni' );
                    wp_set_post_categories($all_ids['uk'], array( $category->term_id ));
                    $project_id = 823;
                    $current_value = get_field( "total-collected", $project_id );
                    $datas = 'Щомісячне перерахування коштів в БФ Запорука';
                    $additional_info = array(
                        'user_phone' => $users_phone,
                        'user_email' => $users_email,
                        'post_id' => $project_id,
                    );
                    $res_update = $liqpay->api("request", array(
                        'action'        => 'subscribe_update',
                        'version'       => '3',
                        'order_id'      => $order_id,
                        'description'   => $datas,
                        'info'          => serialize($additional_info)
                    ));
                }
                $transaction_id = $res->data[$i]->transaction_id;
                $date = date('Y-m-d H:i:s', ($res->data[$i]->create_date / 1000));
                $users_name = $res->data[$i]->sender_first_name;
                $type_operation = 'зачислено';
                $status = 'success';
                $code = 0;
                $valuta = $res->data[$i]->currency;
                $ip = $res->data[$i]->ip;
                $sql = "insert into {$table_liqpay} (`order_id`,`xdate`,`transaction_id`,`status`,`err_code`,`summa`,`valuta`,`sender_phone`,`comments`,`email`,`ip`)
             values ('" . $order_id . "','" . $date . "'," . $transaction_id . ",'" . $status . "','" . $code . "','" . $summa . "','" . $valuta . "','" . $users_phone . "','" . $datas . "','" . $users_email . "','" . $ip . "')
             on duplicate key update order_id=VALUES(order_id),xdate=VALUES(xdate),transaction_id=VALUES(transaction_id),status=VALUES(status),err_code=VALUES(err_code),summa=VALUES(summa),valuta=VALUES(valuta),sender_phone=VALUES(sender_phone),comments=VALUES(comments),email=VALUES(email),ip=VALUES(ip);";
                $wpdb->query($sql);
                $new_value = $current_value + $summa;
                update_field('total-collected', $new_value , $project_id);
                $sql1 = "insert into {$table_liqpay_history} (`project_id`,`transaction_id`,`order_date`,`users_name`,`users_phone`,`users_email`,`summa`,`type_operation`) values ('" . $project_id . "','" . $transaction_id . "','" . $date . "','" . $users_name . "','" . $users_phone . "','" . $users_email . "','" . $summa . "','" . $type_operation . "')
             on duplicate key update project_id=VALUES(project_id),transaction_id=VALUES(transaction_id),order_date=VALUES(order_date),users_name=VALUES(users_name),users_phone=VALUES(users_phone),users_email=VALUES(users_email),summa=VALUES(summa),type_operation=VALUES(type_operation);";
                $wpdb->query($sql1);
            }
        }
    }
}
add_action('init', 'create_post_type_separate_categories');
function create_post_type_separate_categories(){
    register_taxonomy( 'projects_category', 'projects', array( 'hierarchical' => true, 'label' => 'Категорії проекту', 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'write_about_category', 'write_about_us', array( 'hierarchical' => true, 'label' => 'Категорії', 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'partners_category', 'partners', array( 'hierarchical' => true, 'label' => 'Категорії партнерiв', 'query_var' => true, 'rewrite' => true ) );
    register_taxonomy( 'news_category', 'novini', array( 'hierarchical' => true, 'label' => 'Категорії новин', 'query_var' => true, 'rewrite' => true ) );

}
add_action('init', function () {
    foreach (acf_get_field_groups() as $group) {
        $fields = acf_get_fields($group['ID']);
        if (is_array($fields) && count($fields)) {
            foreach ($fields as &$field) {
                pll_register_string('form_field_group'.$group['ID'].'_label_'.$field['name'], $field['label'], 'acf_form_fields');
            }
        }
    }
});

add_filter('acf/prepare_field', function ($field) {
    if (!is_admin()) {
        $field['label'] = pll__($field['label']);
    }
    return $field;
}, 10, 1);
