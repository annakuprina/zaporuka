<?php
/* form help on home page*/
function shortcode_help_form(  ){
$options = get_option('ThemeOptions');
$help_label = !empty($options['title_help_block_' . ICL_LANGUAGE_CODE]) ? $options['title_help_block_' . ICL_LANGUAGE_CODE] : 'Допомогти';
$amount_label = !empty($options['sum_help_block_' . ICL_LANGUAGE_CODE]) ? $options['sum_help_block_' . ICL_LANGUAGE_CODE] : 'Сума вашого внеску (грн.)';
$FIO_label = !empty($options['name_help_block_' . ICL_LANGUAGE_CODE]) ? $options['name_help_block_' . ICL_LANGUAGE_CODE] : 'ПIП';
$phone_label = !empty($options['phone_help_block_' . ICL_LANGUAGE_CODE]) ? $options['phone_help_block_' . ICL_LANGUAGE_CODE] : 'Телефон';
$payonce_label = !empty($options['payonce_help_block_' . ICL_LANGUAGE_CODE]) ? $options['payonce_help_block_' . ICL_LANGUAGE_CODE] : 'Одноразово';
$monthly_label = !empty($options['monthly_help_block_' . ICL_LANGUAGE_CODE]) ? $options['monthly_help_block_' . ICL_LANGUAGE_CODE] : 'Щомiсячно';
$text_help_label = !empty($options['text_help_block_' . ICL_LANGUAGE_CODE]) ? $options['text_help_block_' . ICL_LANGUAGE_CODE] : 'Допомагати щомiсячно — кожен день рятувати життя дiтям';
$agree_help_label = !empty($options['agree_help_block_' . ICL_LANGUAGE_CODE]) ? $options['agree_help_block_' . ICL_LANGUAGE_CODE] : 'Я погоджуюсь з';
$agree_link_label = !empty($options['agree_link_text_block_' . ICL_LANGUAGE_CODE]) ? $options['agree_link_text_block_' . ICL_LANGUAGE_CODE] : 'офертою*';
$agree_link = !empty($options['agree_link_block_' . ICL_LANGUAGE_CODE]) ? $options['agree_link_block_' . ICL_LANGUAGE_CODE] : '#';
$cancel_subscription_text_block = !empty($options['cancel_subscription_text_block_' . ICL_LANGUAGE_CODE]) ? $options['cancel_subscription_text_block_' . ICL_LANGUAGE_CODE] : 'Відмінити регулярний платіж';
$cancel_subscription_link_block = !empty($options['cancel_subscription_link_block_' . ICL_LANGUAGE_CODE]) ? $options['cancel_subscription_link_block_' . ICL_LANGUAGE_CODE] : '#';

	ob_start();
	?>
  <div class="help_form_wrapper">
  	<div class="help-form-inner-wrapper">
  	   <div class="help-form-inner-title">
			<?php echo $help_label; ?>
  	   </div>
	   <form action="/wp-content/plugins/liqpay_wordpress/liqpay-form.php" method="POST" class="help_form">
		   	<input type="hidden" name="date" value="'.date('d.m.Y H:i:s' ).'" required/><input type="hidden" name="liqpay_product_id"  value=""/>
		   	<input type="hidden" name="hidden_content"  value="<?php echo site_url('/storinka-podyaky/');?>"/>
		   	<input type="hidden" name="url_page"  value="<?php echo site_url('/storinka-podyaky/');?>"/>
		   	<input type="hidden" name="ip"  value=[ip]/>
		   	<input type="hidden" name="pay_type"  value="pay"/>
		    <input type="hidden" name="subscribe_type"  value="month"/>
		    <input type="hidden" id="plata" name="plata" value="">
		    <input type="hidden" id="liqpay_post_id" name="liqpay_post_id"  value=""/>
		    <div class="help-form-amount">
		    	<div class="help-form-amount-left">
		    		<input class="textarea-small val" type="text" id="paid" name="paid"  value="" placeholder="<?php echo $amount_label; ?>" required/> 
		    		<input   style="display: none;" type="text" readonly name="menu"   value="UAH" required/>
		    	</div>
		    	<div class="help-form-amount-right">
		    		<a href="#" summ="100" class="amount-button">100</a>
		    		<a href="#" summ="250" class="amount-button">250</a>
		    		<a href="#" summ="1000" class="amount-button">1000</a>
		    	</div>
		    </div>
		    <div class="help-form-PIB">
	    		<input  class="textarea-full" type="text" name="fio" value=""  placeholder="<?php echo $FIO_label; ?>" required/>
	    	</div>
		    <div class="help-form-email-tel">
		    	<div class="help-form-amount-email">
		    		<input  class="textarea-small" type="email" name="mail" value=""  placeholder="Email" required/>
		    	</div>
		    	<div class="help-form-amount-tel">
		    		<input  class="textarea-small" type="text" name="phone" value=""  placeholder="<?php echo $phone_label; ?>" required/>
		    	</div>
		    </div>
		     <div class="help-form-subscribe">
		    	<div class="help-form-subscribe-left">
		    		<a href="#" paytype="pay" class="subscribe-link onetime active"><?php echo $payonce_label; ?></a>
		    	</div>
		    	<div class="help-form-subscribe-right">
		    		<a href="#" paytype="subscribe" class="subscribe-link month"><?php echo $monthly_label; ?></a>
		    	</div>
		    </div>
		     <p class="help-form-text">
	    		<?php echo $text_help_label; ?> 
	    	</p>
	    	<div class="help-form-submit-oferta">
	    	 	<div class="help-form-submit"><input class="submit-btn" type="submit" value="<?php echo $help_label; ?>" /></div>
	    	 	<div class="help-form-oferta">
	    	 		<input type="checkbox" id="oferta" name="oferta" required>
	  				<label for="oferta"><?php echo $agree_help_label; ?> <a href="<?php echo $agree_link; ?>" target="_blank" ><?php echo $agree_link_label; ?></a>*</label>
	    	 	</div>
	    	</div>
	    	<div class="help-form-cancel-subscription">
	    		<p class="help-form-cancel-subscription-text">
	    			<a href="<?php echo $cancel_subscription_link_block; ?>" target="_blank" ><?php echo $cancel_subscription_text_block; ?></a>
	    		</p>
	    	</div>

		</form>
      </div>
  </div>
	<?php
	$html = ob_get_clean();
	return $html;
}
add_shortcode('help_form', 'shortcode_help_form');


