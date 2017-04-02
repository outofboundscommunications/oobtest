<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	
	<div class="container">
		<div class="row">
		
			<div class="col-sm-<?php echo (is_active_sidebar( 'page-sidebar' ) ? 9 : 12 );?>">
				
				<div id="primary" class="site-content">
					<div id="content" role="main">

						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content/page' ); ?>
							<?php comments_template( '', true ); ?>
						<?php endwhile; // end of the loop. ?>

					</div><!-- #content -->
				</div><!-- #primary -->
				
			</div>
			
			<?php
			if( is_active_sidebar( 'page-sidebar' ) ){
				?>
				<div class="col-sm-3">
					<?php get_sidebar('page');?>
				</div>
				<?php
			}
			?>
		</div>
	</div>

<?php get_footer(); ?>