<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="fake-count">
	<div class="quantity-text">
		<?
		if(ICL_LANGUAGE_CODE=='uk'){
	        echo 'Кiлькiсть';
	    }
	    elseif(ICL_LANGUAGE_CODE=='ru'){
	        echo 'Kоличество';
	    }
	    elseif(ICL_LANGUAGE_CODE=='en'){
	        echo  'Quantity';
	    }
		?>
	</div>
	<div class="quantity quantity-numers">
		<div class="quantity-nav"><div class="quantity-button quantity-up">+</div></div>
		<input type="number"  class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" size="4" inputmode="numeric">
		<div class="quantity-nav"><div class="quantity-button quantity-down">-</div></div>
	</div>
</div>
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>
