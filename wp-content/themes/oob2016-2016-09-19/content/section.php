<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<?php global $section_id, $section_type;?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<header class="entry-header">
		
		<?php
		$post_id = get_the_ID();
		
		if( has_post_thumbnail(get_the_ID()) ){
			
			// Featured Image
			$case_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			$case_img_url    = $case_img_data['0'];
			$case_img_width  = $case_img_data['1'];
			$case_img_height = $case_img_data['2'];
			?>
			<div class="entry-thumb">
				<img src="<?php echo $case_img_url;?>" alt="image" width="<?php echo $case_img_width;?>" height="<?php echo $case_img_height;?>" class="img-responsive wow fadeInUp" data-wow-duration="1s"/>
			</div>
			<?php
		}
		?>
        </header>

    
		<?php /*?>
		<header class="entry-header">
			<?php if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
			<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<?php */?>
		
		<div class="entry-content">
			
			<?php // the_content(); ?>
			<?php // wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
			
			<?php
			if( have_rows('sections') ){
				?>
				<div class="sections">
					<?php
					$media_sizing = array(
						'xs' => '@media (max-width: 767px)',
						'sm' => '@media (min-width: 768px)',
						'md' => '@media (min-width: 992px)',
						'lg' => '@media (min-width: 1200px)',
					);
					$section_sr = 1;
					$section_counters = array();
					
					while( have_rows('sections') ){
						the_row();
						
						// Reset Global Vars
						$section_id = false;
						$section_type = false;
						
						$section_class = array();
						
						// Section ID
						$section_id = get_sub_field('section_id');
						$section_id = "section_$section_id";
						
						// Background Type
						$background_type = get_sub_field('background_type');
						if( empty($background_type) ){
							$background_type = 'color';
						}
						
						// Background Color Scheme
						$background_color_scheme = get_sub_field('background_color_scheme');
						if( empty($background_color_scheme) ){
							$background_color_scheme = 'light';
						}
						
						$custom_class = get_sub_field('custom_class');
						
						// Section Type
						$content_type = get_sub_field('content_type');
						
						if( have_rows('content_type') ){
							$content_type_sr = 1;
							while ( have_rows('content_type') ){
								the_row();
								
								if( $content_type_sr > 1 ){
									continue;
								}
								
								$section_type = get_row_layout();
								if( !isset($section_counters[ $section_type ] ) ){
									// initialize counter
									$section_counters[ $section_type ] = 1;
								}else{
									// increase existing counter
									$section_counters[$section_type]++;
								}
								$section_type_sr = $section_counters[$section_type];
								
								// Section Classes
								$section_class[] = "section-$section_sr";
								$section_class[] = "section-".( $section_sr % 2 ? 'odd' : 'even' );
								$section_class[] = "section-type-$section_type";
								$section_class[] = "section-$section_type-$section_type_sr";
								$section_class[] = "section-bgtype-$background_type";
								$section_class[] = "section-background_color_scheme-$background_color_scheme";
								
								// Custom Class
								if( !empty($custom_class) ){
									$section_class[] = $custom_class;
								}
								
								$section_class = implode(' ', $section_class);
								?>
								<div id="<?php echo $section_id;?>" class="section <?php echo $section_class;?>">
									<?php get_template_part( 'content/section/'.$section_type );?>
								</div>
								<?php
								$content_type_sr++;
							}
						}
						$section_sr++;
					}
					?>
				</div>
				<?php
			}
			?>
			
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->