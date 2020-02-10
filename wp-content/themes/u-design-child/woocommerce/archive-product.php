<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<div class="shop-custom-wrapper">
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>

	<div class="woocommerce-custom-product-filter">
		<div class="woocommerce-custom-category-filter-wrapper">
			<ul class="woocommerce-custom-category-filter">
				<li class="category-filter-item"><a href='<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>'>
					<?php
						if(ICL_LANGUAGE_CODE=='uk'){
							echo 'Всi товари';
						}
						elseif(ICL_LANGUAGE_CODE=='ru'){
							echo 'Все товары';
						}
						elseif(ICL_LANGUAGE_CODE=='en'){
							echo 'All products';
						}
					?>
				  </a></li>
				<?php
				$args = array(
				    'taxonomy'   => "product_cat",
				    'orderby'       => 'include', 
				    'hide_empty'    => true,
				);
				$product_categories = get_terms($args);
				foreach ($product_categories as $cat) {
					echo '<li class="category-filter-item"><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a></li>';
				}
				?>
			</ul>
		</div>
		<div class="filter-cart-price-wrapper">
			<div class="woocommerce-custom-price-filter">
				<a href="#">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g><g><path fill="#333" opacity=".3" d="M15.77.44a.476.476 0 0 0-.432-.28H.626a.476.476 0 0 0-.432.28.486.486 0 0 0 .07.515l5.77 6.835v7.573a.482.482 0 0 0 .475.482c.132 0 .26-.056.353-.158l2.945-3.28a.485.485 0 0 0 .124-.324V7.79l5.77-6.835a.486.486 0 0 0 .07-.515z"/></g></g></svg>
					<?php
					if(ICL_LANGUAGE_CODE=='uk'){
						echo 'Фiльтр';
					}
					elseif(ICL_LANGUAGE_CODE=='ru'){
						echo 'Фильтр';
					}
					elseif(ICL_LANGUAGE_CODE=='en'){
						echo 'Filter';
					}?>
					
				</a>
			</div>
			<div class="woocommerce-cart-page-link">
				<a href="<?php echo wc_get_cart_url();?>">
					<?php if( WC()->cart->get_cart_contents_count() > 0 ): ?>
						<span class="cart-customlocation cart-count"><span class="plus"></span><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span>
					<?php else:?>
						<span class="cart-customlocation cart-count"></span>
					<?php endif;?>					
						
					
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17"><g><g><path fill="#333" opacity=".3" d="M4.35 3.732c0-1.442 1.19-2.629 2.659-2.629 1.468 0 2.66 1.187 2.66 2.63v.89h-5.32zm9.548 11.383L12.838 4.91a.305.305 0 0 0-.319-.276h-1.803V3.74c0-2.042-1.676-3.7-3.712-3.7-2.036 0-3.712 1.658-3.712 3.7v.893H1.489a.322.322 0 0 0-.318.276L.11 15.115v.043c0 .999.806 1.807 1.803 1.807h10.182c.997 0 1.803-.808 1.803-1.807v-.043z"/></g></g></svg>
					<?php
					if(ICL_LANGUAGE_CODE=='uk'){
						echo 'Кошик';
					}
					elseif(ICL_LANGUAGE_CODE=='ru'){
						echo 'Корзина';
					}
					elseif(ICL_LANGUAGE_CODE=='en'){
						echo 'Cart';
					}?>
					
				</a>
			</div>
		</div>	
	</div>
	<div class="woocommerce-hidden-price-filter">
		<?php //echo get_dynamic_column( '', '', 'sidebar-23' );?>
		<?php echo do_shortcode("[br_filter_single filter_id=1255]");?>
	</div>
</header>
<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	//do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>
</div>
<?php

get_footer( 'shop' );