function shortcode_cancel_subscription_form(){
$options = get_option('ThemeOptions');
$cancel_subscription_form_title = !empty($options['cancel_subscription_form_title_block_' . ICL_LANGUAGE_CODE]) ? $options['cancel_subscription_form_title_block_' . ICL_LANGUAGE_CODE] : 'Відмінити регулярний платіж';
$phone_label = !empty($options['phone_help_block_' . ICL_LANGUAGE_CODE]) ? $options['phone_help_block_' . ICL_LANGUAGE_CODE] : 'Телефон';
$cancel_subscription_form_submit_button = !empty($options['cancel_subscription_form_submit_button_' . ICL_LANGUAGE_CODE]) ? $options['cancel_subscription_form_submit_button_' . ICL_LANGUAGE_CODE] : 'Відмінити';
$FIO_label = !empty($options['name_help_block_' . ICL_LANGUAGE_CODE]) ? $options['name_help_block_' . ICL_LANGUAGE_CODE] : 'ПIП';
$phone_label = !empty($options['phone_help_block_' . ICL_LANGUAGE_CODE]) ? $options['phone_help_block_' . ICL_LANGUAGE_CODE] : 'Телефон';


	ob_start();
	?>
	  <div class="help_form_wrapper">
	  	<div class="help-form-inner-wrapper">
	  	   <div class="help-form-inner-title">
				<?php echo $cancel_subscription_form_title; ?>
	  	   </div>
		   <form action="" method="POST" class="help_form cancel_subscription_form">
			    <div class="help-form-email-tel">
			    	<div class="help-form-amount-email">
			    		<input  class="textarea-small" type="email" name="mail" value=""  placeholder="Email" required/>
			    	</div>
			    	<div class="help-form-amount-tel">
			    		<input  class="textarea-small" type="text" name="phone" value=""  placeholder="<?php echo $phone_label; ?>" required/>
			    	</div>
			    </div>
		    	<div class="help-form-submit-oferta">
		    	 	<div class="help-form-submit"><input class="submit-btn" type="submit" value="<?php echo $cancel_subscription_form_submit_button; ?>" /></div>
		    	</div>
			</form>
	      </div>
	  </div>
	  <div class="cansel-message">
	  	<?php
		if(ICL_LANGUAGE_CODE=='uk'){
			echo "Для підтвердження скасування регулярного платежу, перевірте пошту та перейдіть за посиланням у листі";
		}
		elseif(ICL_LANGUAGE_CODE=='ru'){
			echo "Для подтверждения отмены регулярного платежа, проверьте почту и перейдите по ссылке в письме";
		}
		elseif(ICL_LANGUAGE_CODE=='en'){
			echo "To confirm the cancel subscription, check your mail and follow the link in the email";
		}
	  	?>
	  </div>
	<?php
	$html = ob_get_clean();
	return $html;

}
add_shortcode('cancel_subscription_form', 'shortcode_cancel_subscription_form');


