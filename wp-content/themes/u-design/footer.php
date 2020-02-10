<?php
/**
 * @package WordPress
 * @subpackage U-Design
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


global $udesign_options;
?>

<?php udesign_page_content_bottom(); ?>
</section><!-- end page-content -->
<?php udesign_page_content_after(); ?>

<div class="clear"></div>

<?php
// Bottom widget area.
get_template_part( 'template-parts/bottom/bottom', 'widgets' );

udesign_footer_before();

if( ! udesign_check_page_layout_option( 'no_footer' ) ) :
	?>
	<footer id="footer-bg">

		<div id="footer" class="container_24 footer-top">

			<?php udesign_footer_inside(); ?>

		</div>

	</footer><!-- end footer-bg -->

	<div class="clear"></div>
	<?php
endif;

udesign_footer_after();

wp_footer();

udesign_body_bottom();

?>
</body>
</html>