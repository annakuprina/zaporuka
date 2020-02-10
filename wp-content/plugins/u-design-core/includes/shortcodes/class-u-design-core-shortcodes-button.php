<?php
/**
 * U-Design Shortcodes Button
 *
 * Provide an easy way to insert shortcodes into TinyMCE editor or classic blcok (Gutenberg).
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


if ( ! class_exists( 'U_Design_Core_Shortcodes_Button' ) ) {

	/**
	 * U-Design Shortcodes Button
	 * This class creates the button and all menus associated with it used to
	 * insert shortcodes into the WordPress Classic editor as well as classic block.
	 *
	 * @since 1.0.0
	 */
	class U_Design_Core_Shortcodes_Button {

		/**
		 * The version of this plugin.
		 *
		 * @since 1.0.0
		 * @access private
		 * @var string $version The current version of this plugin.
		 */
		private $version;

		/**
		 * Main Constructor
		 *
		 * @since 1.0.0
		 * @access public
		 * @param string $version The version of this plugin.
		 */
		public function __construct( $version ) {

			$this->version = $version;

		}

		/**
		 * Admin notice for removing the old 'U-Design Shortcodes Button' plugin.
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function udesign_core_remove_old_shortcodes_plugin_admin_notice() {
			// Determine whether the 'U-Design Shortcodes Button' plugin is currently active.
			$udesign_shortcodes_button_plugin = ( in_array( 'udesign-shortcodes-button/udesign-shortcodes-button.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) ? true : false;

			if ( current_user_can( 'manage_options' ) && $udesign_shortcodes_button_plugin ) {
				/**
				 * Display the admin notice.
				 */
				function udesign_core_remove_old_shortcodes_plugin_notice() {
					?>
					<div class="notice notice-warning is-dismissible">
						<p><strong>U-DESIGN THEME MESSAGE:</strong> Please deactivate and delete the <strong>U-Design Shortcodes Button</strong> plugin, it's functionality has been included with the <strong>U-Design Core</strong> plugin hence making it obsolete.</p>
					</div>
					<?php
				}
				add_action( 'admin_notices', 'udesign_core_remove_old_shortcodes_plugin_notice' );
			}
		}

		/**
		 * Add filters for the TinyMCE button.
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function add_mce_button() {

			// Check user permissions.
			if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
				return;
			}

			// Check if WYSIWYG is enabled.
			if ( 'true' == get_user_option( 'rich_editing' ) ) {
				add_filter( 'mce_external_plugins', array( $this, 'add_tinymce_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'register_mce_button' ) );
			}

		}

		/**
		 * Loads the TinyMCE button js file.
		 *
		 * @since 1.0.0
		 * @param array $plugin_array An array of plugins.
		 * @access public
		 * @return array An array of plugins.
		 */
		public function add_tinymce_plugin( $plugin_array ) {
			$plugin_array['udesign_core_shortcodes_mce_button'] = plugins_url( '/tinymce/udesign-shortcodes-tinymce.js', __FILE__ );
			return $plugin_array;
		}

		/**
		 * Adds the TinyMCE button to the post editor buttons
		 *
		 * @since 1.0.0
		 * @param array $buttons An array of buttons.
		 * @access public
		 * @return array The array of buttons.
		 */
		public function register_mce_button( $buttons ) {
			array_push( $buttons, 'udesign_core_shortcodes_mce_button' );
			return $buttons;
		}

		/**
		 * Loads custom CSS for the TinyMCE editor button
		 *
		 * @since 1.0.0
		 * @access public
		 */
		public function mce_css() {
			wp_enqueue_style( 'udesign_core_shortcodes-tc', plugin_dir_url( __FILE__ ) . 'tinymce/udesign-shortcodes-tinymce-style.css', array(), $this->version, 'all' );
		}

		/**
		 * Function to fetch categories list in the form:
		 *   [
		 *      { text: 'Category1 Name', value: 'Category1 ID' },
		 *      { text: 'Category2 Name', value: 'Category2 ID' },
		 *      { text: 'Category3 Name', value: 'Category3 ID' }
		 *   ]
		 *
		 * @since  2.0
		 * @return void
		 */
		public function udesign_generate_cats_list() {

						$output_categories = array();
						$categories        = get_terms(
							array(
								'taxonomy'   => 'category',
								'order'      => 'ASC',
								'hide_empty' => 0,
							)
						);
			foreach ( $categories as $category ) {
					$output_categories[] = array(
						'text'  => $category->name . ' - (' . __( 'ID:', 'u-design-core' ) . ' ' . $category->term_id . ')',
						'value' => $category->term_id,
					);
			}
			wp_send_json( $output_categories );

		}

		/**
		 * Function to secure the ajax call
		 *
		 * @since  2.0
		 * @return string
		 */
		public function udesign_list_ajax() {
			// Check for nonce.
			check_ajax_referer( 'udesign-shortcodes-button-nonce', 'security' );
			$get_categories_list = $this->udesign_generate_cats_list();
			return $get_categories_list;
		}

		/**
		 * Function to pass the categories list to tinyMCE with ajax script
		 *
		 * @since  2.0
		 * @return void
		 */
		public function udesign_save_cats_list() {
			// Create nonce.
			global $pagenow;
			if ( 'admin.php' !== $pagenow ) {
				$nonce = wp_create_nonce( 'udesign-shortcodes-button-nonce' );
				?>
				<script type="text/javascript">
					jQuery( document ).ready( function( $ ) {
						var data = {
							'action'	: 'udesign_save_cats_list',		// wp ajax action.
							'security'	: '<?php echo $nonce; ?>'		// nonce value created earlier.
						};

						// Fire ajax.
						jQuery.post( ajaxurl, data, function( response ) {
							// If nonce fails then not authorized else settings are saved.
							if( response === '-1' ) {
								// Do nothing.
								console.log('error');
							} else {
								if ( typeof( tinyMCE ) != 'undefined' ) {
									if ( tinyMCE.activeEditor != null ) {
										tinyMCE.activeEditor.settings.udesignCategoriesList = response;
									}
								}
							}
						});
					});
				</script>
				<?php
			}
		}

	}

}
