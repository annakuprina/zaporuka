<?php
/**
 * Widget Name: U-Design: Subpages Widget
 * Description: A widget that allows a Subpages to be added to a sidebar.
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
 * Subpages Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 1.0.0
 */
class Subpages_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'widget_subpages',
			'description' => esc_html__( 'Display subpages of the present page.', 'u-design' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'   => 300,
			'height'  => 350,
			'id_base' => 'subpages-widget',
		);

		/* Create the widget. */
		parent::__construct( 'subpages-widget', esc_html__( 'U-Design: Subpages', 'u-design' ), $widget_ops, $control_ops );
	}

	/**
	 * Echoes the widget content.
	 *
	 * @param array $args Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 * @return void
	 */
	public function widget( $args, $instance ) {

		global $post;
		// Get the page id outside the loop (check if WPML plugin is installed and use the WPML way of getting the page ID in the current language).
		$page_id          = ( function_exists( 'icl_object_id' ) && function_exists( 'icl_get_default_language' ) ) ? icl_object_id( $post->ID, 'page', true, ICL_LANGUAGE_CODE ) : $post->ID;
		$curr_page_parent = $post->post_parent;

		/* Our variables from the widget settings. */
		$title   = apply_filters( 'widget_title', $instance['title'] );
		$sortby  = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];

		if ( 'menu_order' === $sortby ) {
			$sortby = 'menu_order, post_title';
		}

		/* Display the subpages: */
		$child_of = ( $curr_page_parent ) ? $curr_page_parent : $page_id;

		/**
		 * Filter the arguments for the 'U-Design: Subpages' widget.
		 *
		 * @since 2.7.5
		 *
		 * @see wp_list_pages()
		 *
		 * @param array $args An array of arguments to retrieve the pages list.
		 */
		$children = wp_list_pages(
			apply_filters(
				'udesign_get_subpages_widget_args',
				array(
					'title_li'    => '',
					'echo'        => 0,
					'sort_column' => $sortby,
					'exclude'     => $exclude,
					'child_of'    => $child_of,
				)
			)
		);

		if ( $children ) :
			echo $args['before_widget'];

			/* Display the widget title if one was input, if not display the parent page title instead. */
			if ( $title ) :
				echo $args['before_title'] . $title . $args['after_title'];
			else :
				?>
				<h3>
					<?php
					$parent = get_post( $post->post_parent );
					echo esc_html( $parent->post_title );
					?>
				</h3>
				<?php
			endif;
			?>
			<ul>
				<?php echo $children; ?>
			</ul>
			<?php
			echo $args['after_widget'];
		endif;

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
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = wp_strip_all_tags( $new_instance['exclude'] );

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
			'sortby'  => 'menu_order',
			'title'   => '',
			'exclude' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$exclude  = esc_attr( $instance['exclude'] );
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'u-design' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
			<br />
			<?php esc_html_e( 'Leave the Title field blank if you would like to display the parent page Title instead.', 'u-design' ); ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'sortby' ); ?>"><?php esc_attr_e( 'Sort by:', 'u-design' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'sortby' ); ?>" id="<?php echo $this->get_field_id( 'sortby' ); ?>" class="widefat">
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php esc_attr_e( 'Page title', 'u-design' ); ?></option>
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php esc_attr_e( 'Page order', 'u-design' ); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php esc_attr_e( 'Page ID', 'u-design' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>"><?php esc_attr_e( 'Exclude:', 'u-design' ); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" id="<?php echo $this->get_field_id( 'exclude' ); ?>" class="widefat" />
			<br />
			<small><?php esc_html_e( 'Page IDs, separated by commas.', 'u-design' ); ?></small>
		</p>
		<?php
	}
}

