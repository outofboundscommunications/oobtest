<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
            <!--<header class="archive-header">
            <h3 class="archive-title">Most Recent</h3>
            </header>-->
           
            </div>
		<?php if ( have_posts() ) : ?>
			<!--<header class="archive-header">
				<h3 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h3>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
			</header>--><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
                 ?>
				<div class="col-sm-6 col-md-6 blog">
                     
        				<?php get_template_part( 'searchcontent', get_post_format() ); ?>
                    </div>
            <?php
			endwhile;

			
			?>
            <div class="pagination">
     						<?php
                				if(function_exists('wp_pagenavi')) {
      								wp_pagenavi();
     							}
     						?>
			</div>


		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
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
