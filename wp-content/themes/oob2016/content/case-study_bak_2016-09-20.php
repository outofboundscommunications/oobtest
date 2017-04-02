<?php if(is_plugin_active('social-share-button/social-share-button.php')):?>

<?php endif;?>

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

				<div class="col-sm-9">

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

						<?php
						$permalink = get_permalink();
						$case_socials = array(

							'facebook'   => array(

								'title'=> 'Facebook',
								'class' => 'fb',
								'href' => 'https://www.facebook.com/sharer/sharer.php?u='.ssb_share_get_url(),
								'icon' => '<i class="fa fa-facebook"></i>'

							),

							'twitter'    => array(

								'title'=> 'Twitter',
								'class' => 'twitter',
								'href' => 'https://twitter.com/intent/tweet?url='.ssb_share_get_url().'&text='.ssb_share_get_title(),
								'icon' => '<i class="fa fa-twitter"></i>'

							),

							'linkedin'   => array(

								'title'=> 'Linkedin',
								'class' => 'linkedin',
								'href' => 'https://www.linkedin.com/shareArticle?mini=true&url='.ssb_share_get_url(),
								'icon' => '<i class="fa fa-linkedin"></i>'

							),

							'google_plus'=> array(

								'title'=> 'Google Plus',
								'class' => 'gplus',
								'href' => 'https://plus.google.com/share?url='.ssb_share_get_url(),
								'icon' => '<i class="fa fa-google-plus"></i>'

							),

							/*'pdf'        => array(

								'title'=> 'PDF',

								'icon' => '<i class="fa fa-file-pdf-o"></i>'

							),

							'email'      => array(

								'title'=> 'Email',

								'icon' => '<i class="fa fa-envelope"></i>'

							),*/

						);

						$social_links = '';

						foreach( $case_socials as $case_social_k => $case_social_d ){

							$$case_social_k = get_field($case_social_k);

							/*if( $$case_social_k ){

								if( $case_social_k == 'email' ){

									$social_links .= '<li class="case-link case-link-'.$case_social_k.'"><a target="_blank" href="mailto:'.$$case_social_k.'" title="'.$case_social_d['title'].'">'.$case_social_d['icon'].'</a>';

								}else{
									
									$social_links .= '<li class="case-link case-link-'.$case_social_k.'"><a target="_blank" href="'.$case_social_d['href'].'" class="'.$case_social_d['class'].'" title="'.$case_social_d['title'].'">'.$case_social_d['icon'].'</a>';
									//$social_links .= '<li class="case-link case-link-'.$case_social_k.'"><a href="'.$$case_social_k.'" class="'.$case_social_d['class'].'" title="'.$case_social_d['title'].'">'.$case_social_d['icon'].'</a>';

								}
							}*/
							
							if( $case_social_k != 'email' && $case_social_k != 'pdf'){
									
									$social_links .= '<li class="case-link case-link-'.$case_social_k.'"><a target="_blank" href="'.$case_social_d['href'].'" class="'.$case_social_d['class'].'" title="'.$case_social_d['title'].'">'.$case_social_d['icon'].'</a>';

							}
							if( $$case_social_k){
								if( $case_social_k == 'email' || $case_social_k == 'pdf'){
										if( $case_social_k == 'email' ){
	
										$social_links .= '<li class="case-link case-link-'.$case_social_k.'"><a target="_blank" href="mailto:'.$$case_social_k.'" title="'.$case_social_d['title'].'">'.$case_social_d['icon'].'</a>';
	
										}else{
										
										//$social_links .= '<li class="case-link case-link-'.$case_social_k.'"><a target="_blank" href="'.$case_social_d['href'].'" class="'.$case_social_d['class'].'" title="'.$case_social_d['title'].'">'.$case_social_d['icon'].'</a>';
										$social_links .= '<li class="case-link case-link-'.$case_social_k.'"><a href="'.$$case_social_k.'" class="'.$case_social_d['class'].'" title="'.$case_social_d['title'].'">'.$case_social_d['icon'].'</a>';
	
									}
								}
							}
						}
						
						echo '<ul class="case-links">'.$social_links.'</ul>';
						if( !empty($social_links)){
							
							//echo '<ul class="case-links">'.$social_links.'</ul>';
						}

						?>

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