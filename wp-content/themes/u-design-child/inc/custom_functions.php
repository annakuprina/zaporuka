<?php

add_shortcode('project_milestones', 'shortcode_milestones');
function shortcode_milestones(){
    $post = get_post();
    $post_id = $post->ID;
    $value = get_field( "milestones", $post_id );
    $total_collected = (int) get_field("total-collected", $post_id);
    $total_amount = (int) get_field("total-amount", $post_id);
    $last_to_collect = $total_amount - $total_collected;
    $milestone_name_active = '';
    $symbol = check_currency();
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
            <h2 class="h2-header-line"><?php pll_e( 'Таймлайн проекту');?></h2>
            <div class="proj-timeline-info">
                <div class="proj-timeline-info-left">
                    <p class="left-to-collect-text"><?php pll_e( 'Залишилось  зiбрати:');?></p>
                    <p class="left-to-collect-wrapper">
                        <span class="left-to-collect-amount"><?php echo $last_to_collect; ?> </span>
                        <span><?php echo $symbol; ?></span>
                    </p>
                </div><!-- end proj-timeline-info-left -->
                <div class="proj-timeline-info-right">
                    <a href="#" class="proj-timeline-help">
                        <span class="proj-timeline-help-text"><?php pll_e( 'Допомогти');?></span>
                    </a>

                    <a target="_blank" href="#" onclick='window.open("https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink() ); ?>&p[images][0]=<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>", "myWindow", "status = 1, height = 500, width = 360, resizable = 0" )' class="proj-timeline-share">

                        <span class="proj-timeline-share-text"><?php pll_e( 'Поширити у');?></span>
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                </div><!-- end proj-timeline-info-right -->
            </div><!-- end proj-timeline-info -->
        </div><!-- end proj-timeline-top -->
        <?php if( !empty($value) ) { ?>
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
                                    <span class="one-step-money-text"><?php pll_e( 'Залишилось');?></span>
                                    <span class="money-left-to-collect"> <?php echo $total_collected; ?></span>
                                    <span class="one-step-money-text"><?php pll_e( 'з');?></span>
                                <?php } ?>
                                <span class="project-total-cost"><?php echo $item["milestone-amount"]; ?></span>
                                <span><?php echo $symbol; ?></span>
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
        <?php } ?>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}

