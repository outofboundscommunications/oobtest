<?php
$title   = get_sub_field('title');
$content = get_sub_field('content');
?>
<div class="container">
	<div class="col-sm-12">
		<?php
		if( $title ){
			?>
			<h2 class="inner-section-title text-center wow fadeInUp" data-wow-duration="1s"><?php echo $title;?></h2>
			<?php
		}
		if( $content ){
			?>
			<div class="section-content">
				<?php echo $content;?>
			</div>
			<?php
		}
		?>
	</div>
</div>
