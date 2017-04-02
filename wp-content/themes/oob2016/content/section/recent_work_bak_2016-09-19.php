<?php

global $section_id;



$title    = get_sub_field('title');

$source   = get_sub_field('source');

$count    = get_sub_field('count');

$category = get_sub_field('category');



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

			<div class="col-sm-12 text-center">

				<h2 class="inner-section-title wow fadeInUp" data-wow-duration="1s"><?php echo $title;?></h2>

			</div>

		</div>

		<?php

	}

	$case_args = array(

		'post_type'          => 'case-study',

		'posts_per_page'     => $count,

		'ignore_sticky_posts'=> true,

	);

	if( $source == 'random' ){

		$case_args['orderby'] = 'rand';

	}elseif( $source == 'category' && $category ){

		$case_args['tax_query'] = array(

			array(

				'taxonomy' => 'case-study-category',

				'field'    => 'term_id',

				'terms'    => $category->term_id,

			),

		);

	}

	$the_query = new WP_Query( $case_args );

	if ( $the_query->have_posts() ) {

		?>

		<div class="row">

			<div id="test_slider_<?php echo $section_id;?>" class="test_slider_item_nav_wrapper" >

				<div class="test_slider_item_wrapper">

					<div id="<?php echo $carousel_items_id;?>" class="owl-carousel">

						<?php

						$number=0;

						while ( $the_query->have_posts() ) {

							$the_query->the_post();

							$post_id = get_the_ID();

							

							if( has_post_thumbnail($post_id) ){

								// Featured Image

								$case_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'our_thinking_section_thumbnail' );

								$case_img_url    = $case_img_data['0'];

								$case_img_width  = $case_img_data['1'];

								$case_img_height = $case_img_data['2'];

							}else{

								$case_img_url = get_stylesheet_directory_uri().'/images/defaults/otb.png';

								$case_img_width  = '372';

								$case_img_height = '372';

							}							

							

							if ($number % 2 == 0) {

								$class="fadeInLeft";

							}else{

								$class="fadeInRight";

							}

							?>

							<div class="item wow <?php echo $class;?>" data-wow-duration="1s">

								<div class="text-center">

									<div class="rounded-blog recent-blog">

										<img class="case-thumb img-responsive" src="<?php echo $case_img_url;?>" width="<?php echo $case_img_width;?>" height="<?php echo $case_img_height;?>">

										<h3 class="case_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                        
                                        <div class="case_study_desc">

										<?php
        
                                            $case_excerpt = get_the_excerpt();
        
                                            $case_excerpt = get_excerpt_max_charlength(150, $case_excerpt);
        
                                            echo '<p>'.$case_excerpt.'</p>';
        
                                            ?>
        
                                    	</div>


									</div> 

								</div>

							</div>

							<?php

							$number++;

						}

						?>

					</div>

				</div>

				<div class="test_slider_navs_wrapper col-sm-12 wow fadeInUp" data-wow-duration="1s">

					<div class="carousel_navbar">

						<div id="<?php echo $carousel_navbar_id;?>" class="owl-carousel text-center">

						<?php

						while ( $the_query->have_posts() ) {

							$the_query->the_post();

							?>
                            
							<div class="item">

								<div class="test_meta">

									<span class="case_btn_txt">See More Clearly</span>

									<span class="case_title oob_red"><a href="<?php the_permalink();?>"><?php echo get_the_title();?></a></span>

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

		items: 2,

		itemsDesktop : [1199,2],

		itemsDesktopSmall : [980,2],

		itemsMobile : [767,1],

		slideSpeed: 1000,

		pagination: false,

		navigation: false,

		afterAction: syncPosition,

		responsiveRefreshRate: 200,

		rewindNav: false,

		lazyLoad: true

	});



	<?php echo $carousel_navbar_id;?>.owlCarousel({

		items: 2,

		itemsDesktop : [1199,2],

		itemsDesktopSmall : [980,2],

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

				<?php echo $carousel_navbar_id;?>.trigger("owl.goTo", num - <?php echo $carousel_navbar_id;?>visible.length + 1);

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