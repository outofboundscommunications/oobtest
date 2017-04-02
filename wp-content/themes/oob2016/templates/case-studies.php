<?php
/**
 * Template Name: Case Studies
 */

get_header(); ?>
	
	<div class="container">
		<div class="row">		
			<div class="col-sm-12">	
				<div id="primary" class="site-content">
					<div id="content" role="main">					
						
						<?php while ( have_posts() ) : the_post(); ?>
							
							<?php get_template_part( 'content/case-studies' ); ?>
							
						<?php endwhile; // end of the loop. ?>

					</div><!-- #content -->
				</div><!-- #primary -->				
			</div>
		</div>
	</div>

<?php get_footer(); ?>