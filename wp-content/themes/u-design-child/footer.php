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
//get_template_part( 'template-parts/bottom/bottom', 'widgets' );
$options = get_option('ThemeOptions');
$facebook_link = !empty($options['facebook_link']) ? $options['facebook_link'] : false;
$instagram_link = !empty($options['instagram_link']) ? $options['instagram_link'] : false;
$youtube_link = !empty($options['youtube_link']) ? $options['youtube_link'] : false;
$phone_number = !empty($options['main_phone_number']) ? $options['main_phone_number'] : false;
$email = !empty($options['main_email']) ? $options['main_email'] : false;
$adress = !empty($options['main_address_' . ICL_LANGUAGE_CODE]) ? $options['main_address_' . ICL_LANGUAGE_CODE] : false;
$copyright_text = !empty($options['column_1_text_' . ICL_LANGUAGE_CODE]) ? $options['column_1_text_' . ICL_LANGUAGE_CODE] : false;
$privacy_policy_text = !empty($options['column_2_title_' . ICL_LANGUAGE_CODE]) ? $options['column_2_title_' . ICL_LANGUAGE_CODE] : false;
$privacy_policy_link = !empty($options['column_2_link_' . ICL_LANGUAGE_CODE]) ? $options['column_2_link_' . ICL_LANGUAGE_CODE] : false;
$disclaimer_text = !empty($options['column_3_title_' . ICL_LANGUAGE_CODE]) ? $options['column_3_title_' . ICL_LANGUAGE_CODE] : false;
$disclaimer_link = !empty($options['column_3_link_' . ICL_LANGUAGE_CODE]) ? $options['column_3_link_' . ICL_LANGUAGE_CODE] : false;
$developer_text =  !empty($options['column_4_title']) ? $options['column_4_title'] : false;
$developer_link =  !empty($options['column_4_link']) ? $options['column_4_link'] : false;
$designer_text =  !empty($options['column_5_title']) ? $options['column_5_title'] : false;
$designer_link =  !empty($options['column_5_link']) ? $options['column_5_link'] : false;
$popup_sms_title = !empty($options['popup_sms_title_' . ICL_LANGUAGE_CODE]) ? $options['popup_sms_title_' . ICL_LANGUAGE_CODE] : false;
$popup_sms_text = !empty($options['popup_sms_text_' . ICL_LANGUAGE_CODE]) ? $options['popup_sms_text_' . ICL_LANGUAGE_CODE] : false;
$popup_sms_link = !empty($options['popup_sms_link_' . ICL_LANGUAGE_CODE]) ? $options['popup_sms_link_' . ICL_LANGUAGE_CODE] : false;

$bottom_1_is_active = sidebar_exist_and_active( 'bottom-widget-area-1' );
$bottom_2_is_active = sidebar_exist_and_active( 'bottom-widget-area-2' );
$bottom_3_is_active = sidebar_exist_and_active( 'bottom-widget-area-3' );
$bottom_4_is_active = sidebar_exist_and_active( 'bottom-widget-area-4' );
$bottom_5_is_active = sidebar_exist_and_active( 'bottom-widget-area-5' );
$logo_img_url = ( $udesign_options['custom_logo_img'] ) ? esc_url($udesign_options['custom_logo_img']) : '../../../images/logo.png';
?>

<section id="bottom-bg" class="wow fadeIn" data-wow-duration="1s">
		<div id="bottom" class="container_24">
				<div class="bottom-content-wrapper">
					<div class="one_fifth">
						<div class="footer-logo">
							<a title="<?php bloginfo('name'); ?>" href="<?php echo home_url(); ?>">
								<img src="<?php echo $logo_img_url ;?>">
							</a></div>
						<div class="footer-socials-wrapper widget_nav_menu">
							<ul>
								<li class="footer-social-link"><a href="<?php echo $facebook_link;?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a></li>
								<li class="footer-social-link"><a href="<?php echo $instagram_link;?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a></li>
								<li class="footer-social-link"><a href="<?php echo $youtube_link;?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>Youtube</span></a></li>
							</ul>
						</div>
					</div>
					<div class="one_fifth"><?php echo get_dynamic_column( 'bottom_2', '', 'bottom-widget-area-2' );?></div>
					<div class="one_fifth"><?php echo get_dynamic_column( 'bottom_3', '', 'bottom-widget-area-3' );?></div>
					<div class="one_fifth"><?php echo get_dynamic_column( 'bottom_4', '', 'bottom-widget-area-4' );?></div>
					<div class="one_fifth last_column">
						<?php echo get_dynamic_column( 'bottom_5', '', 'bottom-widget-area-5' );?>
						<div class="footer-contact-wrapper">
							<div class="footer-adress">
								<span><?php echo $adress; ?></span>
							</div>
							<div class="footer-email-tel">
								<div class="footer-tel"><a href="tel:<?php echo $phone_number; ?>" class="tel-block-a"><i class="fa fa-phone" aria-hidden="true"></i></i><?php echo $phone_number; ?></a></div>
                       	 		<div class="footer-email"><a href="mailto:<?php echo $email; ?>" class="email-block-a"><i class="fa fa-envelope" aria-hidden="true"></i><?php echo $email; ?></a></div>
							</div>
						</div>
					</div>
				</div><!-- end bottom-content-padding -->
		</div><!-- end bottom -->
