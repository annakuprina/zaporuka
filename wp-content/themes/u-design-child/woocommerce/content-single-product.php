<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
	<div class="single-product-cart-link">
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
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
