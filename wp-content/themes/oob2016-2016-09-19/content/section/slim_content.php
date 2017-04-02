<?php
$title      = get_sub_field('title');
$subtitle   = get_sub_field('subtitle');
$description= str_replace(array('<p>','</p>'),array('',''),get_sub_field('description'));
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center">
			<?php
			if( $title ){
				?>
				<h2 class="inner-section-title wow fadeInUp" data-wow-duration="1s"><?php echo $title;?></h2>
				<?php
			}
			if( $subtitle ){
				?>
				<h4 class="inner-section-sub-title wow fadeInUp" data-wow-duration="1s"><?php echo $subtitle;?></h4>
				<?php
			}
			if( $description ){?>
				<p class="wow fadeInUp" data-wow-duration="1s"> <?php echo $description;?> </p>
			<?php }	?>
		</div>
	</div>
</div>