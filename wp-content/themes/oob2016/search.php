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
            <div class="col-sm-12 col-md-12">
<?php echo do_shortcode( '[wpbsearch]' ); ?>  
</div>
        		<?php if ( have_posts() ) : ?>
        
        			<?php //twentytwelve_content_nav( 'nav-above' ); ?>
        
        			<?php /* Start the Loop */ ?>
        			<?php while ( have_posts() ) : the_post(); ?>
                     <div class="col-sm-6 col-md-6 blog">
                     
        				<?php get_template_part( 'searchcontent', get_post_format() ); ?>
                    </div>
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
        				</div><!-- .entry-content -->
        			</article><!-- #post-0 -->
        
        		<?php endif; ?>
                </div>
            </div>
    </section>
</div>
<!--categories -->
<div class="allcategories">
		<div class="container">
			<div class="row">
                <div class="col-sm-12 col-md-12">
				<h2 class="custom_title">All Categories</h2>
				<?php wp_list_categories(array('title_li'=>'')); ?>
                </div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>