add_shortcode('project_banner', 'shortcode_project_banner');
function shortcode_project_banner(){
    $post = get_post();
    $post_id = $post->ID;
    $total_collected = (int) get_field("total-collected", $post_id);
    $total_amount = (int) get_field("total-amount", $post_id);
    $progress_bar = (int) $total_collected * 100 / (int) $total_amount;
    $general_image = get_field("general-project-image", $post_id);
    $symbol = check_currency();
    ob_start();
    ?>
    <!-- ONE PROJECT BANNER -->
    <div class="one-project-banner">
        <div class="one-project-banner-image">
            <?php if(!empty($general_image)) { ?>
                <img src="<?php echo $general_image; ?>">
             <?php } else{ ?>
                <div class="project-banner-without-image"></div>
            <?php } ?>
        </div>
        <div class="container_24 container_24-project-page" id="content-container">
            <div class="one-project-banner-inner">
                <div class="one-project-title"><?php pll_e( 'Проекти');?></div>
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
                        <?php if ($total_collected != 0) { ?>
                            <p class="project-money">
                                <span class="project-money-quantity"><span class="project-money-quantity-inner"><?php echo $total_collected; ?></span><span> <?php echo $symbol; ?></span></span>
                                <span class="project-money-involved"><?php pll_e( 'залучено');?></span>
                            </p>
                        <?php } ?>
                        <?php if ($total_amount  != 0) { ?>
                            <p class="project-money-collected"><span class="project-money-collected-inner"><?php echo $total_amount; ?></span><span> <?php echo $symbol; ?></span></p>
                        <?php } ?>
                    </div>
                    <?php if ($total_amount  != 0) { ?>
                        <div class="one-project-progress-bottom">
                            <div class="progress-bar">
                                <span class="progress-done" style="width: <?php echo $progress_bar; ?>%;"></span>
                                <span class="progress-dot"></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="help-and-share">
                    <p class="help-link">
                        <a href="#" class="one-project-help">
                            <span><?php pll_e( 'Допомогти');?></span>
                        </a>
                    </p>
                    <a target="_blank" href="#" onclick='window.open("https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink() ); ?>&p[images][0]=<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>", "myWindow", "status = 1, height = 500, width = 360, resizable = 0" )' class="share">
                        <span class="one-project-share"><?php pll_e( 'Подiлитися');?></span>
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

add_shortcode('project_partners_mob', 'shortcode_project_partners_mob');
function shortcode_project_partners_mob(){
    $partners_array = get_posts( array(
        'numberposts' => -1,
        'post_type'   => 'partners'
    ));
    $partners_array_by_2 = array_chunk($partners_array, 3, true);
    ob_start(); ?>
    <!-- One Project page. Partners slider. Mobile  -->
    <div class="project-partners-slick-mob">
    <?php foreach( $partners_array_by_2 as $post_wrapper ){ ?>
        <!-- One slide -->
        <div class="project-partners-slide">
            <?php foreach( $post_wrapper as $post ){ ?>
                <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
            <?php } ?>
        </div><!--end project-partners-slide -->
    <?php } ?>
    </div><!--end project-partners-slick-mob -->
    <?php
    $html = ob_get_clean();
    return $html;
}

add_shortcode('zaporuka_help_form', 'shortcode_orange_help_form');
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

add_shortcode( 'vc_custom_post_meta', 'vc_custom_post_meta_render' );
function vc_custom_post_meta_render() {

    $total_collected_timeline = "{{ post_meta_value:total-collected }}";
    $total_amount_timeline = '{{ post_data:total-amount }}';
    $symbol = check_currency();
    //
    ob_start();
    ?>

    <div class="one-project-progress-wrapper">
        <div>
            <span class="project-money-involved"><?php pll_e( 'залучено');?></span>
        </div>
        <div class="one-project-progress">
            <div class="one-project-progress-top">
                <p class="project-money">
                    <span class="project-money-quantity"><span class="project-money-quantity-inner"><?php echo $total_collected_timeline; ?></span><span> <?php echo $symbol; ?></span></span>
                </p>
                <p class="project-money-collected"><span class="project-money-collected-inner"><?php echo $total_amount_timeline; ?></span><span> <?php echo $symbol; ?></span></p>
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

add_shortcode( 'zaporuka_photo_video_doc', 'zaporuka_photo_video_doc' );
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
    <?php if(!empty($project_photos) || !empty($project_videos) || !empty($project_docs)) { ?>
        <div class="sliders-tabs">
            <div class="sliders-tabs-wrapper">
                <?php if (!empty($project_photos)) { ?>
                    <div class="one-tab-link tab-active" data-id="1">
                        <?php pll_e('Фотографiї'); ?>
                    </div>
                <?php } ?>
                <?php if (!empty($project_videos)) { ?>
                    <div class="one-tab-link <?php (empty($project_photos)) ? 'tab-active' : '' ?>" data-id="2">
                        <?php pll_e('Вiдео'); ?>
                    </div>
                <?php } ?>
                <?php if (!empty($project_docs)) { ?>
                    <div class="one-tab-link <?php (empty($project_photos) && empty($project_videos)) ? 'tab-active' : '' ?>"
                         data-id="3">
                        <?php pll_e('Супутнi документи'); ?>
                    </div>
                <?php } ?>
            </div>

            <div class="proj-milestone-desc-block">
                <?php if (!empty($project_photos)) { ?>
                    <div class="slider_tabs_content photo_tab_content active" data-id="1">
                        <!-- PHOTO SLIDER -->
                        <div class="photo-slider slick-media-slider">
                            <?php foreach ($project_photos as $item) { ?>
                                <div class="photo-slide">
                                    <img src="<?php echo $item["photo"]["url"]; ?>"/>
                                </div>
                            <?php } ?>
                        </div><!--end photo-slider-->
                    </div>
                <?php } ?>
                <?php if (!empty($project_videos)) { ?>
                    <div class="slider_tabs_content video_tab_content <?php (empty($project_photos)) ? 'active' : '' ?>" data-id="2">
                    <!-- VIDEO SLIDER -->
                    <div class="video-slider slick-media-slider">
                        <?php foreach ($project_videos as $item) { ?>
                            <div>
                                <a href="<?php echo $item["video-link"]; ?>" target="_blank" class="thumbnail">
                                    <p class="video-slider-img-wrapper">
                                        <img src="<?php echo $item["image-for-video"]["url"]; ?>"/>
                                        <span class="play-video-icon"></span>
                                    </p>
                                </a>
                                <p class="video-slider-text"><?php echo $item["description"]; ?></p>
                            </div>
                        <?php } ?>
                    </div><!--end video-slider-->
                </div>
                <?php } ?>
                <?php if (!empty($project_docs)) { ?>
                    <div class="slider_tabs_content document_tab_content <?php (empty($project_photos) && empty($project_videos)) ? 'active' : '' ?>" data-id="3">
                    <!-- DOCUMENTS SLIDER -->
                    <div class="documents-slider slick-media-slider">
                        <?php foreach ($project_docs as $item) { ?>
                            <div class="documents-slide">
                                <img src="<?php echo $item["document"]["url"]; ?>">
                            </div>
                        <?php } ?>
                    </div><!--end documents-slider-->
                </div>
                <?php } ?>
            </div>
        </div><!-- end sliders-tabs -->

    <?php }
    $html = ob_get_clean();
    return $html;
}

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

add_shortcode( 'custom_testimonials_pro', 'vc_testimonials_content' );
function vc_testimonials_content(){
    $new_query = new WP_Query();
    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    $new_query->query('post_type=reviews&showposts=2'.'&paged='.$paged);
    ob_start();
    ?>
    <!------------
        REVIEWS
    ------------->
    <div class="reviews-block">
        <div class="reviews-wrapper">
            <div class="preloader"></div>
            <?php
            for($i=0;$i<sizeof($new_query->posts);++$i){
                $post_id = $new_query->posts[$i]->ID;
                $name =  $new_query->posts[$i]->post_title;
                $region = get_post_meta($post_id, 'region', true);
                $review_content = $new_query->posts[$i]->post_content;
                ?>
                <div class="reviews-item">
                    <div class="reviews-item-title">
                        <p><?php echo $name; ?></p>
                        <p><?php echo $region; ?></p>
                    </div>
                    <div class="reviews-item-text">
                        <p><?php echo $review_content; ?></p>
                    </div><!-- end reviews-item-text -->
                </div><!-- end reviews-item -->
            <?php } ?>
        </div><!-- end reviews-wrapper -->
        <?php wp_reset_postdata(); ?>
        <div class="pagination-block">
            <?php
            $cpta_args = array('posts_per_page' => -1,'post_type' => 'reviews','post_status' => 'publish');
            $cptaLimit = 2;
            $cptaType = 'reviews';
            $cpta_Query = new WP_Query( $cpta_args );
            $cpta_Count = count($cpta_Query->posts);
            $cpta_Paginationlist = ceil($cpta_Count/$cptaLimit);
            $last = ceil( $cpta_Paginationlist );
            if( $cpta_Paginationlist > 0 ){ ?>
                <ul class='list-cptapagination'>
                    <li class='pagitext'><a href='' class='step-backward step-arrow' data-cpta='1' data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                    <li class='pagitext'><a href='' class='step-prev step-arrow' data-cpta='1' data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></i></a></li>
                    <?php
                    $t = ceil($paged/6 )-1;
                    $t2 = $t*6;
                    for( $cpta=$t2+1; $cpta <= $t2+6; $cpta++){
                        if ( $cpta > $last ) {
                            continue;
                        }
                        if( $cpta ==  $paged ){ $active="active_review"; }else{ $active=""; } ?>
                        <li><a href='' id='post' class="<?php echo $active;?>" data-cpta="<?php echo $cpta;?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"><?php echo $cpta;?></a></li>
                    <?php } ?>
                    <li class='pagitext'><a href='' class='step-next step-arrow' data-cpta='2' data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                    <li class='pagitext'><a href='' class='step-forward step-arrow' data-cpta="<?php echo $last;?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                </ul>
                <?php if ( ($t2+1) == $last ) { ?>
                    <div class="count_pages"><span class="paged_review"><?php echo $last; ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php } else if ( ($last - (($t2+1))) < 6 ) { ?>
                    <div class="count_pages"><span class="paged_review"><?php echo ($t2+1) . '-' . $last; ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php } else {?>
                    <div class="count_pages"><span class="paged_review"><?php echo ($t2+1) . '-' . ($t2+6); ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php  } ?>
            <?php } ?>
        </div>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}

add_shortcode( 'about_video_button', 'about_video_button' );
function about_video_button() {
    $about_video = get_post_meta( get_the_ID(), 'about_video', true );
    ob_start();
    ?>
    <div class="video_button">
        <a
                href="<?php echo $about_video; ?>"
                target="_blank"
                class="thumbnail">
            <?php pll_e( 'Дивитись вiдео');?>
        </a>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}

add_shortcode( 'shortcode_list_of_reports', 'list_of_reports' );
function list_of_reports() {
    $args = array(
        'posts_per_page'   => -1,
        'post_type'        => 'reporting',
    );
    $new_query = new WP_Query($args);
    ob_start();
    ?>
    <div class="list_reports_wrapper">
        <ul >
            <li class="reports-list-title"><span>Выберите год</span><span class="category-expand-button"></span></li>
            <?php for($i=0;$i<sizeof($new_query->posts);++$i){
                if ( $i == 0 ) {$active_report = 'tab-active'; }else{$active_report = '';}
                ?>
                <li class="one-tab-link <?php echo $active_report; ?>" data-id="<?php echo $i; ?>">
                    <span class=""><?php echo $new_query->posts[$i]->post_title;?></span>
                </li>
            <?php } ?>
        </ul>
    </div>
    <?php for($i=0;$i<sizeof($new_query->posts);++$i){
        if ( $i == 0 ) {$active_report = 'active'; }else{$active_report = '';}
        $post_id = $new_query->posts[$i]->ID;
        $reporting = get_field('reporting', $post_id);
        ?>
        <div class="tabs_content <?php echo $active_report; ?> " data-id="<?php echo $i; ?>">
            <div class = "reports_section">
                <?php for ( $n = 0; $n < count($reporting); ++$n) {
                    if ( $n % 2 == 0 ) { $class = 'h2-header-line'; }else{ $class = 'h2-header-without-line'; }
                    ?>
                    <div>
                        <div><h2 class="<?php echo $class; ?>"><?php echo $reporting[$n]['report_type']; ?></h2></div>
                        <div class="download_report_wrapper">
                            <?php foreach ($reporting[$n]['report'] as $report) { ?>
                                <div>
                                    <a href="<?php echo $report['report_file']; ?>" download>
                                        <div class="report_text">
                                            <p class="report_title"><?php echo $report['report_title']; ?></p>
                                            <p class="report_download"><?php pll_e( 'Завантажити');?></p>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }
    $html = ob_get_clean();
    return $html;
}

add_shortcode( 'shortcode_list_of_children', 'list_of_children' );
function list_of_children() {
    $new_query = new WP_Query();
    $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
    $new_query->query('post_type=children&showposts=6'.'&paged='.$paged);

    ob_start();
    ?>
    <div class='children-block'>
        <div class="children-wrapper">
            <div class="preloader"></div>
            <?php for($i=0;$i<sizeof($new_query->posts);++$i){
                $post_id = $new_query->posts[$i]->ID;
                $thumbnail = get_the_post_thumbnail_url($post_id);
                $child_age = get_post_meta($post_id, 'child_age', true);
                $help_amount = get_post_meta($post_id, 'help_amount', true);
                $kind_of_help = get_post_meta($post_id, 'kind_of_help', true);
                $region = get_post_meta($post_id, 'region', true);
                $review_content = $new_query->posts[$i]->post_content;
                $review_title = $new_query->posts[$i]->post_title;

                ?>
                <!-- One-child -->
                <div class="child">
                    <div class="child-top">
                        <div class="child-photo"><img src="<?php echo $thumbnail; ?>"></div>
                        <div class="child-info">
                            <p class="child-name-and-age">
                                <span class="child-name"><?php echo $review_title;?></span>
                                <span>,</span>
                                <span class="child-age"><?php echo $child_age; ?></span>
                                <span>,</span>
                            </p>
                            <p class="child-region">
                                <?php echo $region; ?>
                            </p>
                        </div><!-- end child-info -->
                    </div><!-- end child-top -->
                    <div class="child-bottom">
                        <?php echo $review_content; ?> <?php pll_e( 'Сума допомоги');?> – <span class="help-amount"><?php echo $help_amount; ?></span><span class="kind-of-help"> <?php echo $kind_of_help; ?></span> .
                    </div>
                </div><!-- end one-child  -->
            <?php } ?>
        </div>
        <?php wp_reset_postdata(); ?>
        <div class="pagination-children">
            <?php
            $cptaType = 'children';
            $cpta_args = array('posts_per_page' => -1,'post_type' => $cptaType,'post_status' => 'publish');
            $cptaLimit = 6;
            $cpta_Query = new WP_Query( $cpta_args );
            $cpta_Count = count($cpta_Query->posts);
            $cpta_Paginationlist = ceil($cpta_Count/$cptaLimit);
            $last = ceil( $cpta_Paginationlist );
            if( $cpta_Paginationlist > 0 ){ ?>
                <ul class='list-cptapagination'>
                    <li class='pagitext'><a href='' class='step-backward step-arrow' data-cpta='1' data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                    <li class='pagitext'><a href='' class='step-prev step-arrow' data-cpta='1' data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></i></a></li>
                    <?php
                    $t = ceil($paged/6 )-1;
                    $t2 = $t*6;
                    for( $cpta=$t2+1; $cpta <= $t2+6; $cpta++){
                        if ( $cpta > $last ) {
                            continue;
                        }
                        if( $cpta ==  $paged ){ $active="active_review"; }else{ $active=""; }
                        ?>
                        <li><a href='' id='post' class="<?php echo $active;?>" data-cpta="<?php echo $cpta;?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"><?php echo $cpta;?></a></li>
                    <?php } ?>
                    <li class='pagitext'><a href='' class='step-next step-arrow' data-cpta='2' data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                    <li class='pagitext'><a href='' class='step-forward step-arrow' data-cpta="<?php echo $last;?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                </ul>
                <?php if ( ($t2+1) == $last ) { ?>
                    <div class="count_pages"><span class="paged_review"><?php echo $last; ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php } else if ( ($last - (($t2+1))) < 6 ) { ?>
                    <div class="count_pages"><span class="paged_review"><?php echo ($t2+1) . '-' . $last; ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php } else {?>
                    <div class="count_pages"><span class="paged_review"><?php echo ($t2+1) . '-' . ($t2+6); ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php  } ?>
            <?php } ?>
        </div>

    </div>

    <?php
    $html = ob_get_clean();
    return $html;
}

class section_post_info_class extends WPBakeryShortCode {
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'section_post_info_mapping' ) );
        add_shortcode( 'section_post_info', array( $this, 'section_post_info_html' ) );
    }
    // Element Mapping
    public function section_post_info_mapping() {
        vc_map( array(
            "name" => esc_html__("Post info", "eq"),
            "base" => "section_post_info",
            'category' => __('Content', 'text-domain')
        ));
    }
    // Element HTML
    public function section_post_info_html( $atts ) {
        WPBMap::addAllMappedShortcodes();
        global $post;

        $post_category = wp_get_post_categories( $post->ID, array('fields' => 'names') );
        $post_date = time($post->post_date);
        ob_start();
        ?>
        <div class="custom_post_info">
            <div class="right_info_block">
                <div class="post_category_class"><?php echo $post_category[0]; ?></div>
                <div class="post_date_class"><?php echo date_i18n('d F Y', $post_date ); ?></div>
            </div>
            <div>
                <div>
                    <a target="_blank" href="#" onclick='window.open("https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink() ); ?>&p[images][0]=<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>", "myWindow", "status = 1, height = 500, width = 360, resizable = 0" )'>
                    <span class="one-project-socials">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </span>
                    </a>
                </div>
            </div>
        </div>
        <?php

        $html = ob_get_clean();
        return $html;
    }
}
$section_post_info_class = new section_post_info_class;

add_shortcode( 'custom_social_block_pro', 'custom_social_block' );
function custom_social_block(){
    $options = get_option('ThemeOptions');
    $facebook_link = !empty($options['facebook_link']) ? $options['facebook_link'] : false;
    $instagram_link = !empty($options['instagram_link']) ? $options['instagram_link'] : false;
    ob_start();
    ?>
    <div class="proj-timeline-info news_social_info">
        <div class="proj-timeline-info-left">
            <p class="left-to-collect-text"><?php pll_e( 'Долучайтесь до БФ Запорука у соцмережах');?></p>
        </div><!-- end proj-timeline-info-left -->
        <div class="proj-timeline-info-right">
            <a href="<?php echo $facebook_link;?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a>
            <a href="<?php echo $instagram_link;?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
        </div><!-- end proj-timeline-info-right -->
    </div><!-- end proj-timeline-info -->
    <?php
    $html = ob_get_clean();
    return $html;
}

add_shortcode( 'post_photo_gallery_pro', 'shortcode_post_photo_gallery' );
function shortcode_post_photo_gallery(){
    $post = get_post();
    $post_id = $post->ID;
    $post_photos = get_field( "post_photos", $post_id );

    ob_start();
    ?>
    <div class="post_photo_gallery">
        <?php foreach ($post_photos as $item) { ?>
            <div>
                <img src="<?php echo $item["post_photo"]; ?>" alt="">
            </div>
        <?php } ?>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}

add_shortcode( 'shortcode_donors_gallery', 'shortcode_donory_gallery' );
function shortcode_donory_gallery(){
    $donors_array = get_posts( array(
        'numberposts' => -1,
        'post_type'   => 'donors'
    ));
    $donors_array_by_2 = array_chunk($donors_array, 3, true);

    ob_start();
    ?>
    <div class="donors">
        <!-- DONORS DESKTOP -->
        <div class="donors-desktop">
            <?php for($i=0;$i<sizeof($donors_array);++$i){
                $post_id = $donors_array[$i]->ID;
                $thumbnail = get_the_post_thumbnail_url($post_id);
                ?>
                <div class="donors-img-wrapper"><img src="<?php echo $thumbnail; ?>"></div>
            <?php } ?>
        </div>
        <!-- DONORS MOBILE -->
        <div class="donors-mobile-slider">
            <?php foreach( $donors_array_by_2 as $post_wrapper ){ ?>
                <div class="donors-one-slide">
                    <?php foreach( $post_wrapper as $post ){ ?>
                        <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>">
                    <?php } ?>
                </div>

            <?php } ?>
        </div>
    </div>

    <?php
    $html = ob_get_clean();
    return $html;
}

add_shortcode( 'shortcode_awards_slider', 'shortcode_awards_slider' );
function shortcode_awards_slider(){
    $awards_array = get_posts( array(
        'numberposts' => -1,
        'post_type'   => 'list_of_awards'
    ));
    $awards_array_by_2 = array_chunk($awards_array, 3, true);
    ob_start();
    ?>
    <div class="rewards">
        <!-- DONORS DESKTOP -->
        <div class="rewards-desktop">
            <?php for($i=0;$i<sizeof($awards_array);++$i){ ?>
                <p class="rewards-one-item"><?php echo $awards_array[$i]->post_content; ?></p>
            <?php } ?>
        </div>
        <!-- REWARDS SLIDER MOBILE -->
        <div class="rewards-slider-mob">
            <?php foreach( $awards_array_by_2 as $post_wrapper ){ ?>
                <div class="rewards-one-slide">
                    <?php foreach( $post_wrapper as $post ){ ?>
                        <p class="rewards-one-slide-item"><?php echo $post->post_content; ?></p>
                    <?php } ?>
                </div>
            <?php } ?>

        </div><!--end rewards_slider_mob-->
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}

add_shortcode( 'shortcode_thanks_block_pro', 'shortcode_thanks_block' );
function shortcode_thanks_block(){
    $order_id_answer = $_GET['answer_order_id'];
    $liqpay_answer_status =  get_option($order_id_answer . '-liqpay_answer_status');
    $liqpay_answer_transaction_id =  get_option($order_id_answer.'-liqpay_answer_transaction_id');
    $liqpay_answer_summa =  get_option($order_id_answer.'-liqpay_answer_summa');
    $liqpay_post_id =  get_option($order_id_answer . '-liqpay_post_id');
    $thanks_text = get_field('thanks_text', $liqpay_post_id);
    //var_dump($_SERVER['HTTP_REFERER']);
    ob_start();
    if($liqpay_answer_transaction_id){
      /*  global $wpdb, $table_prefix;
        $table_liqpay = $table_prefix . 'liqpay';
        $res = $wpdb->get_results("SELECT summa FROM {$table_liqpay} WHERE order_id = {$order_id_answer}");*/

        $order_sum = '<span class="order-sum">' .  $liqpay_answer_summa. ' '  . check_currency() . '</span>';
        if ( !isset($thanks_text) ) {
            if( ICL_LANGUAGE_CODE == 'uk' ) {
                $thanks_text = 'Вдячні за вашу пожертву у розмірі [сумма] Всі відправлені вами кошти підуть на допомогу БФ "Запорука".';
            }
            elseif ( ICL_LANGUAGE_CODE == 'ru' ) {
                $thanks_text = 'Благодарны за ваше пожертвование в размере [сумма] Все отправленные вами средства пойдут на помощь БФ "Запорука".';
            }
            elseif ( ICL_LANGUAGE_CODE == 'en' ) {
                $thanks_text = 'We are grateful for your donation with the amount of [сумма]. All funds sent by you will be transfered to help CF(Charity Fund) Zaporuka.';
            }
        }
        $thanks_text = str_replace('[сумма]', $order_sum, $thanks_text);
       
        
        ?>
        <div class="home-first-thanks-block">
            <div class="thanks-text-wrapper">
                <div>
                    <a href="<?php echo home_url(); ?>">
                        <div><h2 class="h2-header-without-line-white"><?php pll_e( 'Дякуємо за підтримку!');?></h2></div>
                        <div class="thanks-text-block">
                            <?php echo $thanks_text; ?>
                        </div>
                    </a>
                    <div class="thanks-share-link">
                        <a target="_blank" href="#" onclick='window.open("https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink() ); ?>&p[images][0]=<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>", "myWindow", "status = 1, height = 500, width = 360, resizable = 0" )'>
                        <span class="one-project-socials"><?php pll_e( 'Подiлитися');?>
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    else{
        ?>
         <div class="home-first-thanks-block">
            <div class="thanks-text-wrapper">
                <div>
                    <a href="<?php echo home_url(); ?>">
                        <div><h2 class="h2-header-without-line-white"><?php pll_e( 'Ви скасували оплату!');?></h2></div>
                    </a>
                </div>
            </div>
         </div>
        <?php
    }

    $html = ob_get_clean();
    return $html;
}
add_action('add_meta_boxes', 'add_custom_history_box');
function add_custom_history_box(){
    $screens = array( 'post_type', 'projects' );
    add_meta_box( 'post_payment_history', 'История зачислений/списаний', 'history_meta_box_callback', $screens );
}
// HTML код блока
function history_meta_box_callback( $post, $meta ){
    global $wpdb, $table_prefix;
    $table_liqpay_project_history = $table_prefix . 'liqpay_project_history';
    $all_posts = $wpdb->get_var( 'SELECT description FROM ' . $wpdb->term_taxonomy . ' WHERE taxonomy = "post_translations" AND description LIKE "%i:' . $post->ID . ';%"' );
    $all_ids = unserialize($all_posts);
    $sql = "SELECT * FROM {$table_liqpay_project_history} WHERE project_id IN ({$all_ids['uk']}, {$all_ids['en']}, {$all_ids['ru']})";
    $result = $wpdb->get_results($sql);
    ob_start();
    if(!empty($result)) { ?>
        <style>
            .payment-history{
                border-collapse: collapse!important;
            }
            .payment-history tr{
                border-bottom: 1px solid #ccd0d4;
                text-align: left;
            }

        </style>
        <table class="payment-history" id="history_payments">
            <thead>
            <tr>
                <th>Дата</th>
                <th>Плательщик</th>
                <th>Сумма</th>
                <th>Примечание</th>
            </tr>
            </thead>
           <tbody>
                <?php foreach ($result as $value) { ?>
                    <tr>
                        <td><?php echo $value->order_date; ?></td>
                        <td><?php echo $value->users_name; ?> (<?php echo $value->users_email . ' ' . $value->users_phone; ?>)</td>
                        <td><?php echo $value->summa; ?></td>
                        <td><?php echo $value->type_operation; ?></td>
                    </tr>
                <?php } ?>
           </tbody>
        </table>
    <?php } else {
        echo 'Нет операций';
    }
    $html = ob_get_clean();
    echo $html;

}

add_shortcode( 'shortcode_banner_help_form_home', 'banner_help_form_home' );
function banner_help_form_home() {
    if( isset($_GET['answer_order_id']) ){
        echo do_shortcode('[shortcode_thanks_block_pro]');
    } else{
        echo do_shortcode('[help_form]');
    }
}