</section><!-- end bottom-bg -->

<div class="clear"></div>

<!-- The Send SMS Modal from Header -->
<div id="sendSmsModalfromHeader"  class="modale" aria-hidden="true">
	<a href="#" class="btn-close closemodale" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g><g><path fill="#fff" d="M13.629 11.829l9.6-9.643c.514-.515.514-1.329 0-1.8-.515-.515-1.329-.515-1.8 0l-9.6 9.643L2.186.386C1.67-.13.857-.13.386.386c-.515.514-.515 1.328 0 1.8l9.6 9.643-9.6 9.642c-.515.515-.515 1.329 0 1.8.257.258.6.386.9.386.3 0 .643-.128.9-.386l9.643-9.642 9.642 9.642c.258.258.6.386.9.386.3 0 .643-.128.9-.386.515-.514.515-1.328 0-1.8z"/></g></g></svg></a>
  <div class="modal-dialog">
    <div class="modal-header">
      <h2><span><?php echo $popup_sms_title; ?></span></h2>
    </div>
    <div class="modal-body">
            <span><?php echo $popup_sms_text;?></span>
    </div>
</div>
</div>
<!-- /Modal -->

<!-- The Send SMS Modal from Help Form/section -->
<div id="sendSmsModalfromHelpForm"  class="modale" aria-hidden="true">
    <a href="#" class="btn-close closemodale" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g><g><path fill="#fff" d="M13.629 11.829l9.6-9.643c.514-.515.514-1.329 0-1.8-.515-.515-1.329-.515-1.8 0l-9.6 9.643L2.186.386C1.67-.13.857-.13.386.386c-.515.514-.515 1.328 0 1.8l9.6 9.643-9.6 9.642c-.515.515-.515 1.329 0 1.8.257.258.6.386.9.386.3 0 .643-.128.9-.386l9.643-9.642 9.642 9.642c.258.258.6.386.9.386.3 0 .643-.128.9-.386.515-.514.515-1.328 0-1.8z"/></g></g></svg></a>
  <div class="modal-dialog">
    <div class="modal-header">
      <h2><span><?php echo $popup_sms_title; ?></span></h2>
    </div>
    <div class="modal-body">
            <span><?php echo $popup_sms_text; ?></span>
    <div class="modal-footer">
      <a href="#" class="help-other"><span><?php echo $popup_sms_link; ?></span></a>
    </div>
  </div>
  </div>
</div>
<!-- /Modal -->

<!-- The Send SMS Modal from Help Form/section -->
<div id="ModalHelpForm"  class="modale" aria-hidden="true">
	<a href="#" class="btn-close closemodale" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g><g><path fill="#fff" d="M13.629 11.829l9.6-9.643c.514-.515.514-1.329 0-1.8-.515-.515-1.329-.515-1.8 0l-9.6 9.643L2.186.386C1.67-.13.857-.13.386.386c-.515.514-.515 1.328 0 1.8l9.6 9.643-9.6 9.642c-.515.515-.515 1.329 0 1.8.257.258.6.386.9.386.3 0 .643-.128.9-.386l9.643-9.642 9.642 9.642c.258.258.6.386.9.386.3 0 .643-.128.9-.386.515-.514.515-1.328 0-1.8z"/></g></g></svg></a>
  		<div class="modal-dialog">
  			<div class="modal-body">
				<?php echo do_shortcode('[zaporuka_help_form]');?>
			</div>
  		</div>	
</div>
<!-- /Modal -->

