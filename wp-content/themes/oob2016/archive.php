<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
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
</div>    

		<?php if ( have_posts() ) : ?>
			<!--<header class="archive-header">
				<h3 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
					else :
						_e( 'Archives', 'twentytwelve' );
					endif;
				?></h3>
			</header>--><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
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
            <?php
			?>

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
