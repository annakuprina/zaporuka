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
    if(ICL_LANGUAGE_CODE=='uk'){
        $home_url =  '/new-order';
    }
    elseif(ICL_LANGUAGE_CODE=='ru'){
        $home_url =  '/ru/new-order';
    }
    elseif(ICL_LANGUAGE_CODE=='en'){
        $home_url =  '/en/new-order';
    }
	ob_start();
	?>
    <div class="home-first-post-form-help">
        <div class="help_form_wrapper">
            <div class="help-form-inner-wrapper">
                <div class="help-form-inner-title">
                    <?php echo $help_label; ?>
                </div>
                <form action="/wp-content/plugins/liqpay_wordpress/liqpay-form.php" method="POST" class="help_form">
                    <input type="hidden" name="date" value="'.date('d.m.Y H:i:s' ).'" required/><input type="hidden" name="liqpay_product_id"  value=""/>
                    <input type="hidden" name="hidden_content"  value="<?php echo site_url($home_url);?>"/>
                    <input type="hidden" name="url_page"  value="<?php echo site_url($home_url);?>"/>
                    <input type="hidden" name="ip"  value=[ip]/>
<!--                    <input type="hidden" name="pay_type"  value="pay"/>-->
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
                            <input  class="textarea-small" type="email" name="mail" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  placeholder="Email" required/>
                        </div>
                        <div class="help-form-amount-tel">
                            <input  class="textarea-small" type="text" name="phone" value=""  placeholder="<?php echo $phone_label; ?>" required/>
                        </div>
                    </div>
                    <div class="help-form-subscribe">
                        <div class="help-form-subscribe-left">
<!--                            <a href="#" paytype="pay" class="subscribe-link onetime active">--><?php //echo $payonce_label; ?><!--</a>-->
                            <input type="radio" class="pay_label" id="pay_once" name="pay_type" value="pay" checked>
                            <label for="pay_once" class="pay_label"><?php echo $payonce_label; ?></label>
                        </div>
                        <div class="help-form-subscribe-right">
