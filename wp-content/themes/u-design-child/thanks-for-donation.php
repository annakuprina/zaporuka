<?php
/**
* Template Name: Thanks Donation
*/


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header('404');
$options = get_option('ThemeOptions');
$title = !empty($options['404_title_' . ICL_LANGUAGE_CODE]) ? $options['404_title_' . ICL_LANGUAGE_CODE] : false;
$subtitle = !empty($options['404_subtitle_' . ICL_LANGUAGE_CODE]) ? $options['404_subtitle_' . ICL_LANGUAGE_CODE] : false;
$back_button = !empty($options['404_back_main_' . ICL_LANGUAGE_CODE]) ? $options['404_back_main_' . ICL_LANGUAGE_CODE] : false;

?>

<div id="content-container" class="container_24 error_page thank-donation-page">
	<main id="main-content" role="main" class="grid_24">
		<div class="main-content-padding error_page_padding">
			<?php
			udesign_main_content_top( is_front_page() );
			
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			endif;
			?>
			<p class="to-home"><a href="<?php echo home_url(); ?>"><?php echo $back_button; ?></a></p>
		</div><!-- end main-content-padding -->
	</main><!-- end main-content -->
</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer('404');


