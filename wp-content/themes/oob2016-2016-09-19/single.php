<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="page-content">
	<section class="section blog-detail page-section-ptb gray-bg3">
    	<div class="container">
      		<div class="row">
        		<div class="col-sm-7 col-md-8">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content-single', get_post_format() ); ?>

<!--				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav>--><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>
			</div>
            
            <div class="col-sm-5 col-md-4">
          		<div class="sidebar">
					<?php get_sidebar(); ?>
                    </div>
                    </div>
             </div>
             </div>
             </section>
</div>
<?php get_footer(); ?>