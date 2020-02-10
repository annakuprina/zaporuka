<?php
/**
 * WooCommerce related WPBakery Page Builder elements by the U-Design theme.
 *
 * Make WPBakery Page Builder elements for U-Design theme with WooCommerce.
 *
 * @link       https://themeforest.net/user/andondesign
 * @since      1.0.0
 *
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes/shortcodes
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Before VC init.
add_action( 'vc_before_init', 'udesign_core_wc_vc_elements' );

/**
 * Generate the WPBakery Page Builder elements.
 */
function udesign_core_wc_vc_elements() {

	/**
	 * -----------------------------------------------------------------------------------------------
	 *  U-Design VisualComposer element that groups
	 *  "WooCommerce top rated products" ('udesign_wc_top_rated_products' shortcode) and
	 *  "WooCommerce products" ('udesign_wc_products' shortcode) into one element
	 * -----------------------------------------------------------------------------------------------
	 *
	 * The following  will create the [vc_udesign_wc_products]...[/vc_udesign_wc_products] element
	 *
	 * @since 1.0.0
	 * @param array  $atts The widget attributes.
	 * @param string $content The widget's content'.
	 * @return string HTML code.
	 */
	function wpbpb_udesign_wc_products_func( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'shortcode_type' => 'udesign_wc_top_rated_products', // options: 'udesign_wc_top_rated_products', 'udesign_wc_products'
				// The following parameters are common in both "udesign_wc_top_rated_products" and "udesign_wc_products" shortcodes.
				'title'          => esc_html__( 'Top rated products', 'u-design-core' ),
				'number'         => 5,
				'class'          => '',
				// 'udesign_wc_products' specific:
				'show'           => '', // options: leave blank for all products, 'featured', 'onsale'.
				'orderby'        => 'date', // options: 'date', 'price', 'rand', 'sales'.
				'order'          => 'desc', // options: 'asc', 'desc'.
				'hide_free'      => 0,
				'show_hidden'    => 0,
			),
			$atts,
			'vc_udesign_wc_products'
		);

		if ( 'udesign_wc_top_rated_products' === $atts['shortcode_type'] ) {
				$output = do_shortcode( '[' . $atts['shortcode_type'] . ' title="' . $atts['title'] . '" number="' . $atts['number'] . '"]' );
		} else { // When 'udesign_wc_products'.
				$output = do_shortcode( '[' . $atts['shortcode_type'] . ' title="' . $atts['title'] . '" number="' . $atts['number'] . '" show="' . $atts['show'] . '" orderby="' . $atts['orderby'] . '" order="' . $atts['order'] . '" hide_free="' . $atts['hide_free'] . '" show_hidden="' . $atts['show_hidden'] . '"]' );
		}
		return $output;

	}
	add_shortcode( 'vc_udesign_wc_products', 'wpbpb_udesign_wc_products_func' );

	vc_map(
		array(
			'name'        => __( 'Products', 'u-design-core' ),
			'base'        => 'vc_udesign_wc_products',
			'category'    => __( 'U-Design WooCommerce', 'u-design-core' ),
			'description' => __( 'U-Design theme element', 'u-design-core' ),
			'icon'        => plugins_url( '/images/ud-logo-small.png', __FILE__ ),
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Element Type', 'u-design-core' ),
					'param_name'  => 'shortcode_type',
					'value'       => array(
						__( 'WooCommerce products', 'u-design-core' )    => 'udesign_wc_products',
						__( 'WooCommerce top rated products', 'u-design-core' )   => 'udesign_wc_top_rated_products',
					),
					'std'         => 'udesign_wc_products',
					'save_always' => true,
					'description' => __( 'Select the element type.', 'u-design-core' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Title', 'u-design-core' ),
					'param_name'  => 'title',
					'value'       => '',
					'save_always' => true,
					'description' => __( 'Enter title.', 'u-design-core' ),
					'admin_label' => true,
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Number', 'u-design-core' ),
					'param_name'  => 'number',
					'value'       => '5',
					'save_always' => true,
					'description' => __( 'Number of products to show.', 'u-design-core' ),
				),

				// 'udesign_wc_products' specific:
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Show', 'u-design-core' ),
					'param_name'  => 'show',
					'value'       => array(
						__( 'All products', 'u-design-core' ) => '',
						__( 'Featured products', 'u-design-core' ) => 'featured',
						__( 'On-sale products', 'u-design-core' ) => 'onsale',
					),
					'std'         => '',
					'save_always' => true,
					'dependency'  => array(
						'element' => 'shortcode_type',
						'value'   => array( 'udesign_wc_products' ),
					),
					'description' => __( 'Select what products to show.', 'u-design-core' ),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Order by', 'u-design-core' ),
					'param_name'  => 'orderby',
					'value'       => array(
						__( 'Date', 'u-design-core' )   => 'date',
						__( 'Price', 'u-design-core' )  => 'price',
						__( 'Random', 'u-design-core' ) => 'rand',
						__( 'Sales', 'u-design-core' )  => 'sales',
					),
					'std'         => 'date',
					'save_always' => true,
					'dependency'  => array(
						'element' => 'shortcode_type',
						'value'   => array( 'udesign_wc_products' ),
					),
					'description' => __( 'Select what criteria should the product be ordered by.', 'u-design-core' ),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Order', 'u-design-core' ),
					'param_name'  => 'order',
					'value'       => array(
						__( 'DESC', 'u-design-core' ) => 'desc',
						__( 'ASC', 'u-design-core' )  => 'asc',
					),
					'std'         => 'desc',
					'save_always' => true,
					'dependency'  => array(
						'element' => 'shortcode_type',
						'value'   => array( 'udesign_wc_products' ),
					),
					'description' => __( 'Select how the product should be ordered (Descending or Ascending).', 'u-design-core' ),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => __( 'Hide free products', 'u-design-core' ),
					'param_name'  => 'hide_free',
					'value'       => array( __( 'Yes', 'u-design-core' ) => 'yes' ),
					'save_always' => true,
					'dependency'  => array(
						'element' => 'shortcode_type',
						'value'   => array( 'udesign_wc_products' ),
					),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => __( 'Show hidden products', 'u-design-core' ),
					'param_name'  => 'show_hidden',
					'value'       => array( __( 'Yes', 'u-design-core' ) => 'yes' ),
					'save_always' => true,
					'dependency'  => array(
						'element' => 'shortcode_type',
						'value'   => array( 'udesign_wc_products' ),
					),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Custom Class', 'u-design-core' ),
					'param_name'  => 'class',
					'value'       => '',
					'save_always' => true,
					'description' => __( 'Use this option to pass a unique CSS class which you may use to style this particular instance of the content block in the front end with custom CSS.', 'u-design-core' ),
				),
			),
		)
	);

}





