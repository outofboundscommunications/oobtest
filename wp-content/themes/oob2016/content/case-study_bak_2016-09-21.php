<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		$post_id = get_the_ID();
		
		/*if( has_post_thumbnail(get_the_ID()) ){
			// Featured Image
			$case_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			$case_img_url    = $case_img_data['0'];
			$case_img_width  = $case_img_data['1'];
			$case_img_height = $case_img_data['2'];
			?>
			<div class="entry-thumb">
				<img src="<?php echo $case_img_url;?>" alt="image" width="<?php echo $case_img_width;?>" height="<?php echo $case_img_height;?>" class="img-responsive wow fadeInUp" data-wow-duration="1s"/>
			</div>
			<?php
		}*/
		?>
        <script>
		jQuery(document).ready(function($) {
			jQuery('.owl-carousel-case').owlCarousel({
				loop:true,
				items:1,
				margin:10,
				navigation : true,	
				autoHeight:true,
				pagination: false,
				singleItem:true,
				responsiveClass:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
		});   
        </script>
		<div class="entry-meta">
			<div class="row">
				<div class="col-md-9">
					<div class="case-categories-wrapper">
						<?php
						$categories_list = get_the_category_list( __( ' <span class="cat_sep"></span> ', 'twentytwelve' ) );
						echo get_the_term_list( $post->ID, 'case-study-category', '<ul class="case-categories wow fadeInUp" data-wow-duration="1s"><li class="case-category">', '</li><li>', '</li></ul class="case-category">' );
						?>
                        <div class="case-date wow fadeInUp" data-wow-duration="1s">
						<?php
						echo sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() )
						);
						?>
					</div>
					</div>
				</div>				
			</div>
            <div class="case-social-wrapper wow fadeInRight" data-wow-duration="1s">
				<div class="social-plugin">
                	<div class="sharethis-wrapper">
						<span class='st_facebook_hcount' displayText='Facebook'></span>
						<span class='st_twitter_hcount' displayText='Tweet'></span>
						<span class='st_sharethis_hcount' displayText='ShareThis'></span>
						<span class='st_email_hcount' displayText='Email'></span>
						<span class='st_fblike_hcount' displayText='Facebook Like'></span>
					</div>
                </div>
			</div>
		</div>
	</header><!-- .entry-header -->
	
	<div class="entry-content case-studies-details text-center">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->