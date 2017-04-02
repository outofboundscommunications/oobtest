<?php
/**
 * The default template for displaying searchcontent
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post image wow fadeInUp'); ?>  data-wow-duration="1s">
		<!--div class="meta-date">
              <ul>
                <li class="date-month">
                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                    <span class="date"><?php the_time('d'); ?></span>
                    <span class="month"><?php the_time('M') ?></span>
                  </a>
                </li>
                <?php //comments_popup_link(); ?>
                <?php if ( comments_open() ) : ?>
                <li class="chat">
                	<a href="<?php the_permalink(); ?>#comments"><?php comments_number('0', '1', '%'); ?></a>
                </li>
                <?php endif; // comments_open() ?>
              </ul>
            </div-->
            
            <div class="post-thumbnail">
            <?php 
         		if( has_post_thumbnail($post_id) ){
        		// Featured Image
        		$case_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'our_thinking_section_thumbnail' );
        		$case_img_url    = $case_img_data['0'];
        		$case_img_width  = $case_img_data['1'];
        		$case_img_height = $case_img_data['2'];
       			}else{
        			$case_img_url = get_stylesheet_directory_uri().'/images/defaults/blog_thumb.png';
       			}
				
	   		?>
            <a href="<?php the_permalink(); ?>" rel="bookmark">
            <img height="255" width="255" src="<?php echo $case_img_url; ?>" class="img-responsive"/>
            </a>

       		</div>
        	
			<div class="post-content">
				<?php if ( is_single() ) : ?>
					<h3 class="widget-title"><?php the_title(); ?></h3>
				<?php else : ?>
					<h3 class="widget-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h3>
				<?php endif; // is_single() ?>
                <!--div class="social-plugin">
                	<div class="sharethis-wrapper">
						<span class='st_facebook_hcount' displayText='Facebook'></span>
						<span class='st_twitter_hcount' displayText='Tweet'></span>
						<span class='st_sharethis_hcount' displayText='ShareThis'></span>
						<span class='st_email_hcount' displayText='Email'></span>
						<span class='st_fblike_hcount' displayText='Facebook Like'></span>
					</div>
                </div-->
				<?php /*if ( comments_open() ) : ?>
					<div class="comments-link">
						<?php //comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?>
					</div><!-- .comments-link -->
				<?php endif; */ // comments_open() ?>
                <?php /*
                <footer class="entry-meta">
        	<ul>
                  <li>Posted <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></li>
                  <!--<li><a href="#"><i class="fa fa-tag" aria-hidden="true"></i>Design Template</a></li>-->
                  <li><i class="fa fa-tag" aria-hidden="true"></i><?php echo get_the_category_list(); ?></li>
           </ul> 
			<?php //twentytwelve_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php
						$author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
        */ ?>
        		<?php /*if ( is_search() || is_home() || is_author() || is_category() || is_archive()) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
            <a class="btn btn-primary" style="" href="<?php echo get_permalink(get_the_ID()); ?>">Read More</a>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; */ ?>
       </div>		
	</article><!-- #post -->
