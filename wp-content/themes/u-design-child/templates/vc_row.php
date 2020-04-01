<?php
/** @var $this WPBakeryShortCode_VC_Row */
// $element_id was added to output
$output = $element_id = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $full_width = '';
extract( shortcode_atts( array(
    // added element_id attribute
    'element_id' => '',
    'el_class' => '',
    'bg_image' => '',
    'bg_color' => '',
    'bg_image_repeat' => '',
    'font_color' => '',
    'padding' => '',
    'margin_bottom' => '',
    'full_width' => false,
    'css' => '',
), $atts ) );

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = $this->buildStyle( $bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom );
?>

    <!-- Added an ID attribute where we echo our $element_id variable -->
    <div <?php
?>class="<?php echo esc_attr( $css_class ); ?><?php if ( $full_width == 'stretch_row_content_no_spaces' ): echo ' vc_row-no-padding'; endif; ?>" id="<?php echo $element_id; ?>" <?php if ( ! empty( $full_width ) ) {
    echo ' data-vc-full-width="true"';
    if ( $full_width == 'stretch_row_content' || $full_width == 'stretch_row_content_no_spaces' ) {
        echo ' data-vc-stretch-content="true"';
    }
} ?> <?php echo $style; ?>><?php
echo wpb_js_remove_wpautop( $content );
?></div><?php echo $this->endBlockComment( 'row' );
echo '<div class="vc_row-full-width"></div>';
