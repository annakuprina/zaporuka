<?php
/**
 * Widget Name: Custom Category Widget
 * Description: A widget that allows to display a single category's descendants.
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
 * Custom Category Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 1.0.0
 */
class Custom_Category_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'widget_categories',
			'description' => esc_html__( "A list or dropdown of a single category's descendants.", 'u-design' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'   => 150,
			'height'  => 350,
			'id_base' => 'custom-category-widget',
		);

		/* Create the widget. */
		parent::__construct( 'custom-category-widget', esc_html__( 'U-Design: Custom Category', 'u-design' ), $widget_ops, $control_ops );
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
		$title       = apply_filters( 'widget_title', $instance['title'] );
		$category_id = $instance['category_id'];
		if ( function_exists( 'icl_get_default_language' ) ) {
			udesign_wpml_replace_category_id( $category_id );
		}
		$show_as_dropdown = isset( $instance['show_as_dropdown'] ) ? $instance['show_as_dropdown'] : false;
		$show_post_counts = isset( $instance['show_post_counts'] ) ? $instance['show_post_counts'] : false;
		$show_hierarchy   = isset( $instance['show_hierarchy'] ) ? $instance['show_hierarchy'] : false;

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		/* If a category was selected, display it. */
		if ( $category_id ) : ?>
			<?php if ( $show_as_dropdown ) : ?>
				<ul>
					<?php
					$show_option_none = __( 'Select Category', 'u-design' );
					wp_dropdown_categories( "show_option_none={$show_option_none}&id=cat-{$category_id}&name=cat-{$category_id}&orderby=name&hierarchical={$show_hierarchy}&show_count={$show_post_counts}&use_desc_for_title=0&child_of=" . $category_id );
					?>
					<script type='text/javascript'>
						/* <![CDATA[ */
						(function() {
							var customCatDropdown = document.getElementById("cat-<?php echo esc_attr( $category_id ); ?>");
							function onCustomCatChange() {
								if ( customCatDropdown.options[customCatDropdown.selectedIndex].value > 0 ) {
									location.href = "<?php echo esc_url( home_url() ); ?>/?cat="+customCatDropdown.options[customCatDropdown.selectedIndex].value;
								}
							}
							customCatDropdown.onchange = onCustomCatChange;
						})();
						/* ]]> */
					</script>
				</ul>
			<?php else : ?>
				<ul>
					<?php wp_list_categories( "title_li=&orderby=name&hierarchical={$show_hierarchy}&show_count={$show_post_counts}&use_desc_for_title=0&child_of=".$category_id ); ?>
				</ul>
			<?php endif; ?>
		<?php endif; ?>
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

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = wp_strip_all_tags( $new_instance['title'] );

		/* No need to strip tags for categories. */
		$instance['category_id']      = $new_instance['category_id'];
		$instance['show_as_dropdown'] = $new_instance['show_as_dropdown'];
		$instance['show_post_counts'] = $new_instance['show_post_counts'];
		$instance['show_hierarchy']   = $new_instance['show_hierarchy'];

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
		$defaults = array( 'title' => esc_html__( 'Categories', 'u-design' ), 'category_id' => '', 'show_as_dropdown' => false, 'show_post_counts' => false, 'show_hierarchy' => false );
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'u-design'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>

		<!-- Show Categories -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category_id' ); ?>"><?php esc_html_e('Category to be displayed:', 'u-design'); ?></label>
			<?php wp_dropdown_categories( 'show_option_all=Select Category&hierarchical=1&orderby=name&selected=' . $instance['category_id'] . '&name=' . $this->get_field_name( 'category_id' ) . '&class=widefat' ); ?>

		</p>

		<p>
			<!-- Show as dropdown checkbox -->
			<label for="<?php echo $this->get_field_id( 'show_as_dropdown' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_as_dropdown'], true ); ?> id="<?php echo $this->get_field_id( 'show_as_dropdown' ); ?>" name="<?php echo $this->get_field_name( 'show_as_dropdown' ); ?>" value="1" <?php checked( '1', $instance['show_as_dropdown'] ); ?> />
				<?php esc_html_e('Show as dropdown', 'u-design'); ?>
			</label><br />

			<!-- Show post counts checkbox -->
			<label for="<?php echo $this->get_field_id( 'show_post_counts' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_post_counts'], true ); ?> id="<?php echo $this->get_field_id( 'show_post_counts' ); ?>" name="<?php echo $this->get_field_name( 'show_post_counts' ); ?>" value="1" <?php checked( '1', $instance['show_post_counts'] ); ?> />
				<?php esc_html_e('Show post counts', 'u-design'); ?>
			</label><br />

			<!-- Show hierarchy checkbox -->
			<label for="<?php echo $this->get_field_id( 'show_hierarchy' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_hierarchy'], true ); ?> id="<?php echo $this->get_field_id( 'show_hierarchy' ); ?>" name="<?php echo $this->get_field_name( 'show_hierarchy' ); ?>" value="1" <?php checked( '1', $instance['show_hierarchy'] ); ?> />
				<?php esc_html_e( 'Show hierarchy', 'u-design' ); ?>
			</label>
		</p>

		<?php
	}
}


