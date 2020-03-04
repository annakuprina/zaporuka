<?php
if($_POST['custom_action'] == 'true'){
    include __DIR__ . '/../../../../wp-load.php';
    $cptaNumber = $paged = absint($_POST['number']);
    $prev_click = $_POST['prev'];
    $cptaLimit  = $_POST['limit'];
    $cptaType = $_POST['post_type'];
    if( $cptaNumber == "1" ){
        $cptaOffsetValue = "0";
        $args = array('posts_per_page' => $cptaLimit,'post_type' => $cptaType,'post_status' => 'publish');
    }else{
        $cptaOffsetValue = ($cptaNumber-1)*$cptaLimit;
        $args = array('posts_per_page' => $cptaLimit,'post_type' => $cptaType,'offset' => $cptaOffsetValue,'post_status' => 'publish');
    }
    $cptaQuery = new WP_Query( $args );
    $html = "";
    if( isset($cptaQuery->posts) ){ ?>
        <div class='reviews-block'>
            <div class='reviews-wrapper'>
                <div class="preloader"></div>
                <?php for($i=0;$i<sizeof($cptaQuery->posts);++$i){
                    $post_id = $cptaQuery->posts[$i]->ID;
                    $name =  $cptaQuery->posts[$i]->post_title;
                    $region = get_post_meta($post_id, 'region', true);
                    $review_content = $cptaQuery->posts[$i]->post_content;
                ?>
                    <div class='reviews-item'>
                        <div class='reviews-item-title'>
                            <p><?php echo $name; ?></p>
                            <p><?php echo $region;?></p>
                        </div>
                        <div class='reviews-item-text'>
                         <p><?php echo $review_content; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php wp_reset_postdata(); ?>
            <div class="pagination-block">
                <?php
                $cpta_args = array('posts_per_page' => -1,'post_type' => 'reviews','post_status' => 'publish');
                $cptaLimit = $cptaLimit;
                $cpta_Query = new WP_Query( $cpta_args );
                $cpta_Count = count($cpta_Query->posts);
                $cpta_Paginationlist = ceil($cpta_Count/$cptaLimit);
                $last = ceil( $cpta_Paginationlist );
                $adjacents = "2";
                $cptaType = $cptaType;
                if ( $paged == 1 ) {$prev = 1;} else{$prev = $paged - 1;}
                if ( $paged == $last ) {$next = $last;} else{$next = $paged + 1;}
                if( $cpta_Paginationlist > 0 ){ ?>
                    <ul class='list-cptapagination'>
                        <li class='pagitext'><a href='' class='step-backward step-arrow' data-cpta='1' data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                        <li class='pagitext'><a href='' class='step-prev step-arrow' data-prev="prev" data-cpta="<?php echo $prev; ?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></i></a></li>
                        <?php
                        $t = ceil($paged/6 )-1;
                        $t2 = $t*6;
                        for( $cpta=$t2+1; $cpta <= $t2+6; $cpta++){
                            if ( $cpta > $last ) {
                                continue;
                            }
                            if( $cpta == $paged ){ $active="active_review"; }else{ $active=""; }
                            ?>
                            <li><a href='' id='post' class="<?php echo $active;?>" data-cpta="<?php echo $cpta;?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"><?php echo $cpta;?></a></li>
                        <?php } ?>
                        <li class='pagitext'><a href='' class='step-next step-arrow' data-cpta="<?php echo $next; ?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
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
        die();
    }
}
if($_POST['show_children'] == 'true'){
    include __DIR__ . '/../../../../wp-load.php';
    $cptaNumber = $paged = absint($_POST['number']);
    $prev_click = $_POST['prev'];
    $cptaLimit  = $_POST['limit'];
    $cptaType = $_POST['post_type'];
    if( $cptaNumber == "1" ){
        $cptaOffsetValue = "0";
        $args = array('posts_per_page' => $cptaLimit,'post_type' => $cptaType,'post_status' => 'publish');
    }else{
        $cptaOffsetValue = ($cptaNumber-1)*$cptaLimit;
        $args = array('posts_per_page' => $cptaLimit,'post_type' => $cptaType,'offset' => $cptaOffsetValue,'post_status' => 'publish');
    }
    $cptaQuery = new WP_Query( $args );
    $html = "";
    if( isset($cptaQuery->posts) ){ ?>
        <div class='children-wrapper'>
            <div class="preloader"></div>
            <?php for($i=0;$i<sizeof($cptaQuery->posts);++$i){
                $post_id = $cptaQuery->posts[$i]->ID;
                $thumbnail = get_the_post_thumbnail_url($post_id);
                $child_age = get_post_meta($post_id, 'child_age', true);
                $help_amount = get_post_meta($post_id, 'help_amount', true);
                $kind_of_help = get_post_meta($post_id, 'kind_of_help', true);
                $region = get_post_meta($post_id, 'region', true);
                $review_content = $cptaQuery->posts[$i]->post_content;
                $review_title = $cptaQuery->posts[$i]->post_title;
                ?>
                <!-- One-child -->
                <div class="child">
                    <div class="child-top">
                        <div class="child-photo"><img src="<?php echo $thumbnail; ?>"></div>
                        <div class="child-info">
                            <p class="child-name-and-age">
                                <span class="child-name"><?php echo $review_title; ?></span>
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
            $cpta_args = array('posts_per_page' => -1,'post_type' => $cptaType,'post_status' => 'publish');
            $cpta_Query = new WP_Query( $cpta_args );
            $cpta_Count = count($cpta_Query->posts);
            $cpta_Paginationlist = ceil($cpta_Count/$cptaLimit);
            $last = ceil( $cpta_Paginationlist );
            $adjacents = "2";
            if ( $paged == 1 ) {$prev = 1;} else{$prev = $paged - 1;}
            if ( $paged == $last ) {$next = $last;} else{$next = $paged + 1;}
            if( $cpta_Paginationlist > 0 ){ ?>
                <ul class='list-cptapagination'>
                    <li class='pagitext'><a href='' class='step-backward step-arrow' data-cpta='1' data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                    <li class='pagitext'><a href='' class='step-prev step-arrow' data-prev="prev" data-cpta="<?php echo $prev; ?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></i></a></li>
                    <?php
                    $t = ceil($paged/6 )-1;
                    $t2 = $t*6;
                    for( $cpta=$t2+1; $cpta <= $t2+6; $cpta++){
                        if ( $cpta > $last ) {
                            continue;
                        }
                        if( $cpta == $paged ){ $active="active_review"; }else{ $active=""; }
                        ?>
                        <li><a href='' id='post' class="<?php echo $active;?>" data-cpta="<?php echo $cpta;?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"><?php echo $cpta;?></a></li>
                    <?php } ?>
                    <li class='pagitext'><a href='' class='step-next step-arrow' data-cpta="<?php echo $next; ?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                    <li class='pagitext'><a href='' class='step-forward step-arrow' data-cpta="<?php echo $last;?>" data-limit="<?php echo $cptaLimit; ?>" data-type="<?php echo $cptaType; ?>"></a></li>
                </ul>
                <?php if ( ($t2+1) == $last ) { ?>
                    <div class="count_pages"><span class="paged_review"><?php echo $last; ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php } else if ( ($last - (($t2+1))) < 6 ) { ?>
                    <div class="count_pages"><span class="paged_review"><?php echo ($t2+1) . '-' . $last; ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php } else {?>
                    <div class="count_pages"><span class="paged_review"><?php echo ($t2+1) . '-' . ($t2+6); ?></span> <?php pll_e( 'сторiнка з');?> <span class="paged_review"><?php echo $last; ?></span></div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php
        die();
    }
}
