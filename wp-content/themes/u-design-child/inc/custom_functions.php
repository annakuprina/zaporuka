<?php
function shortcode_milestones(){
    $post = get_post();
    $post_id = $post->ID;
    $value = get_field( "milestones", $post_id );
    $total_collected = (int) get_field("total-collected", $post_id);
    $total_amount = (int) get_field("total-amount", $post_id);
    $last_to_collect = $total_amount - $total_collected;
    $milestone_name_active = '';
    $i = 0;
    foreach ($value as $item) {
        $finished = ( $total_collected  >= (int) $item["milestone-amount"] ) ? 'finished' : '';
        if ( empty($finished) ){
            $milestone_name_active = $item["milestone-name"];
            break;
        }
    }
    ob_start(); ?>
    <div class="milestones_tabs proj-timeline">
        <!-- Top part: heared and orange right banner  -->
        <div class="proj-timeline-top">
            <h2 class="h2-header-line">Таймлайн проекту</h2>
            <div class="proj-timeline-info">
                <div class="proj-timeline-info-left">
                    <p class="left-to-collect-text">Залишилось  зiбрати:</p>
                    <p class="left-to-collect-wrapper">
                        <span class="left-to-collect-amount"><?php echo $last_to_collect; ?> </span>
                        <span>грн.</span>
                    </p>
                </div><!-- end proj-timeline-info-left -->
                <div class="proj-timeline-info-right">
                    <a href="#" class="proj-timeline-help">
                        <span class="proj-timeline-help-text">Допомогти</span>
                    </a>
                    <a href="#" class="proj-timeline-share">
                        <span class="proj-timeline-share-text">Поширити у</span>
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                </div><!-- end proj-timeline-info-right -->
            </div><!-- end proj-timeline-info -->
        </div><!-- end proj-timeline-top -->

        <div class="proj-timeline-steps">
            <?php foreach ($value as $item) {
                $i++;
                $progress_bar = '100';
                $inprogress = ( $total_collected  < (int) $item["milestone-amount"] ) ? 'in-progress' : '';
                $finished = ( $total_collected  >= (int) $item["milestone-amount"] ) ? 'finished' : '';
                $milestone_tasks_done = $item["milestone_tasks_done"];
                $milestone_tasks_undone = $item["milestone_tasks_undone"];
                if ( !empty($finished) ){
                    $class = $finished;
                } else{
                    $class = $inprogress;
                }
                if ( $item["milestone-name"] != $milestone_name_active && $class==$inprogress ){
                    $class='';
                }
                if ( $item["milestone-name"] == $milestone_name_active){
                    $active_tab = 'active';
                    $progress_bar = (int) $total_collected * 100 / (int) $item["milestone-amount"];
                } else{
                    $active_tab = '';
                }
            ?>
                <!-- ONE STEP -->
                <div class="proj-timeline-one-step <?php echo $class; ?> one-tab-link" data-id="<?php echo $i; ?>">
                    <!-- Hidden  timeline for mob version-->
                    <div class="one-step-timeline-mob">
                        <p class="one-step-timeline-inner"></p>
                    </div>
                    <div class="one-step-timeline-wrapper tabs_caption <?php echo $active_tab; ?>">
                        <div class="one-step-title"><?php echo $item["milestone-name"]; ?></div>
                        <!-- Timeline for desktop vesrion -->
                        <div class="one-step-timeline">
                            <p class="one-step-timeline-inner " style="width: <?php echo $progress_bar; ?>%"></p>
                        </div>
                        <div class="one-step-money">
                            <?php if ( $class == 'in-progress' ) { ?>
                                <span class="one-step-money-text">Залишилось</span>
                                <span class="money-left-to-collect"> <?php echo $total_collected; ?></span>
                                <span class="one-step-money-text">з</span>
                            <?php } ?>
                            <span class="project-total-cost"><?php echo $item["milestone-amount"]; ?></span>
                            <span>грн.</span>
                        </div><!-- end one-step-money -->
                    </div><!-- end one-step-timeline-wrapper -->
                </div><!-- end proj-timeline-one-step -->
            <?php } ?>
        </div><!-- end proj-timeline-steps -->
        <div class="proj-milestone-desc-block">
            <?php $i = 0; ?>
            <?php foreach ($value as $item) {
                $i++;
                if ( $item["milestone-name"] == $milestone_name_active){
                    $active_tab = 'active';
                } else{
                    $active_tab = '';
                }

                ?>
                <div class="proj-milestone-desc-text tabs_content <?php echo $active_tab; ?>" data-id="<?php echo $i; ?>">
                    <div class="milestone-desc-wrapper">
                        <div class="text_block left_columns_description">
                            <h3><?php echo $item["milestone-name"]; ?></h3>
                            <div class="milestone_desc_text"><?php echo $item["milestone-description"]; ?></div>
                        </div>
                        <div class="text_block right_columns_description">
                            <h3><?php echo $item["title-for-tasks"]; ?></h3>
                            <div class="milestone_task_list">
                                <ul>
                                    <?php foreach ($milestone_tasks_done as $task) { ?>
                                        <li><?php echo $task["task_done"]; ?></li>
                                    <?php } ?>
                                </ul>
                                <ul>
                                    <?php foreach ($milestone_tasks_undone as $task) { ?>
                                        <li><?php echo $task["task_undone"]; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('project_milestones', 'shortcode_milestones');

function shortcode_project_banner(){
    $post = get_post();
    $post_id = $post->ID;
    $total_collected = (int) get_field("total-collected", $post_id);
    $total_amount = (int) get_field("total-amount", $post_id);
    $progress_bar = (int) $total_collected * 100 / (int) $total_amount;

    ob_start();
    ?>
    <!-- ONE PROJECT BANNER -->
    <div class="one-project-banner">
        <div class="one-project-banner-image">
            <img src="<?php echo get_the_post_thumbnail_url($post_id, 'full'); ?>">
        </div>
        <div class="container_24 container_24-project-page" id="content-container">
            <div class="one-project-banner-inner">
                <div class="one-project-title">Проекти</div>
                <div class="one-project-info">
                    <p class="one-project-info-title">
                        <?php echo $post->post_title; ?>
                    </p>
                    <p class="one-project-info-text">
                        <?php echo $post->post_excerpt; ?>
                    </p>
                </div>
                <div class="one-project-progress">
                    <div class="one-project-progress-top">
                        <p class="project-money">
                            <span class="project-money-quantity"><span class="project-money-quantity-inner"><?php echo $total_collected; ?></span><span> грн.</span></span>
                            <span class="project-money-involved">залучено</span>
                        </p>
                        <p class="project-money-collected"><span class="project-money-collected-inner"><?php echo $total_amount; ?></span><span> грн.</span></p>
                    </div>
                    <div class="one-project-progress-bottom">
                        <div class="progress-bar">
                            <span class="progress-done" style="width: <?php echo $progress_bar; ?>%;"></span>
                            <span class="progress-dot"></span>
                        </div>
                    </div>
                </div>
                <div class="help-and-share">
                    <p class="help-link">
                        <a href="#" class="one-project-help">
                            <span>Допомогти</span>
                        </a>
                    </p>
                    <a href="#" class="share">
                        <span class="one-project-share">Подiлитися</span>
                        <span class="one-project-socials">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </span>
                    </a>
                </div><!-- end help-and-share -->
            </div><!-- end one-project-right -->
        </div>
    </div><!-- end one-project-banner -->
<?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('project_banner', 'shortcode_project_banner');

function shortcode_orange_help_form(){
    $options = get_option('ThemeOptions');
    $become_partner = !empty($options['become_partner_' . ICL_LANGUAGE_CODE]) ? $options['become_partner_' . ICL_LANGUAGE_CODE] : false;
    $become_partner_hover = !empty($options['become_partner_hover_' . ICL_LANGUAGE_CODE]) ? $options['become_partner_hover_' . ICL_LANGUAGE_CODE] : false;
    $become_partner_hover_link_text = !empty($options['become_partner_hover_link_text_' . ICL_LANGUAGE_CODE]) ? $options['become_partner_hover_link_text_' . ICL_LANGUAGE_CODE] : false;
    $become_partner_hover_link = !empty($options['become_partner_hover_link_' . ICL_LANGUAGE_CODE]) ? $options['become_partner_hover_link_' . ICL_LANGUAGE_CODE] : false;

    $become_volunteer = !empty($options['become_volunteer_' . ICL_LANGUAGE_CODE]) ? $options['become_volunteer_' . ICL_LANGUAGE_CODE] : false;
    $become_volunteer_hover = !empty($options['become_volunteer_hover_' . ICL_LANGUAGE_CODE]) ? $options['become_volunteer_hover_' . ICL_LANGUAGE_CODE] : false;
    $become_volunteer_hover_link_text = !empty($options['become_volunteer_hover_link_text_' . ICL_LANGUAGE_CODE]) ? $options['become_volunteer_hover_link_text_' . ICL_LANGUAGE_CODE] : false;
    $become_volunteer_hover_link = !empty($options['become_volunteer_hover_link_' . ICL_LANGUAGE_CODE]) ? $options['become_volunteer_hover_link_' . ICL_LANGUAGE_CODE] : false;

    $help_by_sms = !empty($options['help_by_sms_' . ICL_LANGUAGE_CODE]) ? $options['help_by_sms_' . ICL_LANGUAGE_CODE] : false;
    $help_by_sms_hover = !empty($options['help_by_sms_hover_' . ICL_LANGUAGE_CODE]) ? $options['help_by_sms_hover_' . ICL_LANGUAGE_CODE] : false;
    $help_by_sms_hover_text_link = !empty($options['help_by_sms_hover_text_link_' . ICL_LANGUAGE_CODE]) ? $options['help_by_sms_hover_text_link_' . ICL_LANGUAGE_CODE] : false;

    $charity_shop = !empty($options['charity_shop_' . ICL_LANGUAGE_CODE]) ? $options['charity_shop_' . ICL_LANGUAGE_CODE] : false;
    $charity_shop_hover = !empty($options['charity_shop_hover_' . ICL_LANGUAGE_CODE]) ? $options['charity_shop_hover_' . ICL_LANGUAGE_CODE] : false;
    $charity_shop_hover_link_text = !empty($options['charity_shop_hover_link_text_' . ICL_LANGUAGE_CODE]) ? $options['charity_shop_hover_link_text_' . ICL_LANGUAGE_CODE] : false;
    $charity_shop_hover_link = !empty($options['charity_shop_hover_link_' . ICL_LANGUAGE_CODE]) ? $options['charity_shop_hover_link_' . ICL_LANGUAGE_CODE] : false;

    ob_start();
?>

    <!---------HELP(orange blocks and contact form)---------->
    <div class="help">
        <div class="help-left">
            <?php echo do_shortcode('[help_form]');?>
        </div><!-- end of help-left -->
        <div class="help-right">
			<!-- One square -->
			<div class="help-item">
				<div class="help-item-title"><?php echo $become_partner; ?></div>
				<div class="help-item-info">
					<div class="help-item-deskr"><?php echo $become_partner_hover; ?></div>
					<a href="<?php echo $become_partner_hover_link; ?>" class="help-item-link"><?php echo $become_partner_hover_link_text; ?></a>
				</div>
			</div><!-- end help-item -->

			<!-- One square -->
			<div class="help-item">
				<div class="help-item-title"><?php echo $become_volunteer; ?></div>
				<div class="help-item-info">
					<div class="help-item-deskr"><?php echo $become_volunteer_hover; ?></div>
					<a href="<?php echo $become_volunteer_hover_link; ?>" class="help-item-link"><?php echo $become_volunteer_hover_link_text; ?></a>
				</div>
			</div><!-- end help-item -->

			<!-- One square -->
			<div class="help-item">
				<div class="help-item-title"><?php echo $help_by_sms; ?></div>
				<div class="help-item-info">
					<div class="help-item-deskr"><?php echo $help_by_sms_hover; ?></div>
					<a href="#" class="help-item-link sms-popup-show"><?php echo $help_by_sms_hover_text_link; ?></a>
				</div>
			</div><!-- end help-item -->

			<!-- One square -->
			<div class="help-item">
				<div class="help-item-title"><?php echo $charity_shop; ?></div>
				<div class="help-item-info">
					<div class="help-item-deskr"><?php echo $charity_shop_hover; ?></div>
					<a href="<?php echo $charity_shop_hover_link; ?>" class="help-item-link"><?php echo $charity_shop_hover_link_text; ?></a>
				</div>
			</div><!-- end help-item -->

        </div><!-- end of help-right -->
    </div><!-- end of help -->
    <?php
    $html = ob_get_clean();
    return $html;

}
add_shortcode('zaporuka_help_form', 'shortcode_orange_help_form');

add_filter( 'vc_grid_item_shortcodes', 'my_module_add_grid_shortcodes' );
function my_module_add_grid_shortcodes( $shortcodes ) {
    $shortcodes['vc_custom_post_meta'] = array(
        'name' => __( 'Custom timeline', 'my-text-domain' ),
        'base' => 'vc_custom_post_meta',
        'category' => __( 'Content', 'my-text-domain' ),
        'description' => __( 'Show custom post meta', 'my-text-domain' ),
        'post_type' => Vc_Grid_Item_Editor::postType(),
    );

    return $shortcodes;
}
// output function
add_shortcode( 'vc_custom_post_meta', 'vc_custom_post_meta_render' );
function vc_custom_post_meta_render() {

    $total_collected_timeline = "{{ post_meta_value:total-collected }}";
    $total_amount_timeline = '{{ post_data:total-amount }}';
    //var_dump("{{ custom_meta }}");
    ob_start();
    ?>
    <div class="one-project-progress-wrapper">
        <div>
            <span class="project-money-involved">залучено</span>
        </div>
        <div class="one-project-progress">
            <div class="one-project-progress-top">
                <p class="project-money">
                    <span class="project-money-quantity"><span class="project-money-quantity-inner"><?php echo $total_collected_timeline; ?></span><span> грн.</span></span>
                </p>
                <p class="project-money-collected"><span class="project-money-collected-inner"><?php echo $total_amount_timeline; ?></span><span> грн.</span></p>
            </div>
            <div class="one-project-progress-bottom">
                <div class="progress-bar">
                    <span class="progress-done"></span>
                    <span class="progress-dot"></span>
                </div>
            </div>
        </div>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}

add_filter( 'vc_gitem_template_attribute_custom_meta', 'vc_gitem_template_attribute_custom_meta ', 10, 3 );
function vc_gitem_template_attribute_custom_meta( $value, $data ) {
    /**
     * @var Wp_Post $post
     * @var string $data
     */
    extract( array_merge( array(
        'post' => null,
        'data' => '',
    ), $data ) );

    return var_export( get_post_meta( $post->ID, 'total-collected' ), true );
}

function zaporuka_photo_video_doc(){
    $post = get_post();
    $post_id = $post->ID;
    $project_photos = get_field( "project-photos", $post_id );
    $project_videos = get_field( "project-videos", $post_id );
    $project_docs = get_field( "project-documents", $post_id );

    ob_start();
    ?>
    <!----------------------------------
	PHOTO, VIDEO, DOCUMENTS SLIDERS
----------------------------------->
    <!-- TABS -->

    <div class="sliders-tabs">
        <div class="sliders-tabs-wrapper">
            <div class="one-tab-link tab-active" data-id="1">
                Фотографiї
            </div>
            <div class="one-tab-link" data-id="2">
                Вiдео
            </div>
            <div class="one-tab-link" data-id="3">
                Супутнi документи
            </div>
        </div>
        <div class="proj-milestone-desc-block">
            <div class="slider_tabs_content photo_tab_content active" data-id="1">
                <!-- PHOTO SLIDER -->
                <div class="photo-slider slick-media-slider" >
                    <?php foreach ($project_photos as $item) { ?>
                        <div class="photo-slide">
                            <img src="<?php echo $item["photo"]["url"]; ?>" />
                        </div>
                    <?php } ?>
                </div><!--end photo-slider-->
            </div>
            <div class="slider_tabs_content video_tab_content" data-id="2">
                <!-- VIDEO SLIDER -->
                <div class="video-slider slick-media-slider">
                    <?php foreach ($project_videos as $item) { ?>
                        <div>
                            <a href="<?php echo $item["video-link"];?>" target="_blank" class="thumbnail">
                                <p class="video-slider-img-wrapper">
                                    <img src="<?php echo $item["image-for-video"]["url"]; ?>" />
                                    <span class="play-video-icon"></span>
                                </p>
                            </a>
                            <p class="video-slider-text"><?php echo $item["description"];?></p>
                        </div>
                    <?php } ?>
                </div><!--end video-slider-->
            </div>
            <div class="slider_tabs_content document_tab_content" data-id="3">
                <!-- DOCUMENTS SLIDER -->
                <div class="documents-slider slick-media-slider">
                    <?php foreach ($project_docs as $item) { ?>
                        <div class="documents-slide">
                            <img src="<?php echo $item["document"]["url"];?>">
                        </div>
                    <?php } ?>
                </div><!--end documents-slider-->
            </div>
        </div>
    </div><!-- end sliders-tabs -->
    <?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode( 'zaporuka_photo_video_doc', 'zaporuka_photo_video_doc' );

add_filter( 'vc_grid_item_shortcodes', 'my_module_add_grid_content_shortcodes' );
function my_module_add_grid_content_shortcodes( $shortcodes ) {
    $shortcodes['vc_post_id'] = array(
        'name' => __( 'Post content', 'fluidtopics' ),
        'base' => 'vc_post_content',
        'category' => __( 'Content', 'fluidtopics' ),
        'description' => __( 'Show current post content', 'fluidtopics' ),
        'post_type' => Vc_Grid_Item_Editor::postType(),
    );

    return $shortcodes;
}

add_shortcode( 'vc_post_content', 'vc_post_content_render' );
function vc_post_content_render() {
    $html = "<div class='reviews-item-content'>" . '{{ post_data:post_content }}' . "</div>";
    return $html;
}

add_filter( 'vc_grid_item_shortcodes', 'my_module_add_grid_testimonials_shortcodes' );
function my_module_add_grid_testimonials_shortcodes( $shortcodes ) {
    $shortcodes['vc_post_id'] = array(
        'name' => __( ' Custom Testimonials', 'fluidtopics' ),
        'base' => 'vc_testimonials_content',
        'category' => __( 'Content', 'fluidtopics' )
    );

    return $shortcodes;
}


class custom_reviews_class extends WPBakeryShortCode {
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'custom_reviews_mapping' ) );
        add_shortcode( 'vc_testimonials_content', array( $this, 'vc_testimonials_content' ) );
    }
    // Element Mapping
    public function custom_reviews_mapping() {
//			 Map the block with vc_map()
        vc_map( array(
            'name' => __( ' Custom Testimonials', 'fluidtopics' ),
            'base' => 'vc_testimonials_content',
            'category' => __( 'Content', 'fluidtopics' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'param_name' => 'special_class',
                    'heading' => esc_html__( 'Special class', 'fluidtopics' ),
                    'value' => '',
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'Custom Group',
                ),
            )
        ));
    }
    // Element HTML
    public function vc_testimonials_content( $atts )
    {
        WPBMap::addAllMappedShortcodes();
        /**
         * @var string $special_class
         */
        extract(shortcode_atts(array(
            'special_class' => '',
        ), $atts));
        ob_start();

        $new_query = new WP_Query();
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;;
        $new_query->query('post_type=reviews&showposts=2'.'&paged='.$paged);

        ob_start();
        ?>
        <!------------
            REVIEWS
         ------------->
        <div class="reviews-block <?php echo $special_class; ?>">

            <div class="reviews-wrapper">
                <?php
                while ($new_query->have_posts()) : $new_query->the_post();
                    $post_id = get_the_ID();
                    $name =  get_field('client_name',$post_id);
                    $region = get_field('region',$post_id);
                    ?>
                    <div class="reviews-item">
                        <div class="reviews-item-title">
                            <p><?php echo $name; ?></p>
                            <p> <?php echo $region; ?></p>
                        </div>
                        <div class="reviews-item-text">
                            <?php the_content(); ?>
                        </div><!-- end reviews-item-text -->
                    </div><!-- end reviews-item -->
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div><!-- end reviews-wrapper -->
            <!--        <div class="pagination-block">-->
            <!--        </div>-->
<!--            <div class="pagination">-->
<!--                --><?php //previous_posts_link('&raquo;') ?>
<!--                --><?php //next_posts_link('&laquo;', $new_query->max_num_pages) ?>
<!--            </div>-->
            <?php kama_pagenavi(); ?>
        </div>
            <?php


        $html = ob_get_clean();
        return $html;
    }
}
$custom_reviews_class = new custom_reviews_class;


/**
 * Альтернатива wp_pagenavi. Создает ссылки пагинации на страницах архивов.
 *
 * @param array  $args      Аргументы функции
 * @param object $wp_query  Объект WP_Query на основе которого строится пагинация. По умолчанию глобальная переменная $wp_query
 */
function kama_pagenavi( $args = array(), $wp_query = null ){

    // параметры по умолчанию
    $default = array(
        'before'          => '',   // Текст до навигации.
        'after'           => '',   // Текст после навигации.
        'echo'            => true, // Возвращать или выводить результат.

        'text_num_page'   => '',           // Текст перед пагинацией.
        // {current} - текущая.
        // {last} - последняя (пр: 'Страница {current} из {last}' получим: "Страница 4 из 60").
        'num_pages'       => 6,           // Сколько ссылок показывать.
        'step_link'       => 6,          // Промежуточный текст "после".
        'back_text'       => '< ',    // Текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
        'next_text'       => ' >',   // Текст "перейти на следующую страницу".  Ставим 0, если эта ссылка не нужна.
        'first_page_text' => '|< ', // Текст "к первой странице".    Ставим 0, если вместо текста нужно показать номер страницы.
        'last_page_text'  => ' <|',  // Текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.
    );

    // Cовместимость с v2.5: kama_pagenavi( $before = '', $after = '', $echo = true, $args = array() )
    if( ($fargs = func_get_args()) && is_string( $fargs[0] ) ){
        $default['before'] = isset($fargs[0]) ? $fargs[0] : '';
        $default['after']  = isset($fargs[1]) ? $fargs[1] : '';
        $default['echo']   = isset($fargs[2]) ? $fargs[2] : true;
        $args              = isset($fargs[3]) ? $fargs[3] : array();
        $wp_query = $GLOBALS['wp_query']; // после определения $default!
    }

    if( ! $wp_query ){
        wp_reset_query();
        global $wp_query;
    }

    if( ! $args ) $args = array();
    if( $args instanceof WP_Query ){
        $wp_query = $args;
        $args     = array();
    }

    $default = apply_filters( 'kama_pagenavi_args', $default ); // чтобы можно было установить свои значения по умолчанию

    $rg = (object) array_merge( $default, $args );

    //$posts_per_page = (int) $wp_query->get('posts_per_page');
    $paged          = (int) $wp_query->get('paged');
    $max_page       = $wp_query->max_num_pages;

    // проверка на надобность в навигации
    if( $max_page <= 1 )
        return false;

    if( empty( $paged ) || $paged == 0 )
        $paged = 1;

    $pages_to_show = intval( $rg->num_pages );
    $pages_to_show_minus_1 = $pages_to_show-1;

    $half_page_start = floor( $pages_to_show_minus_1/2 ); // сколько ссылок до текущей страницы
    $half_page_end   = ceil(  $pages_to_show_minus_1/2 ); // сколько ссылок после текущей страницы

    $start_page = $paged - $half_page_start; // первая страница
    $end_page   = $paged + $half_page_end;   // последняя страница (условно)

    if( $start_page <= 0 )
        $start_page = 1;
    if( ($end_page - $start_page) != $pages_to_show_minus_1 )
        $end_page = $start_page + $pages_to_show_minus_1;
    if( $end_page > $max_page ) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = (int) $max_page;
    }

    if( $start_page <= 0 )
        $start_page = 1;

    // создаем базу чтобы вызвать get_pagenum_link один раз
    $link_base = str_replace( 99999999, '___', get_pagenum_link( 99999999 ) );
    $first_url = get_pagenum_link( 1 );
    if( false === strpos( $first_url, '?') )
        $first_url = user_trailingslashit( $first_url );

    // собираем елементы
    $els = array();

    if( $rg->text_num_page ){
        $rg->text_num_page = preg_replace( '!{current}|{last}!', '%s', $rg->text_num_page );
        $els['pages'] = sprintf( '<span class="pages">'. $rg->text_num_page .'</span>', $paged, $max_page );
    }
    // назад
    if ( $rg->back_text && $paged != 1 )
        $els['prev'] = '<a class="prev" href="'. ( ($paged-6)==1 ? $first_url : str_replace( '___', ($paged-6), $link_base ) ) .'">'. $rg->back_text .'</a>';
    // в начало
    if ( $start_page >= 2 && $pages_to_show < $max_page ) {
        $els['first'] = '<a class="first" href="'. $first_url .'">'. ( $rg->first_page_text ?: 1 ) .'</a>';
        if( $rg->dotright_text && $start_page != 2 )
            $els[] = '<span class="extend">'. $rg->dotright_text .'</span>';
    }
    // пагинация
    for( $i = $start_page; $i <= $end_page; $i++ ) {
        if( $i == $paged )
            $els['current'] = '<span class="current">'. $i .'</span>';
        elseif( $i == 1 )
            $els[] = '<a href="'. $first_url .'">1</a>';
        else
            $els[] = '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a>';
    }

    // ссылки с шагом
    $dd = 0;
    if ( $rg->step_link && $end_page < $max_page ){
        for( $i = $end_page + 1; $i <= $max_page; $i++ ){
            if( $i % $rg->step_link == 0 && $i !== $rg->num_pages ) {
                if ( ++$dd == 1 )
                    $els[] = '<span class="extend">'. $rg->dotright_text2 .'</span>';
                $els[] = '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a>';
            }
        }
    }
    // в конец
    if ( $end_page < $max_page ) {
        if( $rg->dotright_text && $end_page != ($max_page-1) )
            $els[] = '<span class="extend">'. $rg->dotright_text2 .'</span>';
        $els['last'] = '<a class="last" href="'. str_replace( '___', $max_page, $link_base ) .'">'. ( $rg->last_page_text ?: $max_page ) .'</a>';
    }
    // вперед
    if ( $rg->next_text && $paged != $end_page )
        $els['next'] = '<a class="next" href="'. str_replace( '___', ($paged+6), $link_base ) .'">'. $rg->next_text .'</a>';

    $els = apply_filters( 'kama_pagenavi_elements', $els );

    $out = $rg->before . '<div class="wp-pagenavi">'. implode( ' ', $els ) .'</div>'. $rg->after;

    $out = apply_filters( 'kama_pagenavi', $out );

    if( $rg->echo ) echo $out;
    else return $out;
}
