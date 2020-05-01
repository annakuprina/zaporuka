<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?>"><?php echo $product->get_price_html(); ?></p>

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
		<input type="number" readonly="readonly"  class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" size="4" inputmode="numeric">
		<div class="quantity-nav"><div class="quantity-button quantity-down">-</div></div>
	</div>
</div>
