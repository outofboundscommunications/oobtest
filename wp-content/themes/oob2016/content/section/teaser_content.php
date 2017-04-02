<?php
$icon        = get_sub_field('icon');
$title       = get_sub_field('title');
$description = str_replace(array('<p>','</p>'),array('',''),get_sub_field('description'));
$button      = get_sub_field('button');?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center tc-white">
			<?php
			if( $icon ){
				?>
				<div class="teaser-icon wow fadeInUp" data-wow-duration="1s">
					<img src="<?php echo $icon['url'];?>" width="<?php echo $icon['width'];?>" height="<?php echo $icon['height'];?>">
				</div>
				<?php
			}
			if( $title ){
				?>
				<h2 class="tc-white wow fadeInUp" data-wow-duration="1s"><?php echo $title;?></h2>
				<?php
			}
			if( $description ){?>
				<p class="extra-big-text wow fadeInUp" data-wow-duration="1s"><?php echo $description;?></p>
				<?php
			}
			if( $button ){?>
				<a class="btn btn-primary wow fadeInUp" href="<?php echo $button['url'];?>" data-wow-duration="1s"><?php echo $button['text'];?></a>
				<?php
			}
			?>
		</div>
	</div>
</div>