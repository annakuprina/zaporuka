<?php
/**
 * U-Design Shortcodes
 *
 * Declare all the shortcodes.
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


if ( ! class_exists( 'U_Design_Core_Shortcodes' ) ) {

	/**
	 * U-Design Shortcodes
	 * This class defines all the shortcodes.
	 *
	 * @since 1.0.0
	 */
	class U_Design_Core_Shortcodes {

		/**
		 * Shortcode: "Read More ->" Link
		 *
		 * Usage: [read_more text="Read more" title="Read More..." url="http://www.example.com/" align="left" target="_blank"]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function read_more_func( $atts ) {
			$atts = shortcode_atts(
				array(
					'text'   => esc_html__( 'Read more', 'u-design' ),
					'title'  => '',
					'url'    => '#',
					'align'  => 'left',
					'target' => '',
				),
				$atts,
				'read_more'
			);

			$target      = ( '_blank' === $atts['target'] ) ? ' target="_blank"' : '';
			$align_class = ( 'right' === $atts['align'] ) ? '-align-right' : '-align-left';
			$more_arrow  = ( is_rtl() ) ? '&larr;' : '&rarr;';
			$html        = '<a class="read-more' . $align_class . '" href="' . $atts['url'] . '" title="' . $atts['title'] . '"' . $target . '><span>' . do_shortcode( $atts['text'] ) . '</span> ' . $more_arrow . '</a>';
			return $html;
		}

		/**
		 * Shortcode: Button
		 *
		 * Usage: [button text="Read more..." style="light" title="Nice Button" url="http://www.example.com/" align="left" target="_blank"]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function button_func( $atts ) {
			$atts = shortcode_atts(
				array(
					'text'   => esc_html__( 'Read more...', 'u-design' ),
					'style'  => 'dark',
					'title'  => '',
					'url'    => '#',
					'align'  => 'left',
					'target' => '',
				),
				$atts,
				'button'
			);

			$target      = ( '_blank' === $atts['target'] ) ? ' target="_blank"' : '';
			$style_class = ( 'dark' === $atts['style'] ) ? ' dark-button' : ' light-button';
			$align_class = '';
			$before      = $after = '<div class="clear"></div>';
			if ( 'right' === $atts['align'] ) {
				$align_class = ' align-btn-right';
			} elseif ( 'left' === $atts['align'] ) {
				$align_class = ' align-btn-left';
			} else { // Catch the 'center'.
				$before = '<div class="align-btn-center">';
				$after  = '</div>';
			}
			$html = '<a class="' . $style_class . $align_class . '" href="' . $atts['url'] . '" title="' . $atts['title'] . '"' . $target . '><span>' . do_shortcode( $atts['text'] ) . '</span></a>';
			return $before . $html . $after;
		}

		/**
		 * Shortcode: Small Button
		 *
		 * Usage: [small_button text="Read more..." style="light" title="Nice Button" url="http://www.example.com/" align="left" target="_blank"]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function small_button_func( $atts ) {
			$atts = shortcode_atts(
				array(
					'text'   => esc_html__( 'Read more...', 'u-design' ),
					'style'  => 'dark',
					'title'  => '',
					'url'    => '#',
					'align'  => 'left',
					'target' => '',
				),
				$atts,
				'small_button'
			);

			$target      = ( '_blank' === $atts['target'] ) ? ' target="_blank"' : '';
			$style_class = ( 'dark' === $atts['style'] ) ? ' small-dark-button' : ' small-light-button';
			$align_class = '';
			$before      = $after = '<div class="clear"></div>';
			if ( 'right' === $atts['align'] ) {
				$align_class = ' align-btn-right';
			} elseif ( 'left' === $atts['align'] ) {
				$align_class = ' align-btn-left';
			} else { // Catch the 'center'.
				$before = '<div class="align-btn-center">';
				$after  = '</div>';
			}
			$html = '<a class="' . $style_class . $align_class . '" href="' . $atts['url'] . '" title="' . $atts['title'] . '"' . $target . '><span>' . do_shortcode( $atts['text'] ) . '</span></a>';
			return $before . $html . $after;
		}

		/**
		 * Shortcode: Round Button
		 *
		 * Usage: Usage: [round_button text="Read more..." style="light" title="Nice Button" url="http://www.example.com/" align="left" target="_blank"]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function round_button_func( $atts ) {
			$atts        = shortcode_atts(
				array(
					'text'   => esc_html__( 'Read more...', 'u-design' ),
					'style'  => 'dark',
					'title'  => '',
					'url'    => '#',
					'align'  => 'left',
					'target' => '',
				),
				$atts,
				'round_button'
			);
			$target      = ( '_blank' === $atts['target'] ) ? ' target="_blank"' : '';
			$style_class = ( 'dark' === $atts['style'] ) ? ' dark-round-button' : ' light-round-button';
			$align_class = '';
			$before      = $after = '<div class="clear"></div>';
			if ( 'right' === $atts['align'] ) {
				$align_class = ' align-btn-right';
			} elseif ( 'left' === $atts['align'] ) {
				$align_class = ' align-btn-left';
			} else { // Catch the 'center'.
				$before = '<div class="align-btn-center">';
				$after  = '</div>';
			}
			$html = '<a class="' . $style_class . $align_class . '" href="' . $atts['url'] . '" title="' . $atts['title'] . '"' . $target . '><span>' . do_shortcode( $atts['text'] ) . '</span></a>';
			return $before . $html . $after;
		}

		/**
		 * Shortcode: Custom Button
		 *
		 * Usage: [custom_button text="Read more..." title="Nice Button" url="http://www.example.com/" size="medium" bg_color="#FF5C00" text_color="#FFFFFF" align="left" target="_blank"]
		 *
		 * Options: align: left, right or center, size: small, medium, large and x-large, the rest are self explanatory...
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function custom_button_func( $atts ) {
			$atts        = shortcode_atts(
				array(
					'text'       => esc_html__( 'Read more...', 'u-design' ),
					'title'      => '',
					'url'        => '#',
					'size'       => 'medium',
					'bg_color'   => '#FF5C00',
					'text_color' => '#FFFFFF',
					'align'      => 'left',
					'target'     => '',
				),
				$atts,
				'custom_button'
			);
			$target      = ( '_blank' === $atts['target'] ) ? ' target="_blank"' : '';
			$align_class = $before = $after = '';
			if ( 'right' === $atts['align'] ) {
				$align_class = ' align-btn-right';
			} elseif ( 'left' === $atts['align'] ) {
				$align_class = ' align-btn-left';
			} elseif ( 'none' === $atts['align'] ) {
				$align_class = ' align-btn-none';
			} else { // Catch the 'center'.
				$before = '<div class="align-btn-center">';
				$after  = '</div>';
			}
			$html = '<a class="' . strtolower( $atts['size'] ) . ' custom-button' . $align_class . '" href="' . $atts['url'] . '" title="' . $atts['title'] . '"' . $target . '><span style="background-color:' . $atts['bg_color'] . '; color:' . $atts['text_color'] . '">' . do_shortcode( $atts['text'] ) . '</span></a>';
			return $before . $html . $after;
		}

		/**
		 * Shortcode: Flat Custom Button
		 *
		 * Usage: [flat_button text="Flat Button..." title="Flat Button" url="http://www.example.com/" padding="10px 20px" bg_color="#FF5C00" border_color="#FF5C00" border_width="1px" text_color="#FFFFFF" text_size="14px" align="left" target="_blank"]
		 *
		 * Options: align: left, right or center, the rest are self explanatory.
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function flat_custom_button_func( $atts ) {
			$atts        = shortcode_atts(
				array(
					'text'         => esc_html__( 'Read more...', 'u-design' ),
					'title'        => '',
					'url'          => '#',
					'padding'      => '10px 20px',
					'bg_color'     => '#FF5C00',
					'border_color' => '#FF5C00',
					'border_width' => '1px',
					'text_color'   => '#FFFFFF',
					'text_size'    => '14px',
					'align'        => 'left',
					'target'       => '',
				),
				$atts,
				'flat_button'
			);
			$target      = ( '_blank' === $atts['target'] ) ? ' target="_blank"' : '';
			$align_class = $before = $after = '';

			if ( 'right' === $atts['align'] ) {
				$align_class = ' align-btn-right';
			} elseif ( 'left' === $atts['align'] ) {
				$align_class = ' align-btn-left';
			} elseif ( 'none' === $atts['align'] ) {
				$align_class = ' align-btn-none';
			} else { // Catch the 'center'.
				$before = '<div class="align-btn-center">';
				$after  = '</div>';
			}
			$html = '<a class="flat-custom-button' . $align_class . '" href="' . $atts['url'] . '" title="' . $atts['title'] . '"' . $target . '><span style="padding:' . $atts['padding'] . '; background-color:' . $atts['bg_color'] . '; border:' . $atts['border_width'] . ' solid ' . $atts['border_color'] . '; color:' . $atts['text_color'] . '; font-size:' . $atts['text_size'] . ';">' . do_shortcode( $atts['text'] ) . '</span></a>';
			return $before . $html . $after;
		}

		/**
		 * Shortcode: Divider with an anchor link to top of page
		 *
		 * Usage: [divider]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function divider_func( $atts ) {
			return '<div class="divider"></div>';
		}

		/**
		 * Shortcode: Divider with an anchor link to top of page
		 *
		 * Usage: [divider_top]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function divider_top_func( $atts ) {
			return '<div class="divider top-of-page"><a href="#top" title="' . esc_html__( 'Top of Page', 'u-design' ) . '">' . esc_html__( 'Back to Top', 'u-design' ) . '</a></div>';
		}

		/**
		 * Shortcode: Clear , used to clear an element of its neighbors, no floating elements are allowed on the left or the right side
		 *
		 * Usage: [clear]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function clear_func( $atts ) {
			return '<div class="clear"></div>';
		}

		/**
		 * Shortcode: Mesage Box. Predefined and custom
		 *
		 * Usage (pre-defined): [message type="info" class="class-name"]Your info message goes here...[/message]
		 *  - there are 4 pre-set message types: "info", "success", "warning", "erroneous"
		 *
		 * Usage (custom): [message type="custom" width="100%" start_color="#FFFFFF" end_color="#EEEEEE" border="#BBBBBB" color="#333333" align="left" class="class-name"]Your info message goes here...[/message]
		 *  - width could be in pixels as well, e.g. width="250px"
		 *
		 * Usage (simple): [message type="simple" bg_color="#EEEEEE" color="#333333" class="class-name"]Your info message goes here...[/message]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function message_box_func( $atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'type'        => 'custom',
					'align'       => 'left',
					'start_color' => '#FFFFFF',
					'end_color'   => '#EEEEEE',
					'border'      => '#BBBBBB',
					'width'       => '100%',
					'color'       => '#333333',
					'bg_color'    => '#F5F5F5',
					'class'       => '',
				),
				$atts,
				'message'
			);
			if ( 'custom' === $atts['type'] ) {
				if ( 'center' === $atts['align'] ) {
					$margin_left = $margin_right = 'auto !important';
				} elseif ( 'right' === $atts['align'] ) {
					$margin_left  = 'auto !important';
					$margin_right = '0 !important';
				} else { // Default: left.
					$margin_left = $margin_right = '0 !important';
				}
				$html = '<div class="' . $atts['type'] . ' ' . $atts['class'] . '" style="background:-moz-linear-gradient(center top , ' . $atts['start_color'] . ', ' . $atts['end_color'] . ') repeat scroll 0 0 transparent;
						   background: -webkit-gradient(linear, center top, center bottom, from(' . $atts['start_color'] . '), to(' . $atts['end_color'] . '));
						   background: -o-linear-gradient(top, ' . $atts['start_color'] . ' 0%,' . $atts['end_color'] . ' 99%); /* Opera 11.10+ */
						   background: -ms-linear-gradient(top, ' . $atts['start_color'] . ' 0%,' . $atts['end_color'] . ' 99%); /* IE10+ */
						   margin-left:' . $margin_left . ';
						   margin-right:' . $margin_right . ';
						   border:1px solid ' . $atts['border'] . ';
						   background-color: ' . $atts['end_color'] . ';
						   width:' . $atts['width'] . ';
						   color:' . $atts['color'] . ';"><div class="inner-padding">' . do_shortcode( $content ) . '</div></div>';
			} elseif ( $atts['type'] == 'simple' ) {
				$html = '<div class="' . $atts['type'] . ' ' . $atts['class'] . '" style="background-color:' . $atts['bg_color'] . '; color:' . $atts['color'] . ';"><div class="inner-padding">' . do_shortcode( $content ) . '</div></div>';
			} else {
				$html = '<div class="' . $atts['type'] . ' ' . $atts['class'] . '"><div class="msg-box-icon">' . do_shortcode( $content ) . '</div></div>';
			}
			return $html;
		}

		/**
		 * Shortcode: pullquote
		 *
		 * Usage: [pullquote style="left" quote="light"]Text goes here...[/pullquote]
		 *  - style options: 'left', 'right'; quote options: 'light' (optional), otherwise defaults to dark style
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function pullquote_func( $atts, $content = null ) {
			$atts        = shortcode_atts(
				array(
					'style' => 'left',
					'quote' => 'dark',
				),
				$atts,
				'pullquote'
			);
			$align       = ( 'right' === $atts['style'] ) ? 'alignright' : 'alignleft';
			$quote_color = ( 'light' === $atts['quote'] ) ? ' bq-light' : '';
			return '<blockquote class="' . $align . $quote_color . '">' . do_shortcode( $content ) . '</blockquote>';
		}

		/**
		 * Shortcode: pullquote2
		 *
		 * Usage: [pullquote2 style="left" quote="light"]Text goes here...[/pullquote2]
		 *  - style options: 'left', 'right'; quote options: 'light' (optional), otherwise defaults to dark style
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function pullquote2_func( $atts, $content = null ) {
			$atts        = shortcode_atts(
				array(
					'style' => 'left',
					'quote' => 'dark',
				),
				$atts,
				'pullquote2'
			);
			$align       = ( 'right' === $atts['style'] ) ? 'alignright' : 'alignleft';
			$quote_color = ( 'light' === $atts['quote'] ) ? ' bq-light-2' : ' bq-dark-2';
			return '<blockquote class="' . $align . $quote_color . '">' . do_shortcode( $content ) . '</blockquote>';
		}

		/**
		 * Shortcode: Dropcap
		 *
		 * Usage: [dropcap]A[/dropcap]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function dropcap_func( $atts, $content = null ) {
			return '<span class="dropcap">' . $content . '</span>';
		}

		/**
		 * Shortcode: one_fourth
		 *
		 * Usage: [one_fourth]Content goes here...[/one_fourth]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function one_fourth_func( $atts, $content = null ) {
			return '<div class="one_fourth">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: one_fourth_last
		 *
		 * Usage: [one_fourth_last]Content goes here...[/one_fourth_last]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function one_fourth_last_func( $atts, $content = null ) {
			return '<div class="one_fourth last_column">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: one_third
		 *
		 * Usage: [one_third]Content goes here...[/one_third]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function one_third_func( $atts, $content = null ) {
			return '<div class="one_third">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: one_third_last
		 *
		 * Usage: [one_third_last]Content goes here...[/one_third_last]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function one_third_last_func( $atts, $content = null ) {
			return '<div class="one_third last_column">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: one_half
		 *
		 * Usage: [one_half]Content goes here...[/one_half]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function one_half_func( $atts, $content = null ) {
			return '<div class="one_half">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: one_half_last
		 *
		 * Usage: [one_half_last]Content goes here...[/one_half_last]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function one_half_last_func( $atts, $content = null ) {
			return '<div class="one_half last_column">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: two_third
		 *
		 * Usage: [two_third]Content goes here...[/two_third]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function two_third_func( $atts, $content = null ) {
			return '<div class="two_third">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: two_third_last
		 *
		 * Usage: [two_third_last]Content goes here...[/two_third_last]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function two_third_last_func( $atts, $content = null ) {
			return '<div class="two_third last_column">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: three_fourth
		 *
		 * Usage: [three_fourth]Content goes here...[/three_fourth]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function three_fourth_func( $atts, $content = null ) {
			return '<div class="three_fourth">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: three_fourth_last
		 *
		 * Usage: [three_fourth_last]Content goes here...[/three_fourth_last]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function three_fourth_last_func( $atts, $content = null ) {
			return '<div class="three_fourth last_column">' . do_shortcode( $content ) . '</div>';
		}

		/**
		 * Shortcode: toggle_content
		 *
		 * Usage: [toggle_content title="Title"]Your content goes here...[/toggle_content]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function toggle_content_func( $atts, $content = null ) {
			$atts  = shortcode_atts(
				array(
					'title' => '',
				),
				$atts,
				'toggle_content'
			);
			$html  = '<h4 class="slide_toggle"><a href="#">' . $atts['title'] . '</a></h4>';
			$html .= '<div class="slide_toggle_content" style="display: none;">' . do_shortcode( $content ) . '</div>';
			return $html;
		}

		/**
		 * Shortcode: tab
		 *
		 * Usage: [tab title="title 1"]Your content goes here...[/tab]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function tab_func( $atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'title' => '',
				),
				$atts,
				'tab'
			);
			global $single_tab_array;
			$single_tab_array[] = array(
				'title'   => $atts['title'],
				'content' => trim( do_shortcode( $content ) ),
			);
			return $single_tab_array;
		}

		/**
		 * Shortcode: tabs
		 *
		 * Usage:   [tabs]
		 *      [tab title="title 1"]Your content goes here...[/tab]
		 *      [tab title="title 2"]Your content goes here...[/tab]
		 *      [/tabs]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function tabs_func( $atts, $content = null ) {
			global $single_tab_array;
			$single_tab_array = array(); // Clear the array.
			$tabs_content     = '';

			$tabs_nav  = '<div class="clear"></div>';
			$tabs_nav .= '<div class="tabs-wrapper">';
			$tabs_nav .= '<ul class="tabs">';
			@do_shortcode( $content ); // Execute the '[tab]' shortcode first to get the title and content.
			$count = 1;
			foreach ( $single_tab_array as $tab => $tab_attr_array ) {
				$default       = ( $tab == 0 ) ? ' class="defaulttab"' : '';
				$tabs_nav     .= '<li><a href="javascript:void(0)"' . $default . ' id="tab-' . $count . '"><span>' . $tab_attr_array['title'] . '</span></a></li>';
				$tabs_content .= '<div class="tab-content" id="tab-' . $count++ . '-content"><div class="tabs-inner-padding">' . $tab_attr_array['content'] . '</div></div>';
			}
			$tabs_nav    .= '</ul>';
			$tabs_output  = $tabs_nav . $tabs_content;
			$tabs_output .= '</div><!-- tabs-wrapper end -->';
			$tabs_output .= '<div class="clear"></div>';
			return $tabs_output;
		}

		/**
		 * Shortcode: accordion_toggle
		 *
		 * Usage: [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function accordion_toggle_func( $atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'title' => '',
				),
				$atts,
				'accordion_toggle'
			);
			global $single_accordion_toggle_array;
			$single_accordion_toggle_array[] = array(
				'title'   => $atts['title'],
				'content' => trim( do_shortcode( $content ) ),
			);
			return $single_accordion_toggle_array;
		}

		/**
		 * Shortcode: accordion
		 *
		 * Usage:   [accordion scroll_into_view="no"]
		 *      [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
		 *      [accordion_toggle title="title 2"]Your content goes here...[/accordion_toggle]
		 *      [/accordion]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function accordion_func( $atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'scroll_into_view' => 'no',
				),
				$atts,
				'accordion'
			);

			if ( 'yes' === $atts['scroll_into_view'] ) :
				?>
				<script type="text/javascript">
					// <![CDATA[
					// Adjust the accordion headings into view after each click.
					jQuery(document).ready(function($){
						"use strict";
						$('.accordion-toggle').click(function(){
							var $this = $(this),
								offsetElement = 0,
								prevElHeights = 0;

							if (!$('body').hasClass('mobile-detected') && $('body').hasClass('u-design-fixed-menu-on')) { offsetElement = 40; }
							if ($('body').hasClass('admin-bar')) { offsetElement += 32; }

							$this.prevAll().not(':hidden').each(function() {
								prevElHeights += $(this).height();
							});

							if ($this.length) {
								$('html,body').animate({
									scrollTop: $this.offset().top - (offsetElement + prevElHeights)
								}, 1000);
							}
							return false; // Prevents the default action of the event (in this case "click" event).
						});
					});
					// ]]>
				</script>
				<?php
			endif;

			global $single_accordion_toggle_array;
			$single_accordion_toggle_array = array(); // Clear the array.

			$accordion_output  = '<div class="clear"></div>';
			$accordion_output .= '<div class="accordion-wrapper">';
			@do_shortcode( $content ); // Execute the '[accordion_toggle]' shortcode first to get the title and content.
			foreach ( $single_accordion_toggle_array as $tab => $accordion_toggle_attr_array ) {
				$accordion_output .= '<h3 class="accordion-toggle"><a href="#">' . $accordion_toggle_attr_array['title'] . '</a></h3>';
				$accordion_output .= '<div class="accordion-container">';
				$accordion_output .= '  <div class="content-block">' . $accordion_toggle_attr_array['content'] . '</div>';
				$accordion_output .= '</div><!-- end accordion-container -->';
			}
			$accordion_output .= '</div><!-- end accordion-wrapper -->';
			$accordion_output .= '<div class="clear"></div>';
			return $accordion_output;
		}

		/**
		 * Shortcode: list
		 *
		 * Usage: [custom_list style="list-1"]List html goes here...[/custom_list]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function custom_list_func( $atts, $content = null ) {
			$atts    = shortcode_atts(
				array(
					'style' => 'list-1',
				),
				$atts,
				'custom_list'
			);
			$content = str_replace( '<ul>', '<ul class="' . $atts['style'] . '">', do_shortcode( $content ) );
			return $content;
		}

		/**
		 * Shortcode: custom_table
		 *
		 * Usage: [custom_table]Table html goes here...[/custom_table]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function custom_table_func( $atts, $content = null ) {
			$content = str_replace( '<table', '<table class="custom-table" ', do_shortcode( $content ) );
			return $content;
		}

		/**
		 * Shortcode: custom_frame_left
		 *
		 * Usage: [custom_frame_left]<img src="http://www.example.com/some-image.jpg"/>[/custom_frame_left]
		 *
		 * Options: shadow="on"
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function custom_frame_left_func( $atts, $content = null ) {
			$atts         = shortcode_atts(
				array(
					'shadow' => 'off',
				),
				$atts,
				'custom_frame_left'
			);
			$shadow_class = ( 'off' === $atts['shadow'] ) ? '' : ' frame-shadow';
			$content      = preg_replace( '/\n|\r|<br>|<br \/>|alignleft|alignright/', '', $content ); // Remove new line and carriage return characters accidentally added by user.
			$content      = preg_replace( '/aligncenter|alignleft|alignright/', 'alignnone', $content ); // Replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'.
			return '<div class="custom-frame-wrapper alignleft' . $shadow_class . '"><div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">' . do_shortcode( $content ) . '</div></div></div>';
		}

		/**
		 * Shortcode: custom_frame_right
		 *
		 * Usage: [custom_frame_right]<img src="http://www.example.com/some-image.jpg"/>[/custom_frame_right]
		 *
		 * Options: shadow="on"
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function custom_frame_right_func( $atts, $content = null ) {
			$atts         = shortcode_atts(
				array(
					'shadow' => 'off',
				),
				$atts,
				'custom_frame_right'
			);
			$shadow_class = ( 'off' === $atts['shadow'] ) ? '' : ' frame-shadow';
			$content      = preg_replace( '/\n|\r|<br>|<br \/>|alignleft|alignright/', '', $content ); // Remove new line and carriage return characters accidentally added by user.
			$content      = preg_replace( '/aligncenter|alignleft|alignright/', 'alignnone', $content ); // Replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'.
			return '<div class="custom-frame-wrapper alignright' . $shadow_class . '"><div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">' . do_shortcode( $content ) . '</div></div></div>';
		}

		/**
		 * Shortcode: custom_frame_center
		 *
		 * Usage: [custom_frame_center]<img src="http://www.example.com/some-image.jpg"/>[/custom_frame_center]
		 *
		 * Options: shadow="on"
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function custom_frame_center_func( $atts, $content = null ) {
			$atts         = shortcode_atts(
				array(
					'shadow' => 'off',
				),
				$atts,
				'custom_frame_center'
			);
			$shadow_class = ( 'off' === $atts['shadow'] ) ? '' : ' frame-shadow';
			$content      = preg_replace( '/\n|\r|<br>|<br \/>|alignleft|alignright/', '', $content ); // Remove new line and carriage return characters accidentally added by user.
			$content      = preg_replace( '/aligncenter|alignleft|alignright/', 'alignnone', $content ); // Replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'.
			return '<div style="text-align:center;"><div class="custom-frame-wrapper aligncenter' . $shadow_class . '"><div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">' . do_shortcode( $content ) . '</div></div></div></div>';
		}

		/**
		 * Shortcode: udesign_recent_posts
		 *
		 * Usage: [udesign_recent_posts]
		 *
		 * Options: title="Recent Posts" category_id="9" use_current_cat="0" num_posts="3" post_offset="0" num_words_limit="23" show_date_author="1" show_more_link="0" more_link_text="Read more" show_thumbs="1" remove_thumb_frame="0" thumb_frame_shadow="1" default_thumb="1" post_thumb_width="120" post_thumb_height="60"
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function udesign_recent_posts_func( $atts ) {

			$atts = shortcode_atts(
				array(
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
				),
				$atts,
				'udesign_recent_posts'
			);

			// The widget's class name.
			$widget = esc_html( 'Latest_Posts_Widget' );

			// The current widget instance's settings.
			$instance = array(
				'title'              => esc_html( $atts['title'] ),
				'category_id'        => $atts['category_id'],
				'use_current_cat'    => $atts['use_current_cat'],
				'num_posts'          => $atts['num_posts'],
				'post_offset'        => $atts['post_offset'],
				'num_words_limit'    => $atts['num_words_limit'],
				'show_date_author'   => $atts['show_date_author'],
				'show_more_link'     => $atts['show_more_link'],
				'more_link_text'     => esc_html( $atts['more_link_text'] ),
				'show_thumbs'        => $atts['show_thumbs'],
				'remove_thumb_frame' => $atts['remove_thumb_frame'],
				'thumb_frame_shadow' => $atts['thumb_frame_shadow'],
				'default_thumb'      => $atts['default_thumb'],
				'post_thumb_width'   => $atts['post_thumb_width'],
				'post_thumb_height'  => $atts['post_thumb_height'],
			);

			// Generate random ID.
			$id = wp_rand( 100, 999 );

			// Widget's custom arguments.
			$args = array(
				'widget_id'     => 'arbitrary-instance-' . $id,
				'before_widget' => '<div class="widget widget_latest_posts">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			);

			ob_start();
			the_widget( $widget, $instance, $args );
			return ob_get_clean();

		}

		/**
		 * Shortcode: Content Block Shortcode
		 *
		 * Usage:     [content_block bg_image="http://www.example.com/some-image.jpg" max_bg_width="yes" bg_fixed="yes" bg_position="center top" bg_repeat="repeat-x" bg_size="auto" parallax_scroll="no" bg_color="#969696" content_padding="40px 0" font_color="#FFFFFF" class="class-name"]Your content goes here...[/content_block]
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array  $atts The widget attributes.
		 * @param string $content The widget's content'.
		 * @return string HTML code.
		 */
		public function content_block_func( $atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'bg_image'        => '',
					'bg_position'     => '50% 0',
					'bg_repeat'       => 'repeat',
					'parallax_scroll' => 'yes',
					'bg_color'        => 'transparent',
					'bg_fixed'        => 'no',
					'bg_size'         => 'auto',
					'font_color'      => 'inherit',
					'max_bg_width'    => 'yes',
					'content_padding' => '40px 0',
					'class'           => '',
				),
				$atts,
				'content_block'
			);

			$bg_fixed  = ( 'yes' === $atts['bg_fixed'] ) ? 'fixed' : 'scroll';
			$unique_id = rand( 1000, 2000 );
			// Grab just the X bg position value from the user shortcode.
			$bg_pos_x = explode( ' ', $atts['bg_position'] );
			$bg_pos_x = $bg_pos_x[0];

			ob_start();
			?>
			<style type="text/css">
				#content-block-background-<?php echo esc_attr( $unique_id ); ?> { background-image: url(<?php echo esc_url( $atts['bg_image'] ); ?>); background-position: <?php echo esc_attr( $atts['bg_position'] ); ?>; background-repeat: <?php echo esc_attr( $atts['bg_repeat'] ); ?>; background-color: <?php echo esc_attr( $atts['bg_color'] ); ?>; background-attachment: <?php echo esc_attr( $bg_fixed ); ?>; background-size: <?php echo esc_attr( $atts['bg_size'] ); ?>; }
				#content-block-body-<?php echo esc_attr( $unique_id ); ?> { padding: <?php echo esc_attr( $atts['content_padding'] ); ?>; color: <?php echo esc_attr( $atts['font_color'] ); ?>; }
				.content-block-body { margin-left: auto; margin-right: auto; position: relative; }
			</style>
			<?php if ( 'yes' === $atts['max_bg_width'] ) : ?>
				<style type="text/css">
					#wrapper-1 { overflow-x: hidden; }
					#content-block-background-<?php echo esc_attr( $unique_id ); ?> { margin: 0 -10000px; padding: 0 10000px; }
				</style>
			<?php endif; ?>

			<?php if ( 'yes' === $atts['parallax_scroll'] ) : ?>
			<script type="text/javascript">
				// <![CDATA[
				jQuery(document).ready(function($){
					"use strict";
					if( ! $("body").hasClass( "mobile-detected" ) ){
						$("#content-block-background-"+<?php echo esc_attr( $unique_id ); ?>).each(function(){
							var $bgobj = $(this); // Assigning the object.
							var xPos = '<?php echo esc_attr( $bg_pos_x ); ?>'; // x bg position value from the user shortcode.
							$(window).scroll(function() {
								var yPos = -($(window).scrollTop() / 3);
								// Put together our final background position.
								var coords = xPos+' '+yPos+'px';
								// Move the background.
								$bgobj.css({ backgroundPosition: coords });
							});
						});
					}
				});
				// ]]>
			</script>
			<?php endif; ?>

			<div class="clear"></div>
			<div id="content-block-background-<?php echo esc_attr( $unique_id ); ?>" class="content-block-background <?php echo esc_attr( $atts['class'] ); ?>">
				<div id="content-block-body-<?php echo esc_attr( $unique_id ); ?>" class="content-block-body">
					<div class="clear"></div>
					<?php echo do_shortcode( $content ); ?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Shortcode: udesign_wc_top_rated_products
		 *
		 * Usage: [udesign_wc_top_rated_products title="Top rated products" number="3"]
		 *
		 * Options: title="Top rated products" number="3"
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function udesign_wc_top_rated_products_func( $atts ) {
			$atts = shortcode_atts(
				array(
					'title'  => esc_html__( 'Top rated products', 'woocommerce' ),
					'number' => 3,
				),
				$atts,
				'udesign_wc_top_rated_products'
			);

			// The widget's class name.
			$widget = esc_html( 'WC_Widget_Top_Rated_Products' );

			// The current widget instance's settings.
			$instance = array(
				'title'  => esc_html( $atts['title'] ),
				'number' => $atts['number'],
			);

			// Generate random ID.
			$id = wp_rand( 1000, 1999 );

			// Widget's custom arguments.
			$args = array(
				'widget_id'     => 'arbitrary-instance-' . $id,
				'before_widget' => '<div class="widget udesign-wc-shortcode woocommerce widget_top_rated_products substitute_widget_class">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			);

			ob_start();
			the_widget( $widget, $instance, $args );
			return ob_get_clean();

		}

		/**
		 * Shortcode: udesign_wc_products
		 *
		 * Usage: [udesign_wc_products title="Products" number="5" show="" orderby="date" order="desc" hide_free="0" show_hidden="0"]
		 *
		 * Options:
		 *      title="Products"
		 *      number="5"
		 *      show=""  - options: leave blank for all products, 'featured', 'onsale'
		 *      orderby="date"  - options: 'date', 'price', 'rand', 'sales'
		 *      order="desc"  - options: 'asc', 'desc'
		 *      hide_free="0"
		 *      show_hidden="0"
		 *
		 * @since 1.0.0
		 * @access public
		 * @param array $atts The widget attributes.
		 * @return string HTML code.
		 */
		public function udesign_wc_products_func( $atts ) {
			$atts = shortcode_atts(
				array(
					'title'       => esc_html__( 'Products', 'woocommerce' ),
					'number'      => 5,
					'show'        => '',
					'orderby'     => 'date',
					'order'       => 'desc',
					'hide_free'   => 0,
					'show_hidden' => 0,
				),
				$atts,
				'udesign_wc_products'
			);

			// The widget's class name.
			$widget = esc_html( 'WC_Widget_Products' );

			// The current widget instance's settings.
			$instance = array(
				'title'       => esc_html( $atts['title'] ),
				'number'      => $atts['number'],
				'show'        => $atts['show'],
				'orderby'     => $atts['orderby'],
				'order'       => $atts['order'],
				'hide_free'   => $atts['hide_free'],
				'show_hidden' => $atts['show_hidden'],
			);

			// Generate random ID.
			$id = rand( 2000, 2999 );

			// Widget's custom arguments.
			$args = array(
				'widget_id'     => 'arbitrary-instance-' . $id,
				'before_widget' => '<div class="widget udesign-wc-shortcode woocommerce widget_products substitute_widget_class">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>',
			);

			ob_start();
			the_widget( $widget, $instance, $args );
			return ob_get_clean();

		}

	}
}

