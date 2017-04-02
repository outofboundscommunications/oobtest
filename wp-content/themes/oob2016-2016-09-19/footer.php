<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */ 
$social_profiles = get_field('social_profiles','option');
$copyright       = get_field('copyright','option');
$address         = get_field('address','option');
$phone_number    = get_field('phone_number','option');
$email           = get_field('email','option');
$map             = get_field('map','option');
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="footer-contact">
			
			<?php if( !empty($social_profiles) ):?>
			<!-- Footer Social Info -->
			<div class="footer-getintouch-wrapper social-info text-center">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							
							<div class="footer-social-info">
								<h2 class="wow fadeInUp" data-wow-duration="1s"><?php _e('Get in Touch');?></h2>
								<ul class="social-icon">
									<?php $wow_duration=1; foreach($social_profiles as $social):?>
									<li class="wow fadeInUp" data-wow-duration="<?php echo $wow_duration;?>s"><a href="<?php echo $social['url']?>" title="<?php echo $social['title']?>"><?php echo $social['icon']->element;?></a></li>
									<?php $wow_duration=$wow_duration+0.2; 
									endforeach;?>
								</ul>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<!-- Footer Map -->
			<?php if( !empty($map) ):?>
			<div class="footer-map-wrapper">
				<div class="footer-contact-map wow fadeIn" data-wow-duration="1s">					
					<div class="acf-map" style="height:400px;">
						<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
					</div>					
				</div>
			</div>
			<?php endif; ?>
			
			<!-- Footer Address -->
			<div class="footer-address-wrapper text-center">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">							
							<div class="footer-address">
								<ul class="address city-address wow fadeInUp" data-wow-duration="1s"><li><?php echo $address;?></li></ul>
								<ul class="email-address wow fadeInUp" data-wow-duration="1s">
									<?php
									if( $phone_number ){?>
										<li><span><a href="tel:<?php echo $phone_number;?>" title="<?php echo $phone_number;?>"><?php echo $phone_number;?></a></span></li>
										<?php
									}
									if( $email ){?>
										<li><span><a href="mailto:<?php echo $email;?>" title="<?php echo $email;?>;"><?php echo $email;?></a></span></li>
									<?php }	?>
								</ul>
							</div>							
						</div>
					</div>
				</div>
			</div>			
			<!--News Leter Subscriber Form -->
			<div class="footer-newslatter-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">							
							<div class="footer-newslatter-subscriber text-center">
								<h2 class="wow fadeInUp" data-wow-duration="1s"><?php _e('Subscribe to our Newsletter');?></h2>
								<div class="subscriber-fron">
									<form class="news_latter_form" id="footer-newsletter">
										<div class="form-group input-group-x divcenter">									
											<input type="email" class="form-control news_letter_email wow fadeInLeft" name="name" placeholder="Enter your Email" data-wow-duration="1s"/>
											<span class="form-group-btn input-group-btn-x wow fadeInRight" data-wow-duration="1s">
												<button class="btn btn-primary btn-icon news_latter_mailchimp" type="submit" data-form-id="footer-newsletter"><?php _e('Subscribe');?></button> 
											</span>
										</div>
										<p class="newslatter_msg" style="display:none;"></p>
									</form>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>			
		</div>		
		<div class="site-info">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">						
						<div class="footer-copyright-info text-center wow fadeInUp" data-wow-duration="1s">
							<?php if($copyright):?>
								<p class="copyright-text"><?php echo $copyright?></p>
							<?php endif;?>
							<div class="menu-footer-navigation-container">
								<?php
								wp_nav_menu( array(
									'theme_location'=> 'footer',
									'menu_id'       => 'menu-footer-navigation',
									'menu_class'    => 'footer-nav footer-navbar-nav',
									'container'     => false,
								) );
								wp_nav_menu( array(
									'theme_location'=> 'footer-social',
									'menu_class'    => 'footer-nav footer-social',
									'container'     => false,
								) );
								?>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div><!-- .site-info -->		
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer();
if( is_home() || is_author() || is_category() || is_tag() || is_tax() || is_archive() || is_date() || is_day() || is_month() || is_year() || is_single() ){
$sharethis_publisher_id = get_field('sharethis_publisher_id', 'option');
if( empty($sharethis_publisher_id) ){
	$sharethis_publisher_id = 'c0c2b36a-5428-48b4-825a-658d5d76a8b4';
}
?>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "<?php echo $sharethis_publisher_id;?>", doNotHash: false, doNotCopy: false, hashAddressBar: false, onhover: false});</script>
<?php }?>
<style>.stArrow{display: none !important;}</style>
</body>
</html>