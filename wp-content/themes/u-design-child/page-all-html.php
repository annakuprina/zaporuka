<?php
/**
* Template Name: All HTML Page
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

?>

<div id="content-container" class="container_24">
	<main id="main-content" role="main" class="<?php echo esc_attr( $content_position ); ?>">
		<div class="main-content-padding">

		<!-- One project -->
			<div class="one-project">
				<div class="one-project-left"><img src="<?php echo get_stylesheet_directory_uri()?>/img/one-project-img.jpg"></div>
				<div class="one-project-right">
					<div class="one-project-title">Проекти</div>
					<div class="one-project-info">
						<p class="one-project-info-title">
							Центр для онкохворих дiтей «Дача»
						</p>
						<p class="one-project-info-text">
							Центр Дача — це дім для проживання онкохворих дітей та їхніх родин, які приїздять на лікування до Києва.
						</p>
					</div>
					<div class="one-project-progress">
						<div class="one-project-progress-top">
							<p class="project-money">
								<span class="project-money-quantity">2 156 790 грн.</span>
								<span class="project-money-involved">залучено</span>
							</p>
							<p class="project-money-collected">18 000 000 грн.</p>
						</div>
						<div class="one-project-progress-bottom">
							<div class="progress-bar">
								<span class="progress-done"></span>
								<span class="progress-dot"></span>
							</div>
						</div>

					</div>
					<a href="#" class="one-project-help">
						<span>Допомогти</span> 
					</a>
				</div><!-- end one-project-right -->
			</div><!-- end one-project -->


			<!----------
				PARTNERS
			----------->
			<div class="partners">
				<h3 class="partners-title">Партнери</h3>	
				<!-- PARTNERS SLIDER DESKTOP-->
				<div class="partners-slider">

						<!-- One slide -->
						<div class="partners-slide soleterre-slide">
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/soleterre.jpg">
							<!-- Slide text -->
							<div class="partners-slide-text">
								<p>Associazione Soleterre</p>
								<p>Strategie di Pace —</p>
								<p>головний партнер фонду.</p>
								<a class="partner-link" href="www.soleterre.org">www.soleterre.org</a>
							</div>
						</div><!-- end one slide-->

						<!-- One slide -->
						<div class="partners-slide styler-slide"> 
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/styler.jpg">
							<!-- Slide text -->
							<div class="partners-slide-text"> 
								<p>Медіапартнер проекту</p>
								<p><span class="dacha">«Дача» — </span><span class="rbk-ukraine">РБК-Украина.</span></p>
								<a class="partner-link" href="www.rbc.ua">www.rbc.ua</a>
							</div>
						</div><!-- end one slide-->

						<!-- One slide -->
						<div class="partners-slide golos-stolitsy-slide">
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/golos-stolitsy.jpg">
							<!-- Slide text -->
							<div class="partners-slide-text">
								<p>Голос столиці –</p>
								<p>інформаційна</p>
								<p>радіостанція.</p>
								<a class="partner-link" href="www.gs.fm">www.gs.fm</a>
							</div>
						</div><!-- end one slide-->

						<!-- One slide -->
						<div class="partners-slide"> 
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/test-logo1.png">
							<!-- Slide text -->
							<div class="partners-slide-text"> 
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid aut consequuntur atque explicabo eos nesciunt! Aliquid aut consequuntur atque explicabo eos</p>
								<a class="partner-link" href="www.rbc.ua">www.rbc.ua</a>
							</div>
						</div><!-- end one slide-->

						<!-- One slide -->
						<div class="partners-slide">
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/test-logo2.png">
							<!-- Slide text -->
							<div class="partners-slide-text">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam est necessitatibus debitis, provident vel aspernatur.</p>
								<a class="partner-link" href="www.gs.fm">www.gs.fm</a>
							</div>
						</div><!-- end one slide-->	
				</div><!-- end partners slider-->

				<!-- PARTNERS SLIDER MOBILE-->
				<div class="partners-slider-mob">
						<!-- One slide -->
						<div class="partners-slide soleterre-slide">

						<div class="partners-slider-mob-img">
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/soleterre.jpg">
						</div>
							<!-- Slide text -->
							<div class="partners-slide-text">
								<p>
									Associazione Soleterre Strategie di Pace —	головний партнер фонду.
									<a class="partner-link" href="www.soleterre.org">www.soleterre.org</a>
								</p>
							</div>
						</div><!-- end one slide-->

						<!-- One slide -->
						<div class="partners-slide styler-slide"> 
							<div class="partners-slider-mob-img">
								<img src="<?php echo get_stylesheet_directory_uri()?>/img/styler.jpg">
							</div>

							<!-- Slide text -->
							<div class="partners-slide-text"> 
								<p>Медіапартнер проекту «Дача» —  РБК-Украина, незалежна українська інформаційна агенція.</p>
								<p> www.rbc.ua</p>
							</div>
						</div><!-- end one slide-->

						<!-- One slide -->
						<div class="partners-slide golos-stolitsy-slide">
							<div class="partners-slider-mob-img">
								<img src="<?php echo get_stylesheet_directory_uri()?>/img/golos-stolitsy.jpg">
							</div>

							<!-- Slide text -->
							<div class="partners-slide-text">
								<p>Голос столиці –</p>
								<p>інформаційна</p>
								<p>радіостанція.</p>
								<a class="partner-link" href="www.gs.fm">www.gs.fm</a>
							</div>
						</div><!-- end one slide-->

						<!-- One slide -->
						<div class="partners-slide"> 
							<div class="partners-slider-mob-img">
								<img src="<?php echo get_stylesheet_directory_uri()?>/img/test-logo1.png">
							</div>

							<!-- Slide text -->
							<div class="partners-slide-text"> 
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid aut consequuntur atque explicabo eos nesciunt! Aliquid aut consequuntur atque explicabo eos</p>
								<a class="partner-link" href="www.rbc.ua">www.rbc.ua</a>
							</div>
						</div><!-- end one slide-->

						<!-- One slide -->
						<div class="partners-slide">
							<div class="partners-slider-mob-img">
								<img src="<?php echo get_stylesheet_directory_uri()?>/img/test-logo2.png">
							</div>

							<!-- Slide text -->
							<div class="partners-slide-text">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam est necessitatibus debitis, provident vel aspernatur.</p>
								<a class="partner-link" href="www.gs.fm">www.gs.fm</a>
							</div>
						</div><!-- end one slide-->	
				</div><!-- end partners-slider-mob-->
			</div><!-- end partners-->

			<!-------------------------
				FRIENDS AND VOLUNTEERS
			-------------------------->
			<div class="friends-and-volunteers">
				<!---------
					FRIENDS 
				----------->
				<div class="friends-wrapper">
					<div class="friends">
						<h3 class="friends-title">Друзi</h3>	

						<!-- FRIENDS SLIDER -->
						<div class="friends-slider">

							<!-- ONE SLIDE -->
							<div class="friends-slide">
								<div class="friends-slide-row">	
									<p class="friends-name">KVADRA INVEST</p>
									<a class="friends-link" href="http://kvadrainvest.com/">kvadrainvest.com</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">UniСredit Foundation</p>
									<a class="friends-link" href="http://www.unicreditfoundation.org/">www.unicreditfoundation.org</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Un gesto per loro onlus</p>
									<a class="friends-link" href="http://www.ungestoperloro.org/">www.ungestoperloro.org</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Івент-медійна компанія Естет</p>
									<a class="friends-link" href="http://www.estet.com.ua/">www.estet.com.ua</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Райффайзен Банк Аваль</p>
									<a class="friends-link" href="http://www.aval.ua/">www.aval.ua</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Компанія KSF Technologies</p>
									<a class="friends-link" href="http://www.ksftech.com/">www.ksftech.com</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Авіаційне агенство Airlife</p>
									<a class="friends-link" href="http://www.airlife.ua/">www.airlife.ua</a>
								</div>
							</div><!-- end one slide-->

							<!-- ONE SLIDE -->
							<div class="friends-slide">
								<div class="friends-slide-row">	
									<p class="friends-name">KVADRA INVEST</p>
									<a class="friends-link" href="http://kvadrainvest.com/">kvadrainvest.com</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">UniСredit Foundation</p>
									<a class="friends-link" href="http://www.unicreditfoundation.org/">www.unicreditfoundation.org</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Un gesto per loro onlus</p>
									<a class="friends-link" href="http://www.ungestoperloro.org/">www.ungestoperloro.org</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Івент-медійна компанія Естет</p>
									<a class="friends-link" href="http://www.estet.com.ua/">www.estet.com.ua</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Райффайзен Банк Аваль</p>
									<a class="friends-link" href="http://www.aval.ua/">www.aval.ua</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Компанія KSF Technologies</p>
									<a class="friends-link" href="http://www.ksftech.com/">www.ksftech.com</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Авіаційне агенство Airlife</p>
									<a class="friends-link" href="http://www.airlife.ua/">www.airlife.ua</a>
								</div>
							</div><!-- end one slide-->
							
							<!-- ONE SLIDE -->
							<div class="friends-slide">
								<div class="friends-slide-row">	
									<p class="friends-name">KVADRA INVEST</p>
									<a class="friends-link" href="http://kvadrainvest.com/">kvadrainvest.com</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">UniСredit Foundation</p>
									<a class="friends-link" href="http://www.unicreditfoundation.org/">www.unicreditfoundation.org</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Un gesto per loro onlus</p>
									<a class="friends-link" href="http://www.ungestoperloro.org/">www.ungestoperloro.org</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Івент-медійна компанія Естет</p>
									<a class="friends-link" href="http://www.estet.com.ua/">www.estet.com.ua</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Райффайзен Банк Аваль</p>
									<a class="friends-link" href="http://www.aval.ua/">www.aval.ua</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Компанія KSF Technologies</p>
									<a class="friends-link" href="http://www.ksftech.com/">www.ksftech.com</a>
								</div>

								<div class="friends-slide-row">	
									<p class="friends-name">Авіаційне агенство Airlife</p>
									<a class="friends-link" href="http://www.airlife.ua/">www.airlife.ua</a>
								</div>
							</div><!-- end one slide-->
						</div><!-- end friends slider -->
					</div><!-- end friends -->
				</div><!-- end friends-wrapper-->
				<!-------------
					VOLUNTEERS 
				-------------->
				<div class="volunteers">
					<h3 class="volunteers-title">Волонтери</h3>	

					<!---------------------------
						VOLUNTEERS SLIDER DESKTOP
					---------------------------->
					<div class="volunteers-slider">
						<!-- ONE SLIDE -->
						<div class="volunteers-slide">

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Ольга Демчук</div>
									<div class="one-volunteer-position">Організація благодійних заходів</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Аня Тахтарова</div>
									<div class="one-volunteer-position">Організація дозвілля</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Ольга Станіславська</div>
									<div class="one-volunteer-position">Дизайнер</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Олена Демешко</div>
									<div class="one-volunteer-position">Організація дозвілля</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Аліна Тосич</div>
									<div class="one-volunteer-position">Організація свят для підопічних</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Наталя Площинська</div>
									<div class="one-volunteer-position">Творчі заняття з дітьми</div>
								</div>
							</div><!-- end one volunteer -->
						</div><!-- end one slide -->

						<!-- ONE SLIDE -->
						<div class="volunteers-slide">
							<div class="volunteers-slide-left">
								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Ольга Демчук</div>
										<div class="one-volunteer-position">Організація благодійних заходів</div>
									</div>
								</div><!-- end one volunteer -->

								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Ольга Станіславська</div>
										<div class="one-volunteer-position">Дизайнер</div>
									</div>
								</div><!-- end one volunteer -->

								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Аліна Тосич</div>
										<div class="one-volunteer-position">Організація свят для підопічних</div>
									</div>
								</div><!-- end one volunteer -->
							</div><!-- end volunteers-slide-left -->

							<div class="volunteers-slide-right">
								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Аня Тахтарова</div>
										<div class="one-volunteer-position">Організація дозвілля</div>
									</div>
								</div><!-- end one volunteer -->

								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Олена Демешко</div>
										<div class="one-volunteer-position">Організація дозвілля</div>
									</div>
								</div><!-- end one volunteer -->

								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Наталя Площинська</div>
										<div class="one-volunteer-position">Творчі заняття з дітьми</div>
									</div>
								</div><!-- end one volunteer -->
							</div><!-- end end volunteers-slide-left -->
						</div><!-- end one slide -->

						<!-- ONE SLIDE -->
						<div class="volunteers-slide">
							<div class="volunteers-slide-left">
								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Ольга Демчук</div>
										<div class="one-volunteer-position">Організація благодійних заходів</div>
									</div>
								</div><!-- end one volunteer -->

								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Ольга Станіславська</div>
										<div class="one-volunteer-position">Дизайнер</div>
									</div>
								</div><!-- end one volunteer -->

								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Аліна Тосич</div>
										<div class="one-volunteer-position">Організація свят для підопічних</div>
									</div>
								</div><!-- end one volunteer -->
							</div><!-- end volunteers-slide-left -->

							<div class="volunteers-slide-right">
								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Аня Тахтарова</div>
										<div class="one-volunteer-position">Організація дозвілля</div>
									</div>
								</div><!-- end one volunteer -->

								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Олена Демешко</div>
										<div class="one-volunteer-position">Організація дозвілля</div>
									</div>
								</div><!-- end one volunteer -->

								<!-- One volunteer -->
								<div class="one-volunteer">
									<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
									<div class="one-volunteer-info">
										<div class="one-volunteer-name">Наталя Площинська</div>
										<div class="one-volunteer-position">Творчі заняття з дітьми</div>
									</div>
								</div><!-- end one volunteer -->
							</div><!-- end end volunteers-slide-left -->
						</div><!-- end one slide -->
					</div><!-- end volunteers-slider -->

					<!---------------------------
						VOLUNTEERS SLIDER MOBILE
					---------------------------->
					<div class="volunteers-slider-mob">
						<!-- ONE SLIDE -->
						<div class="volunteers-slide">
							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Ольга Демчук</div>
									<div class="one-volunteer-position">Організація благодійних заходів</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Ольга Станіславська</div>
									<div class="one-volunteer-position">Дизайнер</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Аліна Тосич</div>
									<div class="one-volunteer-position">Організація свят для підопічних</div>
								</div>
							</div><!-- end one volunteer -->
						</div><!-- end one slide -->


						<!-- ONE SLIDE -->
						<div class="volunteers-slide">
							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Аня Тахтарова</div>
									<div class="one-volunteer-position">Організація дозвілля</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Олена Демешко</div>
									<div class="one-volunteer-position">Організація дозвілля</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Наталя Площинська</div>
									<div class="one-volunteer-position">Творчі заняття з дітьми</div>
								</div>
							</div><!-- end one volunteer -->
						</div><!-- end one slide -->	

						<!-- ONE SLIDE -->
						<div class="volunteers-slide">
							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer1.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Ольга Демчук</div>
									<div class="one-volunteer-position">Організація благодійних заходів</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer2.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Ольга Станіславська</div>
									<div class="one-volunteer-position">Дизайнер</div>
								</div>
							</div><!-- end one volunteer -->

							<!-- One volunteer -->
							<div class="one-volunteer">
								<div class="one-volunteer-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/volunteer3.jpg"></div>
								<div class="one-volunteer-info">
									<div class="one-volunteer-name">Аліна Тосич</div>
									<div class="one-volunteer-position">Організація свят для підопічних</div>
								</div>
							</div><!-- end one volunteer -->
						</div><!-- end one slide -->

					</div><!-- end volunteers-slider -->
				</div><!-- end volunteers -->
			</div><!-- end friends-and-volunteers -->

			<div class="clear"></div>
		</div><!-- end main-content-padding -->

		<!-- ONE PROJECT BANNER -->
		<div class="one-project-banner">
			<div class="one-project-banner-image">
				<img src="<?php echo get_stylesheet_directory_uri()?>/img/one-project-img.jpg">
			</div>

			<div class="one-project-banner-inner">
				<div class="one-project-title">Проекти</div>
				<div class="one-project-info">
					<p class="one-project-info-title">
						Центр для онкохворих дiтей «Дача»
					</p>
					<p class="one-project-info-text">
						Тут постійно проживає 6 сімей. У кожної сім’ї своя окрема кімната,
						яка на період лікування стає справжнім, хай і тимчасовим, домом.
						У кожної сім’ї своя окрема кімната, яка на період лікування стає
						справжнім, хай і тимчасовим, домом.
					</p>
				</div>
				<div class="one-project-progress">
					<div class="one-project-progress-top">
						<p class="project-money">
							<span class="project-money-quantity"><span class="project-money-quantity-inner">256 790</span><span> грн.</span></span>
							<span class="project-money-involved">залучено</span>
						</p>
						<p class="project-money-collected"><span class="project-money-collected-inner">18 000 000</span><span> грн.</span></p>
					</div>
					<div class="one-project-progress-bottom">
						<div class="progress-bar">
							<span class="progress-done"></span>
							<span class="progress-dot"></span>
						</div>
					</div>

				</div>
				<div class="help-and-share">
					<p class="help-link">
						<a href="#" class="one-project-help">
							<span>Допомогти</span> 
						</a>
					</p>
					<a href="#" class="share">
						<span class="one-project-share">Подiлитися</span> 
						<span class="one-project-socials">
							<i class="fa fa-facebook" aria-hidden="true"></i>
						</span>
					</a>
				</div><!-- end help-and-share -->
			</div><!-- end one-project-right -->
		</div><!-- end one-project-banner -->


		<!-------------------
			PROJECT TIMELINE 
		-------------------->
		<div class="proj-timeline">
			<!-- Top part: heared and orange right banner  -->
			<div class="proj-timeline-top">
				<h2 class="h2-header-line"><?php pll_e( 'Таймлайн проекту');?></h2>
				<div class="proj-timeline-info">
					<div class="proj-timeline-info-left">
						<p class="left-to-collect-text"><?php pll_e( 'Залишилось  зiбрати:');?></p>
						<p class="left-to-collect-wrapper">
							<span class="left-to-collect-amount">17 070 000 </span>
							<span>грн.</span>
						</p>
					</div><!-- end proj-timeline-info-left -->
					<div class="proj-timeline-info-right">
						<a href="#" class="proj-timeline-help">
							<span class="proj-timeline-help-text">Допомогти</span>
						</a>
						<a href="#" class="proj-timeline-share">
							<span class="proj-timeline-share-text">Поширити у</span>
							<i class="fa fa-facebook" aria-hidden="true"></i>
						</a>
					</div><!-- end proj-timeline-info-right -->
				</div><!-- end proj-timeline-info -->
			</div><!-- end proj-timeline-top -->

			<!-- Central part of block: Projects steps -->
			<div class="proj-timeline-steps">

				<!-- ONE STEP -->
				<div class="proj-timeline-one-step finished">
					<!-- Hidden  timeline for mob version-->
					<!-- <div class="one-step-timeline-mob">
						<p class="one-step-timeline-finished"></p>
					</div> -->

					<div class="one-step-timeline-wrapper">
						<div class="one-step-title">Купiвля землi</div>
						<!-- Timeline for desktop vesrion -->
						<div class="one-step-timeline">
							<p class="one-step-timeline-inner"></p>
						</div>
						<div class="one-step-money">
							<span class="one-step-money-text">Залишилось</span>
							<span class="money-left-to-collect"> 930 000</span>
							<span class="one-step-money-text">з</span>
							<span class="project-total-cost">1 200 000</span>
							<span>грн.</span>
						</div><!-- end one-step-money -->
					</div><!-- end one-step-timeline-wrapper -->
				</div><!-- end proj-timeline-one-step -->

				<!-- ONE STEP -->
				<div class="proj-timeline-one-step in-progress">
					<!-- Hidden  timeline for mob version-->
					<!-- <div class="one-step-timeline-mob">
						<p class="one-step-timeline-finished"></p>
					</div> -->
					
					<div class="one-step-timeline-wrapper">
						<div class="one-step-timeline-wrapper">
							<div class="one-step-title">Земельнi роботи</div>
							<!-- Timeline for desktop vesrion -->
							<div class="one-step-timeline">
								<p class="one-step-timeline-inner"></p>
							</div>
							<div class="one-step-money">
								<span class="money-left-to-collect">6 500 000 </span>
								<span>грн.</span>
							</div><!-- end one-step-money -->	
						</div><!-- end one-step-timeline-wrapper -->
					</div><!-- end one-step-timeline-wrapper -->
				</div><!-- end proj-timeline-one-step -->

				<!-- ONE STEP -->
				<div class="proj-timeline-one-step">
					<!-- Hidden  timeline for mob version-->
					<!-- <div class="one-step-timeline-mob">
						<p class="one-step-timeline-finished"></p>
					</div> -->

					<div class="one-step-timeline-wrapper">
						<div class="one-step-title">Будiвництво</div>
						<!-- Timeline for desktop vesrion -->
						<div class="one-step-timeline">
							<p class="one-step-timeline-inner"></p>
						</div>
						<div class="one-step-money">
							<span class="money-left-to-collect">14 000 000 </span>
							<span>грн.</span>
						</div><!-- end one-step-money -->
					</div><!-- end one-step-timeline-wrapper -->
				</div><!-- end proj-timeline-one-step -->

				<!-- ONE STEP -->
				<div class="proj-timeline-one-step">
					<!-- Hidden  timeline for mob version-->
					<!-- <div class="one-step-timeline-mob">
						<p class="one-step-timeline-finished"></p>
					</div> -->

					<div class="one-step-timeline-wrapper">
						<div class="one-step-title">Облаштування</div>
						<!-- Timeline for desktop vesrion -->
						<div class="one-step-timeline"></div>
							<p class="one-step-timeline-inner"></p>
						<div class="one-step-money">
							<span class="money-left-to-collect">18 000 000</span>
							<span>грн.</span>
						</div><!-- end one-step-money -->	
					</div><!-- end one-step-timeline-wrapper -->
				</div><!-- end proj-timeline-one-step -->

			</div><!-- end proj-timeline-steps -->
		</div><!-- end proj-timeline -->
	</main><!-- end main-content -->
<!-------------- 
		CHILDREN
--------------->

<div class="children-wrapper">

	<!-- One-child -->
	<div class="child">
		<div class="child-top">
			<div class="child-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/child-photo4.jpg"></div>
			<div class="child-info">
				<p class="child-name-and-age">
					<span class="child-name">Матвій</span>
					<span>,</span>
					<span class="child-age">2 роки</span>
					<span>,</span>
				</p>
				<p class="child-region">
					Львівська обл.
				</p>
			</div><!-- end child-info -->
		</div><!-- end child-top -->
		<div class="child-bottom">
			Пацієнт Відділу дитячої нейрохірургії. Сума
			допомоги – <span class="help-amount">2655,12 грн.</span><span class="kind-of-help"> (медикаменти та витратні)</span> .
		</div>
	</div><!-- end one-child  -->		

		<!-- One-child -->
		<div class="child">
		<div class="child-top">
			<div class="child-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/child-photo1.jpg"></div>
			<div class="child-info">
				<p class="child-name-and-age">
					<span class="child-name">Єва</span>
					<span>,</span>
					<span class="child-age">4 роки</span>
					<span>,</span>
				</p>
				<p class="child-region">
					Луганська обл.
				</p>
			</div><!-- end child-info -->
		</div><!-- end child-top -->
		<div class="child-bottom">
			Пацієнт Відділу дитячої нейрохірургії. Сума
			допомоги – <span class="help-amount">1720,11 грн.</span><span class="kind-of-help"> (медикаменти та витратні)</span> .
		</div>
	</div><!-- end one-child  -->	

		<!-- One-child -->
		<div class="child">
		<div class="child-top">
			<div class="child-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/child-photo3.jpg"></div>
			<div class="child-info">
				<p class="child-name-and-age">
					<span class="child-name">Ілля</span>
					<span>,</span>
					<span class="child-age">13 років</span>
					<span>,</span>
				</p>
				<p class="child-region">
					Київська обл.
				</p>
			</div><!-- end child-info -->
		</div><!-- end child-top -->
		<div class="child-bottom">
			Пацієнт Відділу дитячої нейрохірургії. Сума
			допомоги – <span class="help-amount">23729,89 грн.</span><span class="kind-of-help"> (медикаменти та витратні для операції).</span> .
		</div>
	</div><!-- end one-child  -->	

		<!-- One-child -->


		<div class="child">
		<div class="child-top">
			<div class="child-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/child-photo3.jpg"></div>
			<div class="child-info">
				<p class="child-name-and-age">
					<span class="child-name">Вадим</span>
					<span>,</span>
					<span class="child-age"> 11 років</span>
					<span>,</span>
				</p>
				<p class="child-region">
					Вінницька обл.
				</p>
			</div><!-- end child-info -->
		</div><!-- end child-top -->
		<div class="child-bottom">
			Пацієнт Відділу дитячої нейрохірургії. Сума
			допомоги – <span class="help-amount">8000,18 грн.</span><span class="kind-of-help"> (медикаменти та витратні)</span> .
		</div>
	</div><!-- end one-child  -->	

	<!-- One-child -->
	<div class="child">
		<div class="child-top">
			<div class="child-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/child-photo4.jpg"></div>
			<div class="child-info">
				<p class="child-name-and-age">
					<span class="child-name">Роман</span>
					<span>,</span>
					<span class="child-age">3 роки</span>
					<span>,</span>
				</p>
				<p class="child-region">
					Івано-Франківська обл.
				</p>
			</div><!-- end child-info -->
		</div><!-- end child-top -->
		<div class="child-bottom">
			Пацієнт Відділу дитячої нейрохірургії. Сума
			допомоги – <span class="help-amount">35373,03 грн.</span><span class="kind-of-help"> (медикаменти та витратні)</span> .
		</div>
	</div><!-- end one-child  -->	

	<!-- One-child -->
	<div class="child">
		<div class="child-top">
			<div class="child-photo"><img src="<?php echo get_stylesheet_directory_uri()?>/img/child-photo2.jpg"></div>
			<div class="child-info">
				<p class="child-name-and-age">
					<span class="child-name">Іван</span>
					<span>,</span>
					<span class="child-age">6 років</span>
					<span>,</span>
				</p>
				<p class="child-region">
					Одеська обл.
				</p>
			</div><!-- end child-info -->
		</div><!-- end child-top -->
		<div class="child-bottom">
			Пацієнт Відділу дитячої нейрохірургії. Сума допомоги 
			допомоги – <span class="help-amount">14958,87 грн.</span><span class="kind-of-help"> (медикаменти та витратні)</span> .
		</div>
	</div><!-- end one-child  -->	
	<div class="pagination-block">ПАГИНАЦИЯ</div>
</div><!-- end children-wrapper -->		


<!------------
		REVIEWS 
------------->
<div class="reviews">
	<h2 class="h2-header-line">Вiдгуки</h2>
	<div class="reviews-wrapper">
		<div class="reviews-item">
			<div class="reviews-item-title">
				<p>Мама Софійки </p>
				<p>с. Локниця, Рівненська область.</p>
			</div>
			<div class="reviews-item-text">
				«Коли вступаєш у бій не сам, то і боротися з бідою легше…» Тисячі наших слів
				подяки буде все одно замало, щоб висловити нашу повагу і вдячність усьому колективу
				благодійного фонду «Запорука». Ваша робота дарує людям впевненість, ваші посмішки 
				зігрівають тисячі маленьких дитячих сердець. Щоразу, бачачи вас і розуміючи всю глибину 
				доброти ваших вчинків, переконуючись у тому, що людська доброта безмежна!!!
				Нехай ніколи не заростає стежина щедрості ваших думок, нехай серце зігріває дитячий сміх.
				Низький уклін і велике людське «СПАСИБI»!
			</div>
		</div>
		<div class="reviews-item">
			<div class="reviews-item-title">
				<p>Бабуся Іоани</p>
				<p> м. Авдіївка</p>
			</div>
			<div class="reviews-item-text">
				Я стаю на коліна з відчуттям великої вдячності та глибокої пошани перед кожним,
				хто у надто важкі хвилини для нашої сім’ї не залишився байдужим, а прийшов нам на допомогу.
				Теплом, надією і вірою переповнене моє серце, бо знаю, що  у цьому світі я не одна зі своєю
				бідою: поруч є люди, які так багато зробили для нас. Їх допомога свідчить про велику людяність,
				доброту, любов до ближнього. Хай у Ваших оселях панує спокій, злагода, любов, бо Ви цього варті.
			</div>
		</div><!-- end reviews-item-text -->

	</div><!-- end reviews-item -->
	<div class="pagination-block">ПАГИНАЦИЯ</div>
</div><!-- end reviews -->	


<!------------------------------------------
		HELP(orange blocks and contact form) 
------------------------------------------->
<div class="help">
	<div class="help-left">
		<?php echo do_shortcode('[help_form]');?>
	</div><!-- end of help-left -->
	<div class="help-right">
			<!-- One square -->
			<div class="help-item">
				<div class="help-item-title">Стати партнером</div>
				<div class="help-item-info">
					<div class="help-item-deskr">Детальна інформмація</div>
					<a href="#" class="help-item-link">Стати партнером</a>
				</div>
			</div><!-- end help-item -->

			<!-- One square -->
			<div class="help-item">
				<div class="help-item-title">Набір помічників</div>
				<div class="help-item-info">
					<div class="help-item-deskr">БФ «Запорука» оголошуємо про набір добровільних помічників</div>
					<a href="#" class="help-item-link">Стати волонтером</a>
				</div>
			</div><!-- end help-item -->

			<!-- One square -->
			<div class="help-item">
				<div class="help-item-title">Допомогти, вiдправивши смс на номер 88077</div>
				<div class="help-item-info">
					<div class="help-item-deskr">Допомогти, вiдправивши смс на номер 88077</div>
					<a href="#" class="help-item-link">Вiдправити СМС</a>
				</div>
			</div><!-- end help-item -->

			<!-- One square -->
			<div class="help-item">
				<div class="help-item-title">Благодiйна крамниця</div>
				<div class="help-item-info">
					<div class="help-item-deskr">Детальна інформмація</div>
					<a href="#" class="help-item-link">До крамниці</a>
				</div>
			</div><!-- end help-item -->

	</div><!-- end help-right -->
</div><!-- end help -->

		

<!----------------------------------
	PHOTO, VIDEO, DOCUMENTS SLIDERS 
----------------------------------->
<div class="sliders-tabs">
	<div class="sliders-tabs-wrapper">
		<div class="one-tab-link tab-active" data-id="1">
			Фотографiї
		</div>
		<div class="one-tab-link" data-id="2">
			Вiдео
		</div>
		<div class="one-tab-link" data-id="3">
			Супутнi документи
		</div>
	</div>

	<div class="proj-milestone-desc-block">
		<div class="tabs_content active" data-id="1">
			<!-- PHOTO SLIDER -->
			<div class="photo-slider slick-media-slider" >
				<div class="photo-slide">
					<img src="/wp-content/themes/u-design-child/img/tulen.jpg">
				</div>
				<div class="photo-slide">
					<img src="/wp-content/themes/u-design-child/img/tulen.jpg">
				</div>
				<div class="photo-slide">
					<img src="/wp-content/themes/u-design-child/img/tulen.jpg">
				</div>
				<div class="photo-slide">
					<img src="/wp-content/themes/u-design-child/img/tulen.jpg">
				</div>
			</div><!--end photo-slider-->

		</div>
		<div class="tabs_content" data-id="2">
			<!-- VIDEO SLIDER -->
			<div class="video-slider slick-media-slider">
				<div>
					<a
						href="https://www.youtube.com/embed/gPuI_pbCYOI"
						target="_blank"
						class="thumbnail">
						<p class="video-slider-img-wrapper">
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/one-project-img.jpg">
							<span class="play-video-icon"></span>
						</p>
					</a>
					<p class="video-slider-text">Переможець конкурсу «Благодійник року» у номінації «Благодійна організація»</p>
				</div>

				<div>
					<a
						href="https://www.youtube.com/embed/gPuI_pbCYOI"
						target="_blank"
						class="thumbnail">
						<p class="video-slider-img-wrapper">
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/one-project-img.jpg">
							<span class="play-video-icon"></span>
						</p>
					</a>
					<p class="video-slider-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, et.</p>
				</div>

				<div>
					<a href="https://www.youtube.com/embed/gPuI_pbCYOI"
						target="_blank"
						class="thumbnail">
						<p class="video-slider-img-wrapper">
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/one-project-img.jpg">
							<span class="play-video-icon"></span>
						</p>
					</a>
					<p class="video-slider-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, et.</p>
				</div>

				<div>
					<a
						href="https://www.youtube.com/embed/gPuI_pbCYOI"
						target="_blank"
						class="thumbnail">
						<p class="video-slider-img-wrapper">
							<img src="<?php echo get_stylesheet_directory_uri()?>/img/one-project-img.jpg">
							<span class="play-video-icon"></span>
						</p>
					</a>
					<p class="video-slider-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, et.</p>
				</div>
			</div><!--end video-slider--> 
		</div>
		<div class="tabs_content" data-id="3">
			
			<!-- DOCUMENTS SLIDER -->
			<div class="documents-slider slick-media-slider">
				<div class="documents-slide">
					<img src="<?php echo get_stylesheet_directory_uri()?>/img/zaporuka1.jpg">
				</div>
				<div class="documents-slide">
					<img src="<?php echo get_stylesheet_directory_uri()?>/img/zaporuka2.jpg">
				</div>
				<div class="documents-slide">
					<img src="<?php echo get_stylesheet_directory_uri()?>/img/zaporuka1.jpg">
				</div>
				<div class="documents-slide">
					<img src="<?php echo get_stylesheet_directory_uri()?>/img/zaporuka2.jpg">
				</div>
			</div><!--end documents-slider--> 
		</div>
	</div>
</div><!-- end sliders-tabs -->


<!-- OUR REVARDS SLIDER(vertical mobile) -->
<div class="rewards-slider" >
	<div class="rewards-slide">
		1 Переможець конкурсу «Благодійник року» у номінації «Благодійна організація»
	</div>
	<div class="rewards-slide">
		2 Лауреат Національної медичної премії в номінації «Особливий внесок в охорону здоров’я».
	</div>
	<div class="rewards-slide">
		3 Лідер Національного рейтингу Благодійників у номінації «Витрати у сфері охорони здоров’я».
	</div>
	<div class="rewards-slide">
		4 Лідер Національного рейтингу Благодійників у номінації «Витрати у сфері охорони здоров’я».
	</div>
	<div class="rewards-slide">
		5 Лідер Національного рейтингу Благодійників у номінації «Витрати у сфері охорони здоров’я».
	</div>
	<div class="rewards-slide">
		6 Лауреат Національної медичної премії в номінації «Особливий внесок в охорону здоров’я».
	</div>
	<div class="rewards-slide">
		7 Лауреат Національної медичної премії в номінації «Особливий внесок в охорону здоров’я».
	</div>
	<div class="rewards-slide">
		8 Переможець конкурсу «Благодійник року» у номінації «Благодійна організація».
	</div>
	<div class="rewards-slide">
		9 Переможець конкурсу «Благодійник року» у номінації «Благодійна організація».
	</div>
</div><!--end rewards-slider-->
</div>

<?php

get_footer();

