<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div class="page-content">
  		<section class="section blog page-section-ptb gray-bg3">
    		<div class="container">
      			<div class="row">
        			<div class="col-sm-7 col-md-8">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h3 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
			</header>

			<?php //twentytwelve_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<div class="pagination">
     			<?php
                	if(function_exists('wp_pagenavi')) {
      					wp_pagenavi();
     				}
     			?>
			</div>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

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