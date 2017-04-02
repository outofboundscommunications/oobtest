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
	<section class="section blog-detail page-section-ptb gray-bg3 single-blog-details">
    	<div class="container">
      		<div class="row">
        		<div class="col-sm-12 col-md-12">
					<?php while ( have_posts() ) : the_post(); ?>
                        <?php $cid=get_the_ID(); ?>
						<?php get_template_part( 'content-single', get_post_format() ); ?>
				        <?php //comments_template( '', true ); ?>

    			     <?php endwhile; // end of the loop. ?>
    			</div>
            
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>