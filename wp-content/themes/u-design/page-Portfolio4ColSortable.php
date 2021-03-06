<?php
/**
 * Template Name: Portfolio page 4 Columns Sortable
 * @package WordPress
 * @subpackage U-Design
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



get_header();

global $post;
// Get the page id outside the loop (check if WPML plugin is installed and use the WPML way of getting the page ID in the current language).
$page_id = ( function_exists('icl_object_id') && function_exists('icl_get_default_language') ) ? icl_object_id($post->ID, 'page', true, icl_get_default_language()) : $post->ID;
$portfolio_cat_ID = $udesign_options['portfolio_cat_for_page_'.$page_id]; // Get the portfolio category specified by the user in the 'U-Design Options' page.
if ( function_exists('icl_get_default_language') ) {
	udesign_wpml_replace_category_id( $portfolio_cat_ID ); // Fix the category ID with the current language one.
}
$current_categoryID = ( isset( $_GET['cat'] ) ) ? $_GET['cat'] : '';
$categories =  get_categories( 'child_of=' . $portfolio_cat_ID );
if ( ! $current_categoryID ) {
	$current_categoryID = $portfolio_cat_ID;
}
$query_string_prefix = ( get_option( 'permalink_structure' ) != '' ) ? '?' : '&amp;';
if ( preg_match( '/\?/', get_permalink() ) ) {
	$query_string_prefix = '&amp;';
}
//$portfolio_items_per_page = $udesign_options['portfolio_items_per_page_for_page_'.$page_id];
$portfolio_items_per_page = -1;
$portfolio_do_not_link_adjacent_items = $udesign_options['portfolio_do_not_link_adjacent_items_'.$page_id];
$portfolio_title_posistion = $udesign_options['portfolio_title_posistion'];
$portfolio_filter_category = get_post_meta( $post->ID, 'portfolio_filter_category', true );
$portfolio_filter_tags = get_post_meta( $post->ID, 'portfolio_filter_tags', true );
$portfolio_filter_sorting = get_post_meta( $post->ID, 'portfolio_filter_sorting', true );
?>


<div id="content-container" class="isotoope-portfolio-wrapper portfolio-4-column-sortable-page">
	<main id="main-content" role="main" class="grid_24">
		<div class="main-content-padding">
			<?php udesign_main_content_top( is_front_page() ); ?>

			<?php
			// BEGIN the actual page content here.
			if ( have_posts() ) : 
				while ( have_posts() ) : the_post();
					
					get_template_part( 'template-parts/page/content', 'page-portfolio' );
					
				endwhile;
			endif;
			
			if ( ! post_password_required() ) :

				// Check if a category has been assigned as Portfolio section.
				if( $portfolio_cat_ID ) :
					?>
					<div id="isotope-options" class="isotope-options-padding">
						<?php if ( $categories && ($portfolio_filter_category != "0") ) : ?>
							<div class="option-combo">
								<ul id="filter" class="option-set" data-option-key="filter">
									<li id="option-combo-filter-categories"><?php esc_html_e('Categories:', 'u-design'); ?></li>
									<li><a href="#show-all" data-option-value="*" class="selected"><?php esc_html_e('Show All', 'u-design'); ?></a></li>
									<?php foreach( $categories as $category ) : // Generate the link to the rest of categories: ?>
										<?php $category_identifier = 'cat-'.$category->slug; ?>
										<li><a href="<?php echo '#'.$category_identifier; ?>" data-option-value=".<?php echo esc_attr( $category_identifier ); ?>"><?php echo ucwords( $category->cat_name ); ?></a></li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="divider"></div>
						<?php endif; ?>

						<?php
						if ( $portfolio_filter_tags != "0" ) :  
							$post_tags_array = array();
							$current_posts = new WP_Query( array( 'cat' => $current_categoryID, 'posts_per_page' => $portfolio_items_per_page ) );
							if ( $current_posts->have_posts() ) : 
								while ($current_posts->have_posts()) : $current_posts->the_post();
									$post_tags_array = array_merge( $post_tags_array, wp_get_post_tags( $current_posts->post->ID, array( 'fields' => 'all' )) );
								endwhile;
							endif;
							wp_reset_postdata();
							$unique_tag_array = array();
							foreach ( $post_tags_array as $current_tag ) {
								$unique_tag_array[$current_tag->slug] = $current_tag;
							}
							if ( $unique_tag_array ) :
								?>
								<div class="option-combo">
								    <ul id="filter" class="option-set" data-option-key="filter">
										<li id="option-combo-filter-tags"><?php esc_html_e('Tags:', 'u-design'); ?></li>
										<li><a href="#show-all" data-option-value="*" class="selected"><?php esc_html_e('Show All', 'u-design'); ?></a></li>
										<?php foreach ( $unique_tag_array as $current_tag ) : // Sort them based on "slug" criteria but for humans display the actual tag name. ?>
											<li><a href="<?php echo '#'.$current_tag->slug; ?>" data-option-value=".<?php echo esc_attr( $current_tag->slug ); ?>"><?php echo esc_attr( $current_tag->name ); ?></a></li>
										<?php endforeach;?>   
								    </ul>
								</div>
								<div class="divider"></div>
								<?php
							endif;
						endif;
						
						if ( $portfolio_filter_sorting != "0" ) :
							?>
							<div class="option-combo-sorting">
								<ul id="sort" class="option-set" data-option-key="sortBy">
									<li id="option-combo-sorting-description"><?php esc_html_e('Sort By:', 'u-design'); ?></li>
									<li><a title="<?php esc_html_e('Original Order', 'u-design'); ?>" href="#sortBy=number" data-option-value="srt-number" class="selected"><?php esc_html_e('Original Order', 'u-design'); ?></a></li>
									<li><span class="s-divider">/</span></li>
									<li><a title="<?php esc_html_e('Alphabetical', 'u-design'); ?>" href="#sortBy=alphabetical" data-option-value="alphabetical"><?php esc_html_e('Alphabetical', 'u-design'); ?></a></li>
								</ul>

								<ul id="sort-direction" class="option-set" data-option-key="sortAscending">
									<li><a title="<?php esc_html_e('Ascending', 'u-design'); ?>" href="#sortAscending=true" data-option-value="true" class="selected">&uarr;</a></li>
									<li><a title="<?php esc_html_e('Descending', 'u-design'); ?>" href="#sortAscending=false" data-option-value="false">&darr;</a></li>
								</ul>
							</div><!-- end option-combo-sort-direction -->
							<?php
						endif;
						?>

					</div><!-- end isotope-options -->

					<?php 
					// Adhere to paging rules//adhere to paging rules.
					if ( get_query_var( 'paged') ) {
						$paged = get_query_var( 'paged' );
					} elseif ( get_query_var( 'page' ) ) { // Applies when this page template is used as a static homepage in WP3+.
						$paged = get_query_var( 'page' );
					} else {
						$paged = 1;
					}
					// Switch the focus to the chosen portfolio category and its subcategories.
					$portfolio_posts_query = new WP_Query( array(
						'cat' => $current_categoryID,
						'posts_per_page' => $portfolio_items_per_page,
						'paged' => $paged
					    )
					);


					$srt_number = 1;
					
					// Start Portfolio items' loop.
					?>
					<div class="clear"></div>
					<div id="portfolio-container" class="super-list variable-sizes clearfix portfolio-items-wrapper1">
						<?php		
						if ( $portfolio_posts_query->have_posts() ) :
							while ( $portfolio_posts_query->have_posts() ) : $portfolio_posts_query->the_post();

								// Generate slugs for filtering by category.
								$classes_identifiers = '';
								if ( $portfolio_filter_category != "0" ) {
									$post_categories = wp_get_post_categories( $portfolio_posts_query->post->ID );
									$cats = array();
									foreach($post_categories as $c) {
										$cat = get_category( $c );
										$cats[] = 'cat-'.$cat->slug;
									}
									$classes_identifiers = implode(" ", $cats);
								}
								// Generate slugs for filtering by tags.
								$tags_names = ( $portfolio_filter_tags != "0" ) ? implode(" ", wp_get_post_tags( $portfolio_posts_query->post->ID, array( 'fields' => 'slugs' ) )) : '';
								?>
								<div class="one_fourth_isotope portfolio-category <?php echo esc_attr( $classes_identifiers ); ?> <?php echo esc_attr( $tags_names ); ?>">
									<?php if( $portfolio_title_posistion == 'above' ): ?>
										<h2><?php the_title(); ?></h2>
									<?php endif; ?>
									<div class="srt-name" style="display:none;"><?php the_title(); ?></div>
									<div class="srt-number" style="display:none;"><?php echo esc_attr( $srt_number++ ); ?></div>

									<div class="thumb-holder-4-col">
										<div class="portfolio-img-thumb-4-col">
										<?php // Get Portfolio Item Thumbnail.
											get_portfolio_item_thumbnail( $portfolio_posts_query->post->ID, '4', '176', '116', $portfolio_do_not_link_adjacent_items, true ); ?>
										</div><!-- end portfolio-img-thumb-4-col -->
									</div><!-- end thumb-holder-4-col -->

									<?php $portfolio_item_description = get_post_meta( $portfolio_posts_query->post->ID, 'portfolio_item_description', true ); ?>
									<?php if ( $portfolio_item_description ) : ?>
										<?php if( $portfolio_title_posistion == 'below' ) : ?>
											<h2><?php the_title(); ?></h2>
										<?php endif; ?>
										<div class="clear"></div>
										<?php echo do_shortcode( __( $portfolio_item_description ) ); ?>
									<?php endif; ?>

								</div><!-- end one_fourth -->
								<div class='clear'> </div>
								<?php
							endwhile;
						       // Restore original Post Data.
							wp_reset_postdata();
						endif; // End Portfolio items' loop.
						?>
					</div><!-- end portfolio-items-wrapper -->

					<?php
				else : // Category has not been assigned.
					?>
					<div class="grid_22 prefix_1 suffix_1">
						<h2><?php esc_html_e( 'Portfolio section for this page has not been found!', 'u-design' ); ?></h2>
						<p><?php _e( "<strong>Reason:</strong> No category has been assigned as Portfolio section for this page yet. In order to fix this, go to the theme's options page and assign a category for this page.", 'u-design' ); ?></p>
					</div>
					<?php
				endif;
				
			endif; // Close password required if statement.
			?>

			<div class="clear"></div>

			<?php udesign_main_content_bottom(); ?>
		</div><!-- end main-content-padding -->
	</main><!-- end main-content -->
</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();


