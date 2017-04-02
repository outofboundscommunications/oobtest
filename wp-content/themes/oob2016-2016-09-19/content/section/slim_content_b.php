<?php
$title      = get_sub_field('title');
$contents   = get_sub_field('contents');
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center">
			<?php
			if( $title ){
				?>
				<h2 class="inner-section-title" data-wow-duration="1s"><?php echo $title;?></h2>
				<?php
			}
			if( have_rows('contents') ){
				?>
				<div class="slim_content_b-content_wrapper">
					<?php
					while( have_rows('contents') ){
						the_row(); 

						// vars
						$content_type= get_sub_field('content_type');
						$subtitle    = get_sub_field('subtitle');
						$description = str_replace(array('<p>','</p>'),array('',''),get_sub_field('description'));
						$icon        = get_sub_field('icon');
						if( $content_type && $content_type == 'data' ){
							if( $subtitle || $description ){
								?>
								<div class="slim_content_b-content_data">
									<?php
									if( $subtitle ){
										?>
										<h4 class="inner-section-sub-title wow fadeInUp" data-wow-duration="1s"><?php echo $subtitle;?></h4>
										<?php
									}
									if( $description ){?>
										<p class=" wow fadeInUp" data-wow-duration="1s"><?php echo($description);?></p>
									<?php }	?>
								</div>
								<?php
							}
						}elseif( $content_type && $content_type == 'icon' && $icon ){
							?>
							<div class="slim_content_b-content_icon wow fadeInUp" data-wow-duration="1s">
								<img class="img-responsive" src="<?php echo $icon['url'];?>" width="<?php echo $icon['width'];?>" height="<?php echo $icon['height'];?>">
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
	</div>
</div>