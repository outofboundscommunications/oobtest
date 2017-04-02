<?php
$title        = get_sub_field('title');
$capabilities = get_sub_field('capabilities');
$button       = get_sub_field('button');
?>
<div class="container text-center">
	<h2 class="inner-section-title wow fadeInUp" data-wow-duration="1s">Our Capabilities</h2>
	<?php
	if( have_rows('capabilities') ){
		$capabilities_count = count($capabilities);
		?>
		<div class="row">
			<?php
			$capabilities_sr = 1;
			$capabilities_content = array();
			$cap_column = 1;
			while( have_rows('capabilities') ){
				the_row();
				
				// vars
				$capability = get_sub_field('capability');
				$link       = get_sub_field('link');
				
				if( $capability ){
					$cap_column = ($capabilities_sr%3 == 0) ? 3 : $capabilities_sr%3;
					ob_start();
					?>
<li><?php
if( $link ){
echo '<a href="'.$link.'"><span>';
}
echo $capability;
if( $link ){
echo '</span></a>';
}
?></li>
<div class="clearfix">&nbsp;</div>
					<?php
					$capabilities_content[$cap_column][] = ob_get_clean();
					
					$capabilities_sr++;
				}
			}
			?>
			<div class="col-sm-4 wow fadeInRight" data-wow-duration="1s"><ul class="cap-list"><?php echo implode('',$capabilities_content[1]);?></ul></div>
			<div class="col-sm-4 wow fadeInRight" data-wow-duration="1.4s"><ul class="cap-list"><?php echo implode('',$capabilities_content[2]);?></ul></div>
			<div class="col-sm-4 wow fadeInRight" data-wow-duration="1.8s"><ul class="cap-list"><?php echo implode('',$capabilities_content[3]);?></ul></div>
			<?php
			?>
		</div>
		<?php
	}
	if( $button ){
		?>
		<div class="need-btn wow fadeInUp" data-wow-duration="1s"><a href="<?php echo $button['url'];?>" class="btn btn-primary"><?php echo $button['text'];?></a></div>
		<?php
	}
	?>
</div>