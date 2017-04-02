<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post image wow fadeInUp'); ?>  data-wow-duration="1s">
    	<div class="post-thumbnail">
            <?php if(has_post_thumbnail($post_id)): ?>
                <?php $attr = array( 'class' => "img-responsive" );?>
            		<?php echo  the_post_thumbnail('full', $attr);?>
            	<?php //else: ?>
            		<!--img src="<?php echo get_stylesheet_directory_uri();?>/images/blog-details-img.jpg" class="img-responsive"-->
            	<?php endif; ?>
         </div>
         
         <div class="meta-date">
              <ul>
                <li class="date-month">
                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                    <span class="date"><?php the_time('d'); ?></span>
                    <span class="month"><?php the_time('M') ?></span>
                  </a>
                </li>                
              </ul>
            </div>
            
            <div class="post-content">
            	<h3 class="widget-title"><?php the_title(); ?></h3>
     			<div class="social-plugin">
                	<div class="sharethis-wrapper">
						<span class='st_facebook_hcount' displayText='Facebook'></span>
						<span class='st_twitter_hcount' displayText='Tweet'></span>
						<span class='st_sharethis_hcount' displayText='ShareThis'></span>
						<span class='st_email_hcount' displayText='Email'></span>
						<span class='st_fblike_hcount' displayText='Facebook Like'></span>
					</div>
                </div>
             
              <footer class="entry-meta">
                <ul>
                  <li>Posted <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></li>
                  <li><i class="fa fa-tag" aria-hidden="true"></i><?php echo get_the_category_list(); ?></li>
                  <?php if ( comments_open() ) : ?>
                  <li>
                  	<i aria-hidden="true" class="fa fa-comments"></i>
                  	<a href="<?php the_permalink(); ?>#comments"><?php comments_number('0', '1', '%'); ?></a>
                  </li>
                  <?php endif; // comments_open() ?>
                </ul> 
              </footer>              
            </div>
            <div class="entry-summary">
            	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
            </div>
	</article><!-- #post -->