/* one project for home page */
function shortcode_project_for_home(  ){
	ob_start();
	$featured_post_id = 0;

	$projects_array = get_posts( array(
		'numberposts' => -1,
		'post_type'   => 'projects'
	));	

	foreach( $projects_array as $post ){
		$display_mark =  get_field("show-on-home-page", $post->ID);
		if ($display_mark[0]=="Да"){
            $featured_post_id = $post->ID;
        }
	}
	$total_collected = (int) get_field("total-collected", $featured_post_id);
    $total_amount = (int) get_field("total-amount", $featured_post_id);
    $progress_bar = (int) $total_collected * 100 / (int) $total_amount;

	if($featured_post_id):
	?>
	<!-- One project -->
        <div class="one-project">
            <div class="one-project-left"><img src="<?php echo get_the_post_thumbnail_url($featured_post_id, 'full'); ?>"></div>
            <div class="one-project-right">
                <div class="one-project-title"><?php pll_e( 'Проекти');?></div>
                <div class="one-project-info">
                    <p class="one-project-info-title">
                        <?php echo get_the_title($featured_post_id);?>
                    </p>
                    <p class="one-project-info-text">
                        <?php echo get_the_excerpt($featured_post_id);?>
                    </p>
                </div>
                <div class="one-project-progress">
                    <div class="one-project-progress-top">
                        <p class="project-money">
                            <span class="project-money-quantity"><?php echo $total_collected; ?></span>
                            <span class="project-money-involved"><?php pll_e( 'залучено');?></span>
                        </p>
                        <p class="project-money-collected"><?php echo $total_amount; ?></p>
                    </div>
                    <div class="one-project-progress-bottom">
                        <div class="progress-bar">
                            <span class="progress-done" style="width: <?php echo $progress_bar; ?>%;"></span>
                            <span class="progress-dot"></span>
                        </div>
                    </div>

                </div>
                <a href="<?php echo get_permalink($featured_post_id);?>#help_section_anchore" class="one-project-help">
                    <span><?php pll_e( 'Допомогти');?></span>
                </a>
            </div><!-- end one-project-right -->
        </div><!-- end one-project -->

	<?php
	endif;

	$html = ob_get_clean();
	return $html;

}
add_shortcode('project_for_home', 'shortcode_project_for_home');

