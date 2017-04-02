<?php
$title   = get_sub_field('title');
$source  = get_sub_field('source');
$category= get_sub_field('category');
?>
<div class="container text-center">
	<div class="row">
		<div class="col-sm-12">
			<?php if($title): ?>
				<h2 class="inner-section-title wow fadeInUp" data-wow-duration="1s"><?php echo $title;?></h2>
			<?php endif;?>
		</div>
	</div>
<?php
$ota_args = array(
	'post_type'          => 'post',
	'posts_per_page'     => 2,
	'ignore_sticky_posts'=> true,
);
if( $source == 'random' ){
	$ota_args['orderby'] = 'rand';
}elseif( $source == 'category' && $category ){
	$ota_args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => $category->term_id,
		),
	);
}
$the_query = new WP_Query( $ota_args );
if ( $the_query->have_posts() ) {
	?>
	<div class="row">
		<?php
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$post_id = get_the_ID();
			
			if( has_post_thumbnail($post_id) ){
				// Featured Image
				$otb_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'our_thinking_section_thumbnail' );
				$otb_img_url    = $otb_img_data['0'];
				$otb_img_width  = $otb_img_data['1'];
				$otb_img_height = $otb_img_data['2'];
			}else{
				$otb_img_url = get_stylesheet_directory_uri().'/images/defaults/otb.png';
				$otb_img_width  = '372';
				$otb_img_height = '372';
			}
			?>
			<div class="col-md-6 col-xs-6 text-center">
				<div class="our-thinking-b-item rounded-blog">
					<div class="our-thinking-b-icon">
						<img src="<?php echo $otb_img_url;?>" width="<?php echo $otb_img_width;?>" height="<?php echo $otb_img_height;?>" data-wow-duration="1s" class="wow fadeInUp">
					</div>
					<h3 class="our-thinking-b-title wow fadeInUp" data-wow-duration="1s">
						<a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a>
					</h3>
					<div class="analytics-meta wow fadeInUp" data-wow-duration="1s">
						<?php
						$categories_list = get_the_category_list( __( ' <span class="cat_sep"></span> ', 'twentytwelve' ) );
						$date = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() )
						);
						?>
						<span class="analytics">
							<?php echo $categories_list;?>
						</span>
						<span class="analytics-date"><?php echo $date;?></span>
					</div>
					<div class="our-thinking-b-content wow fadeInUp" data-wow-duration="1s">
						<?php
						$case_excerpt = get_the_excerpt();
						$case_excerpt = get_excerpt_max_charlength(130, $case_excerpt);
						echo '<p>'.$case_excerpt.'</p>';
						?>
						<?php // the_excerpt();?>
					</div>
				</div> 
			</div>
			<?php
		}
		?>
	</div>
	<?php
}
/* Restore original Post Data */
wp_reset_postdata();
?>
</div>