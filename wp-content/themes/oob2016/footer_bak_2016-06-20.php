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
 
$social_profiles =get_field('social_profiles','option');
$copyright =get_field('copyright','option');
$address =get_field('address','option');
$phone_number =get_field('phone_number','option');
$email =get_field('email','option');
$map =get_field('map','option');

$mailchimp_list_id =get_field('mailchimp_list_id','option');
$mailchimp_api_key =get_field('mailchimp_api_key','option');
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="footer-contact">
			
			<?php if( !empty($social_profiles) ):?>
			<!-- Footer Social Info -->
			<div class="footer-getintouch-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							
							<div class="footer-social-info">
								<h3><?php _e('Get in Touch');?></h3>
								<ul class="social-icon">
									<?php foreach($social_profiles as $social):?>
									<li><a href="<?php echo $social['url']?>" title="<?php echo $social['title']?>"><?php echo $social['icon']->element;?></a></li>
									<?php endforeach;?>
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
				<div class="footer-contact-map">
					
					<div class="acf-map" style="height:400px;">
						<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
					</div>
					
				</div>
			</div>
			<?php endif; ?>
			
			<!-- Footer Address -->
			<div class="footer-address-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							
							<div class="footer-address">
								<p class="address"><?php echo $address;?></p>
								<p><span><a href="tel:<?php echo $phone_number;?>" title="<?php echo $phone_number?>"><?php echo $phone_number;?></a></span> <span><a href="mailto:<?php echo $email;?>" title="<?php echo $email?>;"><?php echo $email;?></a></span></p>
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
							
							<div class="footer-newslatter-subscriber">
								<h3><?php _e('Subscribe to our Newsletter');?></h3>
								<div class="subscriber-fron">
									<form class="news_latter_form" id="footer-newsletter">
										<input type="hidden" class="mailchimp_api_key" name="mailchimp_api_key" value="<?php echo $mailchimp_api_key; ?>" />
										<input type="hidden" class="mailchimp_id" name="mailchimp_id" value="<?php echo $mailchimp_list_id; ?>" />	
										<div class="input-group divcenter">									
											<input type="email" class="form-control news_letter_email" name="name" placeholder="Enter your Email">
											<span class="input-group-btn">
												<button class="btn btn-icon news_latter_mailchimp" type="submit" data-form-id="footer-newsletter"><?php _e('Subscribe');?></button> 
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
						
						<div class="footer-copyright-info">
							<?php if($copyright):?>
							<p class="copyright-text"><?php echo $copyright?></p>
							<?php endif;?>
							<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-nav footer-navbar-nav' ) ); ?>
						</div>
						
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>