/* partners on home */
function shortcode_parthers_on_home(  ){
	ob_start();
	$partners_array = get_posts( array(
		'numberposts' => -1,
		'post_type'   => 'partners'
	));
	$partners_array_by_2 = array_chunk($partners_array, 2, true);
	?>
			<!----------
				PARTNERS
			----------->
			<div class="partners">
				<h3 class="partners-title"><?php pll_e( 'Партнери');?></h3>
				<!-- PARTNERS SLIDER DESKTOP-->
				<div class="partners-slider">
						<?php
						foreach( $partners_array as $post ){ ?>
							<!-- One slide -->
							<div class="partners-slide">
								<img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>">
								<!-- Slide text -->
								<div class="partners-slide-text">
									<p><?php echo $post->post_title;?></p>
									<a class="partner-link" href="<?php echo $post->post_content;?>"><?php echo $post->post_content;?></a>
								</div>
							</div><!-- end one slide-->
						<?php
						}
						?>
				</div><!-- end partners slider-->

				<!-- PARTNERS SLIDER MOBILE-->
				<div class="partners-slider-mob">
					<?php
					foreach( $partners_array_by_2 as $post_wrapper ){ ?>
						<!-- One slide -->
						<div class="partners-slide">
							<?php foreach( $post_wrapper as $post ){ ?>
							<div class="partners-slide-item">
								<div class="partners-slider-mob-img">
									<img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>">
								</div>
								<!-- Slide text -->
								<div class="partners-slide-text">
									<p>
										<?php echo $post->post_title;?>
										<a class="partner-link" href="<?php echo $post->post_content;?>"><?php echo $post->post_content;?></a>
									</p>
								</div>
							</div><!-- end partners-slide-item -->
							<?php
							}?>
						</div><!-- end one slide-->
					<?php
					}
					?>
				</div><!-- end partners-slider-mob-->
			</div><!-- end partners-->

	<?php
	$html = ob_get_clean();
	return $html;

}
add_shortcode('our_partners_home', 'shortcode_parthers_on_home');

/* FRIENDS AND VOLUNTEERS on home page*/
function shortcode_friends_volunteers(  ){	
	ob_start();
	$friends_array = get_posts( array(
		'numberposts' => -1,
		'post_type'   => 'friends'
	));	
	$friends_array_by_7 = array_chunk($friends_array, 7, true);
	$volunteers_array = get_posts( array(
		'numberposts' => -1,
		'post_type'   => 'volunteers'
	));	
	$volunteers_array_by_6 = array_chunk($volunteers_array, 6, true);
	$volunteers_array_by_3 = array_chunk($volunteers_array, 3, true);

	?>
    <!-------------------------
		FRIENDS AND VOLUNTEERS
	-------------------------->
    <div class="friends-and-volunteers">
        <!---------
			FRIENDS
		----------->
        <div class="friends-wrapper">
            <div class="friends">
                <h3 class="friends-title"><?php pll_e( 'Друзi');?></h3>
                <!-- FRIENDS SLIDER -->
                <div class="friends-slider">
                    <?php
                    foreach( $friends_array_by_7 as $post_wrapper ){
                        echo '<div class="friends-slide">';
                        foreach( $post_wrapper as $post ){ ?>
                            <div class="friends-slide-row">
                                <p class="friends-name"><?php echo $post->post_title;?></p>
                                <a class="friends-link" href="<?php echo $post->post_content;?>"><?php echo $post->post_content;?></a>
                            </div>
                            <?php
                        }
                        echo '</div>';
                    }
                    ?>
                </div><!-- end friends slider -->
            </div><!-- end friends -->
        </div><!-- end friends-wrapper-->
        <!-------------
			VOLUNTEERS
		-------------->
        <div class="volunteers">
            <h3 class="volunteers-title"><?php pll_e( 'Волонтери');?></h3>

            <!---------------------------
				VOLUNTEERS SLIDER DESKTOP
			---------------------------->
            <div class="volunteers-slider">
                <!-- ONE SLIDE -->
                <?php
                foreach( $volunteers_array_by_6 as $post_wrapper ){
                    echo '<div class="volunteers-slide">';
                    foreach( $post_wrapper as $post ){ ?>
                        <!-- One volunteer -->
                        <div class="one-volunteer">
                            <div class="one-volunteer-photo"><img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"></div>
                            <div class="one-volunteer-info">
                                <div class="one-volunteer-name"><?php echo $post->post_title;?></div>
                                <div class="one-volunteer-position"><?php echo $post->post_content;?></div>
                            </div>
                        </div><!-- end one volunteer -->
                        <?php
                    }
                    echo '</div>';
                }
                ?>
            </div>
            <!---------------------------
				VOLUNTEERS SLIDER MOBILE
			---------------------------->
            <div class="volunteers-slider-mob">
                <!-- ONE SLIDE -->
                <?php
                foreach( $volunteers_array_by_3 as $post_wrapper ){
                    echo '<div class="volunteers-slide">';
                    foreach( $post_wrapper as $post ){ ?>
                        <!-- One volunteer -->
                        <div class="one-volunteer">
                            <div class="one-volunteer-photo"><img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"></div>
                            <div class="one-volunteer-info">
                                <div class="one-volunteer-name"><?php echo $post->post_title;?></div>
                                <div class="one-volunteer-position"><?php echo $post->post_content;?></div>
                            </div>
                        </div><!-- end one volunteer -->
                        <?php
                    }
                    echo '</div>';
                }
                ?>
            </div><!-- end volunteers-slider -->
        </div><!-- end volunteers -->
    </div><!-- end friends-and-volunteers -->

	<?php
	$html = ob_get_clean();
	return $html;

}
add_shortcode('friends_volunteers_home', 'shortcode_friends_volunteers');

