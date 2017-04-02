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
		<?php // get_search_form(TRUE); ?>
        <?php echo do_shortcode( '[wpbsearch]' ); ?>
    	
         
         <!--div class="meta-date">
              <ul>
                <li class="date-month">
                  <a href="<?php echo get_permalink(get_the_ID()); ?>">
                    <span class="date"><?php the_time('d'); ?></span>
                    <span class="month"><?php the_time('M') ?></span>
                  </a>
                </li>                
              </ul>
            </div-->
			<div class="entry-summary-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
			</div>
            <div class="post-content">
            <div class="post-thumbnail">				
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
            <?php /*if(has_post_thumbnail($post_id)): ?>
                <?php $attr = array( 'class' => "img-responsive" );?>
            		<?php echo  the_post_thumbnail('full', $attr);?>
            	<?php else: ?>
            		<img src="<?php echo get_stylesheet_directory_uri();?>/images/blog-details-img.jpg" class="img-responsive"/>
            	<?php endif; */?>
            </div>
            <div class="author_set">
                <ul>
                  <li>Posted <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></li>
                 </ul>
             </div> 
            	<p class="widget-title"><?php the_title(); ?></p>
                <footer class="entry-meta">
                <ul>
                  <!--<li>Posted <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></li>-->
                  <li><i class="fa fa-tag" aria-hidden="true"></i><?php echo get_the_category_list(); ?></li>
                  <?php if ( comments_open() ) : ?>
                  <li>
                  	<i aria-hidden="true" class="fa fa-comments"></i>
                  	<a href="<?php the_permalink(); ?>#comments"><?php comments_number('0', '1', '%'); ?></a>
                  </li>
                  <?php endif; // comments_open() ?>
                </ul> 
              </footer> 
     			<div class="social-plugin">
                	<div class="sharethis-wrapper">
						<span class='st_facebook_hcount' displayText='Facebook'></span>
						<span class='st_twitter_hcount' displayText='Tweet'></span>
						<span class='st_sharethis_hcount' displayText='ShareThis'></span>
						<span class='st_email_hcount' displayText='Email'></span>
						<span class='st_fblike_hcount' displayText='Facebook Like'></span>
					</div>
                </div>
             
                           
            </div>
	</article><!-- #post -->
	<!--related posts -->
	<div class="relatedposts">
		<h3>Related posts</h3>
		<div class="row">
		<?php
		  $orig_post = $post;
		  global $post;
		  $tags = wp_get_post_tags($post->ID);
		   
		  if ($tags) {
		  $tag_ids = array();
		  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		  $args=array(
		  'tag__in' => $tag_ids,
		  'post__not_in' => array($post->ID),
		  'posts_per_page'=>2, // Number of related posts to display.
		  'caller_get_posts'=>1
		  );
		   
		  $my_query = new wp_query( $args );
		 
		  while( $my_query->have_posts() ) {
		  $my_query->the_post();
		  $post_id=$my_query->ID;
		  ?>
		   <div class="col-sm-6 col-md-6">
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
				<img height="255" width="255" src="<?php echo $case_img_url; ?>" class="img-responsive"/>

				</div>
				<h3 class="widget-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
                <div class="entry-meta"><ul>  <li><i class="fa fa-tag" aria-hidden="true"></i><?php echo get_the_category_list( '', '', $post_id );; ?></li> </ul></div>
		   </div>
		  <? }
		  }
		  $post = $orig_post;
		  wp_reset_query();
		  ?>
		  </div>
	</div>
	<!--related categories -->
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