<!-- Ask for help Modal-->
<div id="askForHelpModal"  class="modale" aria-hidden="true">
	<a href="#" class="btn-close closemodale" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g><g><path fill="#fff" d="M13.629 11.829l9.6-9.643c.514-.515.514-1.329 0-1.8-.515-.515-1.329-.515-1.8 0l-9.6 9.643L2.186.386C1.67-.13.857-.13.386.386c-.515.514-.515 1.328 0 1.8l9.6 9.643-9.6 9.642c-.515.515-.515 1.329 0 1.8.257.258.6.386.9.386.3 0 .643-.128.9-.386l9.643-9.642 9.642 9.642c.258.258.6.386.9.386.3 0 .643-.128.9-.386.515-.514.515-1.328 0-1.8z"/></g></g></svg></a>
	<div class="modal-dialog">
		<div class="modal-body">
			<?php
            $help_text_contact_page = !empty($options['help_text_contact_page_' . ICL_LANGUAGE_CODE]) ? $options['help_text_contact_page_' . ICL_LANGUAGE_CODE] : false;
            echo $help_text_contact_page;
            ?>
		</div>
	</div>	
</div>
<!-- /Modal -->

<?php
udesign_footer_before();

if( ! udesign_check_page_layout_option( 'no_footer' ) ) :
	?>
	<footer id="footer-bg" class="wow fadeIn" data-wow-duration="0.5s" data-wow-delay="0.2s">
		<!-- DESKTOP VERSION OF FOOTER -->
		<div id="footer" class="container_24 footer-top">
			<?php //udesign_footer_inside(); ?>
			<div id="footer_bottom">
				<div class="one_fifth"><span class="copyright"><?php echo $copyright_text; ?></span></div>
				<div class="one_fifth">
					<span class="developer"><span class="developer-text"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6"><g><g><path fill="#aaa" d="M0 .078h6v5.838H0z"/></g></g></svg>Develop by</span><a href="<?php echo $developer_link;?>" target="_blank" class="developer-link"><?php echo $developer_text;?></a></span>
				</div>
				<div class="one_fifth last_column">
					<span class="designer"><span class="designer-text"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6"><g><g><path fill="#aaa" d="M0 .078h6v5.838H0z"/></g></g></svg>Designed by</span><a href="<?php echo $designer_link;?>" target="_blank" class="designer-link"><?php echo $designer_text;?></a></span>
				</div>
			</div><!-- end footer_bottom -->
		</div><!-- end footer-top -->


		<!-- MOBILE VERSION OF FOOTER -->
		<div class="footer-mob">
			<p class="footer-mob-logo">
				<a title="Запорука" href="http://zaporuka.testit.in.ua">
					<img src="<?php echo $logo_img_url ;?>">
				</a>
			</p>
			<div class="footer-mob-info">
				<div class="footer-mob-left"><?php echo get_dynamic_column( 'footer-left-part', '', 'widget-footer-mob-left' );?></div>
				<div class="footer-mob-right">
					<div class="footer-mob-politics">
						<p><a href="<?php echo $privacy_policy_link; ?>" class="privacy-policy"><?php echo $privacy_policy_text; ?></a></p>
						<p><a  href="<?php echo $disclaimer_link; ?>" class="disclaimer"><?php echo $disclaimer_text; ?></a></p>
					</div>
					<div class="footer-developed-and-designed">
						<div class="footer-developed"> 
							<span class="developer"><span class="developer-text">
								<svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6">
								<g><g><path fill="#aaa" d="M0 .078h6v5.838H0z"></path></g></g></svg>Developed by</span>
								<a href="<?php echo $developer_link;?>" target="_blank" class="developer-link"><?php echo $developer_text;?></a>
							</span>
						</div>
						<div class="footer-designed"> 
							<span class="designer"><span class="designer-text"><svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6">
								<g>
								<g><path fill="#aaa" d="M0 .078h6v5.838H0z"></path></g></g></svg>Designed by</span>
								<a href="<?php echo $designer_link;?>" target="_blank" class="designer-link"><?php echo $designer_text;?></a>
							</span>
						</div>
					</div><!-- end footer-developed-and-designed -->
					<div class="footer-mob-socials">
						<a href="<?php echo $facebook_link;?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						<a href="<?php echo $instagram_link;?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
						<a href="<?php echo $youtube_link;?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
					</div>
				</div><!-- end footer-mob-right -->

			</div><!-- end footer-mob-info -->
			<div class="footer-mob-copyright"><?php echo $copyright_text; ?></div>
		</div><!-- end footer-mob -->
	</footer>

	<div class="clear"></div>
	<?php
endif;

udesign_footer_after();

wp_footer();

udesign_body_bottom();

?>
</body>
</html>