/* Social icons on contact page */
function shortcode_social_icons (  ) {
    $options = get_option('ThemeOptions');
    $facebook_link = !empty($options['facebook_link']) ? $options['facebook_link'] : false;
    $instagram_link = !empty($options['instagram_link']) ? $options['instagram_link'] : false;
    $youtube_link = !empty($options['youtube_link']) ? $options['youtube_link'] : false;
    ob_start();
    ?>
    <div class="contact_social_icon">
        <ul>
            <li class="footer-social-link"><a href="<?php echo $facebook_link;?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a></li>
            <li class="footer-social-link"><a href="<?php echo $instagram_link;?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a></li>
            <li class="footer-social-link"><a href="<?php echo $youtube_link;?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>Youtube</span></a></li>
        </ul>
    </div>
    <?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('social_icons', 'shortcode_social_icons');



add_action( 'wp_ajax_send_cancel_subscription_email', 'send_cancel_subscription_email_function' );
add_action( 'wp_ajax_nopriv_send_cancel_subscription_email', 'send_cancel_subscription_email_function' );

function send_cancel_subscription_email_function() { 
    $user_mail = sanitize_text_field( $_POST['email'] );
    $user_phone = sanitize_text_field( $_POST['phone'] );
     var_dump($user_mail); // free
     var_dump($user_phone); // free

    $mail_body = "Тестовое письмо пока что без проверок";
    $mail_body .= 'Phone = ' . $user_phone;
    $mail_body .= 'Mail = ' . $user_mail;

    $result = send_notification($user_mail,'Отмена регулярного платежа', $mail_body);
    if(!$result){
    	$message = 'что-то пошло не так (потом рассмотреть разные варианты что именно не так (вас нет в БД, еще что-то ну и сделать переводы))';
    }
    var_dump('check email result');
    var_dump($result);

    exit( json_encode( array( 'result' => $result, 'message'=>$message  ) ) );
   
}


function send_notification( $to, $subject, $mail_body ) {
	$admin_email = get_option( 'admin_email' );
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: БФ "Запорука" <' . $admin_email . '>' . "\r\n";    
	$mail_sending_result = wp_mail( $to, $subject, $mail_body, $headers );
	return $mail_sending_result;
}