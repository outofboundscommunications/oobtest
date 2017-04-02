<?php
$title               = get_sub_field('title');
$showcase_image      = get_sub_field('showcase_image');
$showcase_title      = get_sub_field('showcase_title');
$showcase_description= get_sub_field('showcase_description');
$showcase_link       = get_sub_field('showcase_link');
?>
<div class="container">
	<?php
	if( $title ){
		?>
		<div class="row">
			<div class="col-sm-12 text-center wow fadeInUp" data-wow-duration="1s">
				<h2><?php echo $title;?></h2>
			</div>
		</div>
		<?php
	}
	?>
	<div class="row">
		<div class="col-sm-6">
			<?php
			if( $showcase_image ){
				?>
				<div class="eye-img wow fadeInLeft" data-wow-duration="1s"><img src="<?php echo $showcase_image['url'];?>" width="<?php echo $showcase_image['width'];?>" height="<?php echo $showcase_image['height'];?>" class="img-responsive"></div>
				<?php
			}
			?>
		</div>
		<div class="col-sm-6">
			<div class="showcase-content">
				<?php
				if( $showcase_title ){
					?>
					<h4 class="wow fadeInUp" data-wow-duration="1s"><?php echo $showcase_title;?></h4>
					<?php
				}
				if( $showcase_description ){
					?>
					<p class="mb-70 wow fadeInUp" data-wow-duration="1s"><?php echo $showcase_description;?></p>
					<?php
				}
				if( $showcase_link ){
					?>
					<a href="<?php echo $showcase_link['url'];?>" class="btn btn-primary wow fadeInUp" data-wow-duration="1s"><?php echo $showcase_link['text'];?></a>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>