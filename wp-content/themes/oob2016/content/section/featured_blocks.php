<?php
$title   = get_sub_field('title');
// $featured_block  = get_sub_field('featured_block');
?>
<div class="container text-center">
	<?php
	if( $title ){
		?>
		<h2 class="inner-section-title wow fadeInUp" data-wow-duration="1s"><?php echo $title;?></h2>
		<?php
	}
	if( have_rows('featured_block') ){
		?>
		<div class="row">
			<?php $i=0;
			while( have_rows('featured_block') ){
				the_row();
				
				// vars
				$image       = get_sub_field('block_icon');
				if( $image ){
					$image_url   = $image['url'];
					$image_width = $image['width'];
					$image_height= $image['height'];
				}else{
					$image_url   = get_stylesheet_directory_uri().'/images/search-marketing-icon.png';
					$image_width = '121';
					$image_height= '125';
				}
				$block_title = get_sub_field('block_title');
				$content     = get_sub_field('block_description');
				$link        = get_sub_field('block_link');
				if($i==0){
					$fade_class='fadeInLeft';
				}elseif($i==1){
					$fade_class='fadeInUp';
				}else{
					$fade_class='fadeInRight';
				}
				$i++;
				
				if( $block_title && $content ){
					?>
					<div class="col-md-4 wow <?php echo $fade_class?>" data-wow-duration="1s">
						<div class="think-blog">
							<img src="<?php echo $image_url;?>" width="<?php echo $image_width;?>" height="<?php echo $image_height;?>" alt="<?php echo ( $block_title ? esc_attr($block_title) : '' );?>" />
							<?php
							if( $block_title ){
								?>
								<h4 class="inner-section-sub-title"><?php echo $block_title;?></h4>
								<?php
							}
							if( $content ){
								?>
								<?php echo $content; ?>
								<?php
							}
							if( $link ){
								?>
								<a class="btn btn-primary" href="<?php echo $link['url'];?>"><?php echo $link['text'];?></a>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
	?>
</div>