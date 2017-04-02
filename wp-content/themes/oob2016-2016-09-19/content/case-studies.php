<?php

/**

 * The template used for displaying page content in page.php

 *

 * @package WordPress

 * @subpackage Twenty_Twelve

 * @since Twenty Twelve 1.0

 */

?>



	<article id="post-<?php the_ID(); ?>" <?php post_class('page-section-ptb'); ?>>
    	


		<div class="entry-content">
        	<?php the_content(); ?>

			<?php

			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

			$case_args = array(

				'post_type'     => 'case-study',

				'posts_per_page'=> 4,

				'paged'         => $paged,

			);

			$the_query = new WP_Query( $case_args );

			if ( $the_query->have_posts() ) {

				?>

				<div class="row">

					<?php $number=0;

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

						}

						if ($number % 2 == 0) {

							$class="fadeInLeft";

						}else{

							$class="fadeInRight";

						}

						?>

						<div class="case-study-content-block col-sm-6 text-center wow <?php echo $class;?>" data-wow-duration="1s">



							<div class="rounded-blog">

								<div class="case_study_img">

									<img class="case-thumb img-responsive" src="<?php echo $case_img_url;?>">

								</div>

								<div class="case_study_title">

									<h3><?php the_title();?></h3>

								</div>

								<div class="case_study_desc">

									<?php

									$case_excerpt = get_the_excerpt();

									$case_excerpt = get_excerpt_max_charlength(150, $case_excerpt);

									echo '<p>'.$case_excerpt.'</p>';

									?>

								</div>

								<div class="case_study_link">

									<a href="<?php the_permalink();?>" class="btn btn-primary">Read More</a>

								</div>

							</div>

							

						</div>						

						<?php

						$number++;

					}

					?>

				</div>

				<div class="pagination">

					<?php

					if(function_exists('wp_pagenavi')) {

						wp_pagenavi( array( 'query' => $the_query ) );

					}

					?>

				</div>

				<?php

			}

			?>

		</div><!-- .entry-content -->

		<footer class="entry-meta">

			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>

		</footer><!-- .entry-meta -->

	</article><!-- #post -->