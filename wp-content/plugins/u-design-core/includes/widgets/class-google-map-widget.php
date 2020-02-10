<?php
/**
 * Widget Name: Google Map Widget
 * Description: A widget that allows a Google Map to be added to a sidebar.
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
 * Google Map Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 1.0.0
 */
class Google_Map_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'widget_googlemap',
			'description' => esc_html__( 'A Google Map widget.', 'u-design' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'   => 350,
			'height'  => 350,
			'id_base' => 'googlemap-widget',
		);

		/* Create the widget. */
		parent::__construct( 'googlemap-widget', esc_html__( 'U-Design: Google Map', 'u-design' ), $widget_ops, $control_ops );
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
		$title          = apply_filters( 'widget_title', $instance['title'] );
		$googlemap_code = $instance['googlemap_code'];

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $googlemap_code ) {
			echo $googlemap_code;
		}

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
		/* Strip slashes (important for text inputs). */
		$instance['googlemap_code'] = stripslashes( $new_instance['googlemap_code'] );

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
		$defaults = array(
			'title'          => esc_html__( 'Google Map', 'u-design' ),
			'googlemap_code' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'u-design' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<!-- Widget Title: Text Area Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'googlemap_code' ); ?>"><?php esc_html_e( 'Google Map Code:', 'u-design' ); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'googlemap_code' ); ?>" class="code" style="width: 100%;" rows="10" cols="20" name="<?php echo $this->get_field_name( 'googlemap_code' ); ?>">
				<?php
				if ( $instance['googlemap_code'] ) {
					echo esc_attr( $instance['googlemap_code'] );
				}
				?>
			</textarea>
		</p>
		<?php
	}
}

