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
					<a href="#" class="help-item-link"><?php echo $help_by_sms_hover_text_link; ?></a>
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
    <div class="media-sliders-tabs">
        <p data-id="1" class="media-slider-one-tab">Фотографiї</p>
        <p data-id="2" class="media-slider-one-tab">Вiдео</p>
        <p data-id="3" class="media-slider-one-tab">Супутнi документи</p>
    </div>

    <!-- MEDIA SLIDERS WRAPPER -->
    <div class="media-sliders-wrapper">
        <!-- PHOTO SLIDER -->
        <div class="media-slider" data-id="1">
            <div class="photo-slider" >
                <?php foreach ($project_photos as $item) { ?>
                    <div class="photo-slide">
                        <img src="<?php echo $item["photo"]["url"]; ?>">
                    </div>
                <?php } ?>
            </div><!--end photo-slider-->
        </div><!--end media-slider-->

        <!-- VIDEO SLIDER -->
        <div class="media-slider" data-id="2">
            <div class="video-slider">
                <?php foreach ($project_videos as $item) { ?>
                    <div>
                         <a href="<?php echo $item["video-link"];?>" target="_blank" class="thumbnail">
                            <img src="<?php echo $item["image-for-video"]["url"]; ?>">
                            <i class="fa fa-play-circle" aria-hidden="true"></i>
                            <p><?php echo $item["description"];?></p>
                        </a>
                    </div>
                <?php } ?>
            </div><!--end video-slider-->
        </div><!--end media-slider-->

        <!-- DOCUMENTS SLIDER -->
        <div class="media-slider" data-id="3">
            <div class="documents-slider">
                <?php foreach ($project_docs as $item) { ?>
                    <div class="documents-slide">
                        <img src="<?php echo $item["document"]["url"];?>">
                    </div>
                <?php } ?>
            </div><!--end documents-slider-->
        </div><!--end media-slider-->
    </div><!--end media-sliders-wrapper-->

    <?php
    $html = ob_get_clean();
    return $html;

}
add_shortcode( 'zaporuka_photo_video_doc', 'zaporuka_photo_video_doc' );

