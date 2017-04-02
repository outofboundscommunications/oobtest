<?php
global $section_id;
$title               = get_sub_field('title');
$testimonials_source = get_sub_field('testimonials_source');
$tesimonial_category = get_sub_field('tesimonial_category');
$count               = get_sub_field('count');
if( empty($count) ){
	$count = 5;
}
$carousel_items_id = "{$section_id}_items";
$carousel_navbar_id = "{$section_id}_navbar";
?>
<div class="container">
	<?php
	if( $title ){
		?>
		<div class="row">
			<div class="col-md-offset-2 col-md-10 text-center wow fadeInUp" data-wow-duration="1s">
				<h2><?php echo $title;?></h2>
			</div>
		</div>
		<?php
	}
	$test_args = array(
		'post_type'          => 'testimonial',
		'posts_per_page'     => $count,
		'ignore_sticky_posts'=> true,
	);
	if( $testimonials_source == 'random' ){
		$test_args['orderby'] = 'rand';
	}elseif( $testimonials_source == 'category' && $tesimonial_category ){
		$test_args['tax_query'] = array(
			array(
				'taxonomy' => 'testimonial-category',
				'field'    => 'term_id',
				'terms'    => $tesimonial_category->term_id,
			),
		);
	}
	$the_query = new WP_Query( $test_args );
	if ( $the_query->have_posts() ) {
		?>
		<div class="row">
			<div id="test_slider_<?php echo $section_id;?>" class="test_slider_item_nav_wrapper">
				<div class="test_slider_item_wrapper">
					<div id="<?php echo $carousel_items_id;?>" class="owl-carousel">
						<?php
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							
							$author = get_field('author');
							$company = get_field('company');
							?>
							<div class="item">
								<div class="col-md-offset-2 col-md-10">
									<div class="user-details">
                                    
                                    <?php 
         								if( has_post_thumbnail($post_id) ){
        								// Featured Image
        								$case_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'our_thinking_section_thumbnail' );
        								$case_img_url    = $case_img_data['0'];
        								$case_img_width  = $case_img_data['1'];
        								$case_img_height = $case_img_data['2'];
       									}else{
        									$case_img_url = get_stylesheet_directory_uri().'/images/testimonials-img.png';
       									}
	   								?>
            						<img src="<?php echo $case_img_url; ?>" class="img-responsive <?php if(has_post_thumbnail($post_id) ){ echo 'img-circle'; }?>  user-img fadeInRight wow" width="329" height="328" data-wow-duration="1s">
									<!--<img src="<?php echo get_stylesheet_directory_uri();?>/images/testimonials-img.png" class="img-responsive user-img fadeInRight wow" width="329" height="328" data-wow-duration="1s">-->
										<div class="testimonials-content fadeInLeft wow" data-wow-duration="1s">
											<?php the_content();?>
											<div class="test_meta">
												<span class="test_author">- <?php echo $author;?></span>
												<span class="test_company oob_red"><?php echo $company;?></span>
											</div>
										</div>										
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="test_slider_navs_wrapper col-sm-12">
					<div class="carousel_navbar">
						<div id="<?php echo $carousel_navbar_id;?>" class="owl-carousel text-center wow fadeInUp" data-wow-duration="1s">
						<?php
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							
							$author = get_field('author');
							$company = get_field('company');
							?>
							<div class="item">
								<div class="test_meta">
									<span class="test_author"><?php echo $author;?></span>
									<span class="test_company oob_red"><?php echo $company;?></span>
								</div>
							</div>
							<?php
						}
						?>
						</div>
					</div>
					<div class="carousel_navtns">
						<a class="<?php echo $section_id;?>_carousel_left"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
						<a class="<?php echo $section_id;?>_carousel_right"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var <?php echo $carousel_items_id;?> = $("#<?php echo $carousel_items_id;?>");
	var <?php echo $carousel_navbar_id;?> = $("#<?php echo $carousel_navbar_id;?>");
	
	<?php echo $carousel_items_id;?>.owlCarousel({
		items: 1,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [980,1],
		itemsTablet: [768,1],
		itemsMobile : [767,1],		
		slideSpeed: 1000,
		pagination: false,
		navigation: false,
		afterAction: syncPosition,
		responsiveRefreshRate: 200,
		<?php echo ( wpmd_is_phone() ) ? 'autoHeight : true,': '';?>
		rewindNav: false,
		lazyLoad: true
	});
	<?php echo $carousel_navbar_id;?>.owlCarousel({
		items: 3,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [980,3],
		itemsTablet: [768,1],
		itemsMobile : [767,1],
		navigation: false,
		pagination: false,
		rewindNav: false,
		slideSpeed: 1000,
		responsiveRefreshRate: 100,
		afterInit: function (el) {
			el.find(".owl-item").eq(0).addClass("synced");
		}
	});
	
	/*get carousel instance data and store it in variable owl*/
	var <?php echo $carousel_items_id;?>_data = <?php echo $carousel_items_id;?>.data('owlCarousel');
	var <?php echo $carousel_navbar_id;?>_data = <?php echo $carousel_navbar_id;?>.data('owlCarousel');
	function syncPosition(el) {
		var current = this.currentItem;
		jQuery("#<?php echo $carousel_navbar_id;?>")
			.find(".owl-item")
			.removeClass("synced")
			.eq(current)
			.addClass("synced");
			
		if (jQuery("#<?php echo $carousel_navbar_id;?>").data("owlCarousel") !== undefined) {
			center(current);
		}
	}
	
	jQuery("#<?php echo $carousel_navbar_id;?>").on("click", ".owl-item", function (e) {
		e.preventDefault();
		var number = jQuery(this).data("owlItem");
		<?php echo $carousel_items_id;?>.trigger("owl.goTo", number);
	});
	function center(number) {
		var <?php echo $carousel_navbar_id;?>visible = <?php echo $carousel_navbar_id;?>.data().owlCarousel.owl.visibleItems;
		var num = number;
		var found = false;
		for (var i in <?php echo $carousel_navbar_id;?>visible) {
			if (num === <?php echo $carousel_navbar_id;?>visible[i]) {
				var found = true;
			}
		}
		
		if (found === false) {
			if (num > <?php echo $carousel_navbar_id;?>visible[<?php echo $carousel_navbar_id;?>visible.length - 1]) {
				<?php echo $carousel_navbar_id;?>.trigger("owl.goTo", num - <?php echo $carousel_navbar_id;?>visible.length + 2);
			} else {
				if (num - 1 === -1) {
					num = 0;
				}
				<?php echo $carousel_navbar_id;?>.trigger("owl.goTo", num);
			}
		} else if (num === <?php echo $carousel_navbar_id;?>visible[<?php echo $carousel_navbar_id;?>visible.length - 1]) {
			<?php echo $carousel_navbar_id;?>.trigger("owl.goTo", <?php echo $carousel_navbar_id;?>visible[1]);
		} else if (num === <?php echo $carousel_navbar_id;?>visible[0]) {
			<?php echo $carousel_navbar_id;?>.trigger("owl.goTo", num - 1);
		}
	}
	
	/*Custom Navigation Events*/
	$(".<?php echo $section_id;?>_carousel_left").click(function(){
		<?php echo $carousel_items_id;?>_data.prev();
	});
	$(".<?php echo $section_id;?>_carousel_right").click(function(){
		<?php echo $carousel_items_id;?>_data.next();
	});
});
</script>