<!--                            <a href="#" paytype="subscribe" class="subscribe-link month">--><?php //echo $monthly_label; ?><!--</a>-->
                            <input type="radio" class="pay_label" id="pay_monthly" name="pay_type" value="subscribe">
                            <label for="pay_monthly" class="pay_label"><?php echo $monthly_label; ?></label>
                        </div>
                    </div>
                    <p class="help-form-text">
                        <?php echo $text_help_label; ?>
                    </p>
                    <div class="help-form-submit-oferta">
                        <div class="help-form-submit-wrapper">
                            <div class="help-form-submit"><input class="submit-btn" type="submit" value="<?php echo $help_label; ?>" /></div>
                        </div>

                        <div class="help-form-oferta-wrapper">
                            <div class="help-form-oferta">
                                <input type="checkbox" id="oferta" name="oferta" required>
                                <label for="oferta"><?php echo $agree_help_label; ?> <a href="<?php echo $agree_link; ?>" target="_blank" ><?php echo $agree_link_label; ?></a>*</label>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
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
$back_button = !empty($options['404_back_main_' . ICL_LANGUAGE_CODE]) ? $options['404_back_main_' . ICL_LANGUAGE_CODE] : 'На головну';

	ob_start();
	if( $_GET['cancel_subscription']==1 && isset($_GET['order_id']) ){
		global $wpdb, $table_prefix;
		$table_liqpay = $table_prefix . 'liqpay';
		if (!isset($wpdb))
	        require_once('../../../wp-config.php');

	    $sql = "Select comments from {$table_liqpay} where order_id = {$_GET['order_id']} AND status = 'subscribed'";
	    $sql_res = $wpdb->get_row($sql);
	    ?>
        <div class="help-form-inner-wrapper">
           <div class="help-form-inner-title">
           <?php
	            if (!empty($sql_res)) {
                    $merchant_id = get_option('liqpay_merchant_id');
                    $signature = get_option('liqpay_signature_id');

                    $liqpay = new MyLiqPay($merchant_id, $signature);

                    $res = $liqpay->api("request", array(
                        'action'        => 'unsubscribe',
                        'version'       => '3',
                        'order_id'      => $_GET['order_id']
                    ));
                    if( $res->result == 'ok' ) {
                        $wpdb->update( $table_liqpay, [ 'status'=>'unsubscribed' ], [ 'order_id'=>$_GET['order_id'] ] );
                    }
                    $message = !empty($options['cancel_subscription_text_after_' . ICL_LANGUAGE_CODE]) ? $options['cancel_subscription_text_after_' . ICL_LANGUAGE_CODE] : false;
                } else{
                    $message = !empty($options['cancel_subscription_text_after_' . ICL_LANGUAGE_CODE]) ? $options['cancel_subscription_text_after_' . ICL_LANGUAGE_CODE] : false;
                }
                echo "<h2>" . $message . "</h2>";
	            ?>
           </div>
            <div class="help-form-submit-oferta">
                <div class="help-form-submit-oferta">
                    <div class="help-form-submit"><a class="submit-btn" href="<?php echo home_url(); ?>"><?php echo $back_button; ?></a></div>
                </div>
            </div>
        </div>
	<?php }
	else{
	?>
	  <div class="help_form_wrapper">
	  	<div class="help-form-inner-wrapper">
	  	   <div class="help-form-inner-title">
				<?php echo $cancel_subscription_form_title; ?>
	  	   </div>
		   <form action="" method="POST" class="help_form cancel_subscription_form">
		   		<div class="cancel_subscription_form_inner_wrapper">
				    <div class="help-form-email-tel">
				    	<div class="help-form-amount-email">
				    		<input  class="textarea-small" type="email" name="mail" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email" required/>
				    	</div>
				    	<div class="help-form-amount-tel">
				    		<input  class="textarea-small" type="text" name="phone" value="" placeholder="<?php echo $phone_label; ?>" required/>
				    	</div>
				    	<div class="cansel-message error-message">
						  	<?php
							if(ICL_LANGUAGE_CODE=='uk'){
								echo 'Для введених даних відсутній регулярний платіж';
							}
							elseif(ICL_LANGUAGE_CODE=='ru'){
								echo 'Для введенных данных отсутствует регулярный платеж';
							}
							elseif(ICL_LANGUAGE_CODE=='en'){
								echo 'There is no recurring payment for the entered data';
							}
						  	?>
						</div>
				    </div>
			    	<div class="help-form-submit-oferta">
			    	 	<div class="help-form-submit"><input class="submit-btn" type="submit" value="<?php echo $cancel_subscription_form_submit_button; ?>" /></div>
			    	</div>
			    </div>
			    <div class="cancel_subscription_form_success_block">
			    	<div class="cansel-message success-message">
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
					  <div class="help-form-submit-oferta">
			    	 	<div class="help-form-submit"><a class="submit-btn" href="<?php echo home_url(); ?>"><?php echo $back_button; ?></a></div>
			    	</div>
			    </div>
			</form>
	      </div>
	  </div>
	<?php
	}
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
                        <a href="<?php echo get_permalink( $featured_post_id ); ?>"><?php echo get_the_title($featured_post_id);?></a>
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
                        <p class="project-money-collected"><span class="project-money-collected-inner"><?php echo $total_amount; ?></span><span> <?php echo check_currency(); ?></span></p>
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
    $partners_array = get_posts( array(
        'numberposts' => -1,
        'post_type'   => 'partners'
    ));
    $partners_array_by_6 = array_chunk($partners_array, 6, true);
    $partners_array_by_3 = array_chunk($partners_array, 3, true);

	?>
    <!-------------------------
		FRIENDS AND VOLUNTEERS
	-------------------------->
    <div class="friends-and-volunteers">
        <!------------
			FRIENDS
		-------------->
        <div class="friends-wrapper">
            <div class="friends">
                <h3 class="friends-title"><?php pll_e( 'Друзі та волонтери фонду ');?></h3>
                <!-- FRIENDS SLIDER -->
                <div class="friends-slider">
                    <?php
                    foreach( $friends_array_by_7 as $post_wrapper ){
                        echo '<div class="friends-slide">';
                        foreach( $post_wrapper as $post ){
                            $friends_link_title = get_post_meta($post->ID, 'title', true);
                            $friends_link = get_post_meta($post->ID, 'link', true);
                            ?>
                            <div class="friends-slide-row">
                                <p class="friends-name"><?php echo $post->post_title;?></p>
                                <a class="friends-link" href="<?php echo $friends_link;?>" target="_blank"><?php echo $friends_link_title;?></a>
                            </div>
                            <?php
                        }
                        echo '</div>';
                    }
                    ?>
                </div><!-- end friends slider -->
            </div><!-- end friends -->
        </div><!-- end friends-wrapper-->
        <!-------------------------------
			HOMEPAGE PARTNERS BLOCK
		--------------------------------->
        <div class="home-parnters">
            <h3 class="home-parnters-title"><?php pll_e( 'Партнери');?></h3>

            <!-------------------------------------
				HOMEPAGE PARTNERS SLIDER DESKTOP
			-------------------------------------->
            <div class="home-parnters-slider">
                <!-- ONE SLIDE -->
                <?php
                foreach( $partners_array_by_6 as $post_wrapper ){
                    echo '<div class="home-parnters-one-slide">';
                    foreach( $post_wrapper as $post ){
                        $partner_link = get_post_meta($post->ID, 'partner_site_link', true); ?>
                        <div class="home-parnters-img-wrapper">
                            <a href="<?php echo $partner_link; ?>" target="_blank"><?php echo get_the_post_thumbnail($post->ID, 'full'); ?></a>
                        </div>
                        <?php
                    }
                    echo '</div>';
                }
                ?>
            </div>
            <!-------------------------------------
				HOMEPAGE PARTNERS SLIDER MOBILE
			-------------------------------------->
            <div class="home-parnters-slider-mob">
                <!-- ONE SLIDE -->
                <?php
                foreach( $partners_array_by_3 as $post_wrapper ){
                    echo '<div class="home-parnters-one-slide">';
                    foreach( $post_wrapper as $post ){
                        $partner_link = get_post_meta($post->ID, 'partner_site_link', true); ?>
                        <div class="home-parnters-img-wrapper">
                            <a href="<?php echo $partner_link; ?>" target="_blank"><?php echo get_the_post_thumbnail($post->ID, 'full'); ?></a>
                        </div>
                        <?php
                    }
                    echo '</div>';
                }
                ?>
            </div><!-- end home-parnters-slider-mob -->
        </div><!-- end home-parnters -->
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
	global $wpdb, $table_prefix;
	$table_liqpay = $table_prefix . 'liqpay';
	if (!isset($wpdb))
        require_once('../../../wp-config.php');

    $user_mail = sanitize_text_field( $_POST['client_mail'] );

    $sql = "Select order_id, summa, comments from {$table_liqpay} where email = '{$user_mail}' and status = 'subscribed'";
    $sql_res = $wpdb->get_results($sql);


    if($sql_res){
    	foreach ($sql_res as $value) {
    		$liqpay_order_id[]=array('order_id'=>$value->order_id,'comments'=>$value->comments);
    	}
    }

    if($liqpay_order_id){
        $symbol = 'грн';
    	if(ICL_LANGUAGE_CODE=='uk'){
			$start_message =  "Для підтвердження скасування регулярного платежу перейдіть за посиланням нижче<br>";
			$subject = 'Скасування регулярного платежу';
			$redirect_page_link = '/vidminiti-reguljarnij-platizh/';
		}
		elseif(ICL_LANGUAGE_CODE=='ru'){
			$start_message =  "Для подтверждения отмены регулярного платежа перейдите по ссылке ниже<br>";
			$subject = 'Отмена регулярного платежа';
			$redirect_page_link = '/ru/otmenit-reguljarnyj-platezh/';
		}
		elseif(ICL_LANGUAGE_CODE=='en'){
			$start_message =  "To confirm the cancellation of the regular payment, follow the link below<br>";
			$subject = 'Cancel recurring payment';
			$redirect_page_link = '/en/cancel_subscription/';
            $symbol = 'UAH';
		}
    	$mail_body = $start_message;

    	$link = site_url() . $redirect_page_link . '?cancel_subscription=1' . '&order_id=';
        foreach ($liqpay_order_id as $order ) {
            $project_id =  get_option($order['order_id'] . '-liqpay_post_id');
            if( $project_id != 823 ) {
                $the_post = get_post( $project_id );
                $project_name = "на проект " .$the_post->post_title;
            } else{
                $project_name = '';
            }

            $mail_body .= $order['comments'] . " в розмiрi " . $order['summa'] . $symbol . " " . $project_name . " - ";
			$mail_body .= '<a href="'. $link . $order['order_id'].'">' . $link . $order['order_id'] . '</a>' . "<br>";
    	}	   

    	$result = send_notification($user_mail,$subject, $mail_body);
    }   

    exit( json_encode( array( 'result' => $result ) ) );   
}

function send_notification( $to, $subject, $mail_body ) {
	$admin_email = get_option( 'admin_email' );
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: БФ "Запорука" <' . $admin_email . '>' . "\r\n";    
	$mail_sending_result = wp_mail( $to, $subject, $mail_body, $headers );
	return $mail_sending_result;
}
