<?php
/**
 * Widget Name: Login Form Widget
 * Description: A widget that allows a Login Form to be added to a sidebar.
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
 * Login Form Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 1.0.0
 */
class Login_Form_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'loginform',
			'description' => esc_html__( 'A user login form.', 'u-design' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'   => 150,
			'height'  => 350,
			'id_base' => 'loginform-widget',
		);

		/* Create the widget. */
		parent::__construct( 'loginform-widget', esc_html__( 'U-Design: Login Form', 'u-design' ), $widget_ops, $control_ops );
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

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		global $user_identity, $user_level; ?>
		<?php if ( is_user_logged_in() ) : ?>
					<?php esc_html_e( 'You are logged in as', 'u-design' ); ?> <strong><?php echo $user_identity; ?></strong>.
			<ul>
				<li><?php wp_register(); ?></li>
				<li><a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>"><?php esc_attr_e( 'Logout', 'u-design' ); ?></a></li>
			</ul>
		<?php else : ?>
			<div class="u-design-login-widget-fields-wrapper">
				<form action="<?php echo esc_url( site_url() ); ?>/wp-login.php" method="post">
					<p>
						<label for="log"><?php esc_html_e( 'User', 'u-design' ); ?><br />
							<input type="text" name="log" id="log" value="" size="20" />
						</label><br />
						<label for="pwd"><?php esc_html_e( 'Password', 'u-design' ); ?><br />
							<input type="password" name="pwd" id="pwd" size="20" />
						</label>
						<div>
							<input type="submit" name="submit" value="<?php esc_attr_e( 'Login', 'u-design' ); ?>" class="button" />
							<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> <?php esc_html_e( 'Remember me', 'u-design' ); ?></label>
						</div>
					</p>
					<input type="hidden" name="redirect_to" value="<?php echo esc_url( get_permalink() ); ?>"/>
				</form>
			</div>
			<?php if ( get_option( 'users_can_register' ) ) : ?>
				<li><a href="<?php echo esc_url( home_url() ); ?>/wp-login.php?action=register"><?php esc_attr_e( 'Register', 'u-design' ); ?></a></li>
			<?php endif; ?>
			<ul>
				<li><a href="<?php echo esc_url( home_url() ); ?>/wp-login.php?action=lostpassword"><?php esc_attr_e( 'Recover password', 'u-design' ); ?></a></li>
			</ul>
			<?php
		endif;

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
		$defaults = array( 'title' => esc_html__( 'Login Form', 'u-design' ) );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'u-design' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<?php
	}
}

