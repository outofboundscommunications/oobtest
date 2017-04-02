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
	'posts_per_page'     => 3,
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
		$i=0;
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			if($i==0){
				$fade_class='fadeInLeft';
			}elseif($i==1){
				$fade_class='fadeInUp';
			}else{
				$fade_class='fadeInRight';
			}
			$i++;
			?>
			<div class="col-md-4 wow <?php echo $fade_class?>" data-wow-duration="1s">
				<div class="our-thinking-item think-blog">
					<div class="our-thinking-icon">
						<img src="<?php echo get_stylesheet_directory_uri();?>/images/search-marketing-icon.png" width="121" height="125">
					</div>
					<h4 class="our-thinking-title inner-section-sub-title match-height">
						<?php echo get_the_title();?>
					</h4>
					<div class="our-thinking-content match-height">
						<?php
						$case_excerpt = get_the_excerpt();
						$case_excerpt = get_excerpt_max_charlength(130, $case_excerpt);
						echo '<p>'.$case_excerpt.'</p>';
						?>
					</div>
					<div class="our-thinking-link">
						<a class="btn btn-primary" href="<?php echo get_permalink();?>">Read More</a>
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