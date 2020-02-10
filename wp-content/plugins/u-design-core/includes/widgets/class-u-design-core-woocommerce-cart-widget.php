<?php
/**
 * U-Design-WooCommerce Cart Widget
 *
 * A widget that displayes account info such as Login | Register | Cart Info
 *
 * @link       https://themeforest.net/user/andondesign
 * @since      1.0.0
 *
 * @package    U_Design_Core
 * @subpackage U_Design_Core/includes/widgets
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * U-Design-WooCommerce Cart Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. Nice!
 *
 * @since 1.0.0
 */
class U_Design_Core_Woocommerce_Cart_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'udesign-wc-cart',
			'description' => esc_html__( 'A widget that displays cart info.', 'u-design-core' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'   => 150,
			'height'  => 350,
			'id_base' => 'udesign-wc-cart-widget',
		);

		/* Create the widget. */
		parent::__construct( 'udesign-wc-cart-widget', esc_html__( 'U-Design: WooCommerce Cart', 'u-design-core' ), $widget_ops, $control_ops );
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 * @return void
	 */
	public function widget( $args, $instance ) {

		/* Our variables from the widget settings. */
		$title = apply_filters( 'widget_title', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $args['before_widget'];

		/*
		 * To display the widget title ONLY if the widget is used in widget area other than "Top Area Social Media" use:
		 * 		if ( $title && ( $args['id'] !== 'top-area-social-media' ) ) {
		 */
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		// Apply the following ONLY if the widget is used in "Top Area Social Media" widget area.
		if ( 'top-area-social-media' === $args['id'] ) :
			global $udesign_options;
			?>
			<style>
				.social-media-area .udesign-wc-cart,
				.social-media-area .udesign-wc-cart a,
				.social-media-area .udesign-wc-cart h3.social_media_title { color:#<?php echo $udesign_options['top_text_color']; ?>; }
			</style>
			<?php
		endif;
		?>
		<div class="udesign-woocommerce-my-cart">
			<?php if ( is_user_logged_in() ) : ?>
				<a class="ud-wc-cart-my-account" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" title="<?php esc_attr_e( 'My Account', 'u-design-core' ); ?>"><?php esc_html_e( 'My Account', 'u-design-core' ); ?></a> <span class="ud-wc-cart-divider">|</span> 
				<a class="ud-wc-cart-logout" href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>" title="<?php esc_attr_e( 'Logout', 'u-design-core' ); ?>"><?php esc_html_e( 'Logout', 'u-design-core' ); ?></a> <span class="ud-wc-cart-divider">|</span> 
			<?php else : ?>
				<a class="ud-wc-cart-login" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" title="<?php esc_attr_e( 'Login', 'u-design-core' ); ?>"><?php esc_html_e( 'Login', 'u-design-core' ); ?></a> <span class="ud-wc-cart-divider">|</span> 
				<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
					<a class="ud-wc-cart-register" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" title="<?php esc_attr_e( 'Register', 'u-design-core' ); ?>"><?php esc_html_e( 'Register', 'u-design-core' ); ?></a> <span class="ud-wc-cart-divider">|</span> 
				<?php endif; ?>
			<?php endif; ?>

			<div class="udesign-wc-cart-dropdown-wrapper">
				<i class="fa fa-shopping-basket" style="font-size:1.1em;"><!-- icon --></i> 
				<a class="udesign-wc-cart-contents cart-contents-count-<?php echo WC()->cart->get_cart_contents_count(); ?>" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'u-design-core' ); ?>">
					<?php
					echo sprintf(
						/* translators: 1: cart total, 2: cart contents count */
						__( 'Cart: %1$s %2$s ', 'u-design-core' ),
						WC()->cart->get_cart_total(),
						'<span class="ud-wc-cart-num-items">( ' . WC()->cart->get_cart_contents_count() . ' )</span>'
					)
					?>
				</a>
			</div>
		</div>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * This function should check that `$new_instance` is set correctly. The newly-calculated
	 * value of `$instance` should be returned. If false is returned, the instance won't be
	 * saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title to remove HTML (important for text inputs). */
		$instance['title'] = wp_strip_all_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @param array $instance Current settings.
	 * @return void
	 */
	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'u-design-core' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<?php
	}
}

