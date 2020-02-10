<?php
/**
 * Widget Name: Recent Posts with Excerpts Widget
 * Description: A widget that allows to display a recent posts with excerpts and date and author info (optional).
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
class Latest_Posts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
		$widget_ops = array(
			'classname'   => 'widget_latest_posts',
			'description' => esc_html__( 'The most recent posts with teaser text', 'u-design' ),
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'   => 150,
			'height'  => 350,
			'id_base' => 'latest-posts-widget',
		);

		/* Create the widget. */
		parent::__construct( 'latest-posts-widget', esc_html__( 'U-Design: Recent Posts', 'u-design' ), $widget_ops, $control_ops );

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
		$title              = apply_filters( 'widget_title', $instance['title'] );
		$category_id        = $instance['category_id'];
		$use_current_cat    = isset( $instance['use_current_cat'] ) ? $instance['use_current_cat'] : false;
		$num_posts          = absint( $instance['num_posts'] );
		$post_offset        = absint( $instance['post_offset'] );
		$num_words_limit    = absint( $instance['num_words_limit'] );
		$show_date_author   = isset( $instance['show_date_author'] ) ? $instance['show_date_author'] : false;
		$show_more_link     = isset( $instance['show_more_link'] ) ? $instance['show_more_link'] : false;
		$more_link_text     = isset( $instance['more_link_text'] ) ? $instance['more_link_text'] : __( 'Read more', 'u-design' );
		$show_thumbs        = isset( $instance['show_thumbs'] ) ? $instance['show_thumbs'] : false;
		$remove_thumb_frame = isset( $instance['remove_thumb_frame'] ) ? $instance['remove_thumb_frame'] : false;
		$thumb_frame_shadow = isset( $instance['thumb_frame_shadow'] ) ? $instance['thumb_frame_shadow'] : false;
		$default_thumb      = isset( $instance['default_thumb'] ) ? $instance['default_thumb'] : false;
		$post_thumb_width   = absint( $instance['post_thumb_width'] );
		$post_thumb_height  = absint( $instance['post_thumb_height'] );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		// Do the logic for when "Use Current Category" option has been selected.
		// The current category should only be assigned when on Category or Archive page.
		$queried_object_id = get_queried_object_id();
		if ( $use_current_cat && is_category( $queried_object_id ) ) {
			$category_id = $queried_object_id;
		}

		// Display the Latest Posts accordingly.
		$cats_to_include = ( $category_id ) ? "cat={$category_id}&" : '';
		$num_posts_query = new WP_Query( "{$cats_to_include}showposts={$num_posts}&offset={$post_offset}" );
		if ( $num_posts_query->have_posts() ) : ?>
			<div class="latest_posts">
			<ul class="small-thumb">
				<?php
				while ( $num_posts_query->have_posts() ) :
					$num_posts_query->the_post();
					?>
					<li>
						<?php
						if ( $show_thumbs ) {
							if ( function_exists( 'udesign_get_post_thumb' ) ) {
								echo udesign_get_post_thumb( $num_posts_query->post->ID, $remove_thumb_frame, $thumb_frame_shadow, $post_thumb_width, $post_thumb_height, 'alignleft', $default_thumb );
							}
						}
						?>
						<a class="teaser-title" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php if ( $show_date_author ) : ?>
							<?php $the_author_page_link = ( function_exists( 'udesign_get_the_author_page_link' ) ) ? udesign_get_the_author_page_link() : ''; ?>
							<?php /* translators: 1: date, 2: author name */ ?>
							<div class="date-author"><?php printf( __( '%1$s by %2$s ', 'u-design' ), get_the_date(), $the_author_page_link ); ?></div>
						<?php endif; ?>
						<div class="teaser-content">
						<?php
						if ( $num_words_limit ) {
							echo $this->custom_string_length_by_words( get_the_excerpt(), $num_words_limit ) . '...';
						}
						?>
						</div>
						<?php
						if ( $show_more_link ) :
							if ( is_rtl() ) :
								?>
								<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="read-more-align-left"><span><?php echo $more_link_text; ?></span> &larr;</a>
								<?php
							else :
								?>
								<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="read-more-align-right"><span><?php echo $more_link_text; ?></span> &rarr;</a>
								<?php
							endif;
						endif;
						?>
						<div class="clear"></div>
					</li>
					<?php
				endwhile;
				wp_reset_postdata(); // Restore original Post Data.
				?>
			</ul>
			</div><!-- end widget_recent_posts -->
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

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title']           = wp_strip_all_tags( $new_instance['title'] );
		$instance['num_posts']       = wp_strip_all_tags( $new_instance['num_posts'] );
		$instance['post_offset']     = wp_strip_all_tags( $new_instance['post_offset'] );
		$instance['num_words_limit'] = wp_strip_all_tags( $new_instance['num_words_limit'] );
		/* No need to strip tags for dropdowns and checkboxes. */
		$instance['category_id']        = $new_instance['category_id'];
		$instance['use_current_cat']    = $new_instance['use_current_cat'];
		$instance['show_date_author']   = $new_instance['show_date_author'];
		$instance['show_more_link']     = $new_instance['show_more_link'];
		$instance['more_link_text']     = wp_strip_all_tags( $new_instance['more_link_text'] );
		$instance['show_thumbs']        = $new_instance['show_thumbs'];
		$instance['remove_thumb_frame'] = $new_instance['remove_thumb_frame'];
		$instance['thumb_frame_shadow'] = $new_instance['thumb_frame_shadow'];
		$instance['default_thumb']      = $new_instance['default_thumb'];
		$instance['post_thumb_width']   = ( $new_instance['post_thumb_width'] ) ? absint( wp_strip_all_tags( $new_instance['post_thumb_width'] ) ) : 60;
		$instance['post_thumb_height']  = ( $new_instance['post_thumb_height'] ) ? absint( wp_strip_all_tags( $new_instance['post_thumb_height'] ) ) : 60;

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
			'title'              => esc_html__( 'Latest Posts', 'u-design' ),
			'category_id'        => '',
			'use_current_cat'    => false,
			'num_posts'          => 3,
			'post_offset'        => 0,
			'num_words_limit'    => 13,
			'show_date_author'   => false,
			'show_more_link'     => false,
			'more_link_text'     => esc_html__( 'Read more', 'u-design' ),
			'show_thumbs'        => true,
			'remove_thumb_frame' => false,
			'thumb_frame_shadow' => false,
			'default_thumb'      => true,
			'post_thumb_width'   => 60,
			'post_thumb_height'  => 60,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'u-design' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>

		<!-- Show Categories -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category_id' ); ?>"><?php esc_html_e( 'Pick a specific category:', 'u-design' ); ?></label>
			<?php wp_dropdown_categories( 'show_option_all=All&hierarchical=1&orderby=name&selected=' . $instance['category_id'] . '&name=' . $this->get_field_name( 'category_id' ) . '&class=widefat' ); ?>
		</p>

		<!-- Show select current category checkbox -->
		<p>
			<label for="<?php echo $this->get_field_id( 'use_current_cat' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $instance['use_current_cat'], true ); ?> id="<?php echo $this->get_field_id( 'use_current_cat' ); ?>" name="<?php echo $this->get_field_name( 'use_current_cat' ); ?>" value="1" <?php checked( '1', $instance['use_current_cat'] ); ?> />
				<?php esc_html_e( 'Use the current category (if on category page).', 'u-design' ); ?>
			</label>
		</p>

		<!-- Number of Posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'u-design' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'num_posts' ); ?>" type="text" name="<?php echo $this->get_field_name( 'num_posts' ); ?>" value="<?php echo $instance['num_posts']; ?>" size="2" maxlength="2" />
			<br />
			<small><?php esc_html_e( '(at most 15)', 'u-design' ); ?></small>
		</p>

		<!-- Post Offset -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_offset' ); ?>"><?php esc_html_e( 'Number of posts to skip:', 'u-design' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'post_offset' ); ?>" type="text" name="<?php echo $this->get_field_name( 'post_offset' ); ?>" value="<?php echo $instance['post_offset']; ?>" size="2" maxlength="2" />
			<br />
			<small><?php esc_html_e( '(offset from latest)', 'u-design' ); ?></small>
		</p>

		<!-- Number of Words Limit -->
		<p>
			<label for="<?php echo $this->get_field_id( 'num_words_limit' ); ?>"><?php esc_html_e( 'Limit the number of words to show for each post:', 'u-design' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'num_words_limit' ); ?>" type="text" name="<?php echo $this->get_field_name( 'num_words_limit' ); ?>" value="<?php echo $instance['num_words_limit']; ?>" size="2" maxlength="2" />
			<br />
			<small><?php esc_html_e( '(Could also be limited by "Excerpt Length" defined in the theme\'s options page)', 'u-design' ); ?></small>
		</p>

		<!-- Show date & author info checkbox -->
		<p>
			<label for="<?php echo $this->get_field_id( 'show_date_author' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_date_author'], true ); ?> id="<?php echo $this->get_field_id( 'show_date_author' ); ?>" name="<?php echo $this->get_field_name( 'show_date_author' ); ?>" value="1" <?php checked( '1', $instance['show_date_author'] ); ?> />
				<?php esc_html_e( 'Show date & author info', 'u-design' ); ?>
			</label>
		</p>

		<!-- Show "Read more ->" link checkbox -->
		<p>
			<label style="width:100%; margin-bottom:5px; float:left;" for="<?php echo $this->get_field_id( 'show_more_link' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_more_link'], true ); ?> id="<?php echo $this->get_field_id( 'show_more_link' ); ?>" name="<?php echo $this->get_field_name( 'show_more_link' ); ?>" value="1" <?php checked( '1', $instance['show_more_link'] ); ?> />
				<?php esc_html_e( 'Show "more" link.', 'u-design' ); ?>
			</label>
						<br />
			<label style="margin-left: 25px;" for="<?php echo $this->get_field_id( 'more_link_text' ); ?>"><?php esc_html_e( 'The text:', 'u-design' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'more_link_text' ); ?>" type="text" name="<?php echo $this->get_field_name( 'more_link_text' ); ?>" value="<?php echo $instance['more_link_text']; ?>" size="20" maxlength="200" />
		</p>

		<!-- Show Thumbnails -->
		<p>
			<label for="<?php echo $this->get_field_id( 'show_thumbs' ); ?>">
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_thumbs'], true ); ?> id="<?php echo $this->get_field_id( 'show_thumbs' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbs' ); ?>" value="1" <?php checked( '1', $instance['show_thumbs'] ); ?> />
				<?php esc_html_e( 'Show thumbnails', 'u-design' ); ?>
			</label>
		</p>

		<?php
		if ( $instance['show_thumbs'] ) :
			?>
			Thumbnail Properties:
			<div style="border: 1px solid #DDD; background-color: #F8F8F1; padding:7px; margin:10px 0 17px;">
				<!-- Thumbnail Image Frame ON/OFF -->
				<p>
					<label for="<?php echo $this->get_field_id( 'remove_thumb_frame' ); ?>">
						<input class="checkbox" type="checkbox" <?php checked( $instance['remove_thumb_frame'], true ); ?> id="<?php echo $this->get_field_id( 'remove_thumb_frame' ); ?>" name="<?php echo $this->get_field_name( 'remove_thumb_frame' ); ?>" value="1" <?php checked( '1', $instance['remove_thumb_frame'] ); ?> />
						<?php esc_html_e( 'Remove thumbnail frame', 'u-design' ); ?>
					</label>
				</p>

				<!-- Thumbnail shadow ON/OFF -->
				<p>
					<label for="<?php echo $this->get_field_id( 'thumb_frame_shadow' ); ?>">
						<input class="checkbox" type="checkbox" <?php checked( $instance['thumb_frame_shadow'], true ); ?> id="<?php echo $this->get_field_id( 'thumb_frame_shadow' ); ?>" name="<?php echo $this->get_field_name( 'thumb_frame_shadow' ); ?>" value="1" <?php checked( '1', $instance['thumb_frame_shadow'] ); ?> />
						<?php esc_html_e( 'Show thumbnail frame shadow', 'u-design' ); ?>
					</label>
				</p>

				<!-- Default/Fallback Thumbnail ON/OFF -->
				<p>
					<label for="<?php echo $this->get_field_id( 'default_thumb' ); ?>">
						<input class="checkbox" type="checkbox" <?php checked( $instance['default_thumb'], true ); ?> id="<?php echo $this->get_field_id( 'default_thumb' ); ?>" name="<?php echo $this->get_field_name( 'default_thumb' ); ?>" value="1" <?php checked( '1', $instance['default_thumb'] ); ?> />
						<?php esc_html_e( 'Use default image (when no image found)', 'u-design' ); ?>
					</label>
				</p>

				<!-- Thumb Dimension -->
				<p>
					<label for="<?php echo $this->get_field_id( 'post_thumb_width' ); ?>"><?php esc_html_e( 'Thumbnail Dimensions:', 'u-design' ); ?></label><br />
					<input id="<?php echo $this->get_field_id( 'post_thumb_width' ); ?>" type="text" name="<?php echo $this->get_field_name( 'post_thumb_width' ); ?>" value="<?php echo $instance['post_thumb_width']; ?>" size="5" maxlength="4" />
					<span> X </span>
					<input id="<?php echo $this->get_field_id( 'post_thumb_height' ); ?>" type="text" name="<?php echo $this->get_field_name( 'post_thumb_height' ); ?>" value="<?php echo $instance['post_thumb_height']; ?>" size="5" maxlength="4" />
					<br />
					<?php esc_html_e( '(Width X Height) in pixels', 'u-design' ); ?>
				</p>
			</div>
			<?php
		endif;
	}

	/**
	 * Customize the length of the excerpt by word count.
	 *
	 * @param string $string The original excerpt.
	 * @param int    $limit The limit for the number of words.
	 * @return string The modified excerpt with specific number of words.
	 */
	public function custom_string_length_by_words( $string, $limit ) {
		$array_of_words = explode( ' ', $string, ( $limit + 1 ) );
		if ( count( $array_of_words ) > $limit ) {
			array_pop( $array_of_words );
		}
		return implode( ' ', $array_of_words );
	}
}


