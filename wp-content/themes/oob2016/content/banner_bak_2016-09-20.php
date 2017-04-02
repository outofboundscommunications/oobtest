<?php
global $post;
if( is_404() ){
	$post_id = 0;
}else{
	$post_id = $post->ID;
}

$enable_custom_banner = get_field('enable_custom_banner', $post_id);
$banner_video_stat = false;

if($enable_custom_banner){
	$banner_type = get_field('banner_type', $post_id);
	if( $banner_type && $banner_type == 'video' ){
		$banner_video = get_field('banner_video', $post_id);
		if( $banner_video && isset($banner_video[0]) ){
			$banner_video_stat = true;
			
			$video_data = $banner_video[0];
			
			// MP4
			if( !empty($video_data['mp4']) ){
				$video_mp4 = $video_data['mp4'];
			}else{
				$video_mp4 = get_stylesheet_directory_uri().'/videos/defaults/banner-video.mp4';
			}
			
			// WebM
			if( !empty($video_data['webm']) ){
				$video_webm = $video_data['webm'];
			}elseif( file_exists(get_stylesheet_directory().'/videos/defaults/banner-video.webm') ){
				$video_webm = get_stylesheet_directory_uri().'/videos/defaults/banner-video.webm';
			}
			
			// OGV
			if( !empty($video_data['ogv']) ){
				$video_ogv = $video_data['ogv'];
			}elseif( file_exists(get_stylesheet_directory().'/videos/defaults/banner-video.ogv') ){
				$video_ogv = get_stylesheet_directory_uri().'/videos/defaults/banner-video.ogv';
			}
			
			// Video Cover
			if( !empty($video_data['cover']) ){
				$video_cover = $video_data['cover'];
			}else{
				$video_cover = get_stylesheet_directory_uri().'/images/defaults/BMW_7214.jpg';
			}
		}
	}
}

$page_title = get_the_title();

if( is_home() || (is_single() && $post->post_type == 'post')){
	$blog_page_title    = get_field('blog_page_title', 'option');
	$blog_page_subtitle = get_field('blog_page_subtitle', 'option');
	$header_description = get_field('blog_header_description', 'option');
	
	if( $blog_page_title ){
		$page_title = $blog_page_title;
	}else{
		$page_title = 'Our Thinking';
	}
	
	if( $blog_page_subtitle ){
		$header_subtitle = $blog_page_subtitle;
	}
	if( is_single() ){
		$header_subtitle = get_the_title();
	}
	if( $header_description ){
		$header_description = $header_description;
	}
}elseif( is_singular() ){
	$header_title_acf = get_field('header_title', $post_id);
	if( !empty($header_title_acf) ){
		$page_title = $header_title_acf;
	}
	$header_subtitle_acf = get_field('header_subtitle', $post_id);
	if( $header_subtitle_acf ){
		$header_subtitle = $header_subtitle_acf;
	}
	$header_description_acf = get_field('header_description', $post_id);
	if( $header_description_acf ){
		$header_description = $header_description_acf;
	}
}elseif(is_author()){
	
	$author_page_title    = get_field('author_page_title', 'option');
	$author_page_subtitle = get_field('author_page_subtitle', 'option');
	$author_header_description = get_field('author_header_description', 'option');
	
	if( $author_page_title ){
		$page_title = $author_page_title;
	}else{
		$page_title = 'Our Thinking';
	}
	
	if( $author_page_subtitle ){
		$header_subtitle = $author_page_subtitle;
	}
	if( is_single() ){
		$header_subtitle = get_the_title();
	}
	if( $author_header_description ){
		$header_description = $author_header_description;
	}
	
}
elseif(is_category()){
	
	$category_page_title    = get_field('category_page_title', 'option');
	$category_page_subtitle = get_field('category_page_subtitle', 'option');
	$category_header_description = get_field('category_header_description', 'option');
	
	if( $category_page_title ){
		$page_title = $category_page_title;
	}else{
		$page_title = 'Our Thinking';
	}
	
	if( $category_page_subtitle ){
		$header_subtitle = $category_page_subtitle;
	}
	if( is_single() ){
		$header_subtitle = get_the_title();
	}
	if( $category_header_description ){
		$header_description = $category_header_description;
	}
	
}
elseif(is_tag()){
	
	$tag_page_title    = get_field('tag_page_title', 'option');
	$tag_page_subtitle = get_field('tag_page_subtitle', 'option');
	$tag_header_description = get_field('tag_header_description', 'option');
	
	if( $tag_page_title ){
		$page_title = $tag_page_title;
	}else{
		$page_title = 'Our Thinking';
	}
	
	if( $tag_page_subtitle ){
		$header_subtitle = $tag_page_subtitle;
	}
	if( is_single() ){
		$header_subtitle = get_the_title();
	}
	if( $tag_header_description ){
		$header_description = $tag_header_description;
	}
}elseif(is_year()){
	
	$year_page_title    = get_field('year_page_title', 'option');
	$year_page_subtitle = get_field('year_page_subtitle', 'option');
	$year_header_description = get_field('year_header_description', 'option');
	
	if( $year_page_title ){
		$page_title = $year_page_title;
	}else{
		$page_title = 'Our Thinking';
	}
	
	if( $year_page_subtitle ){
		$header_subtitle = $year_page_subtitle;
	}
	if( is_single() ){
		$header_subtitle = get_the_title();
	}
	if( $year_header_description ){
		$header_description = $year_header_description;
	}
	
}elseif(is_month()){
	
	$month_page_title    = get_field('month_page_title', 'option');
	$month_page_subtitle = get_field('month_page_subtitle', 'option');
	$month_header_description = get_field('month_header_description', 'option');
	
	if( $month_page_title ){
		$page_title = $month_page_title;
	}else{
		$page_title = 'Our Thinking';
	}
	
	if( $month_page_subtitle ){
		$header_subtitle = $month_page_subtitle;
	}
	if( is_single() ){
		$header_subtitle = get_the_title();
	}
	if( $month_header_description ){
		$header_description = $month_header_description;
	}
	
}elseif(is_date()){
	
	$date_page_title    = get_field('date_page_title', 'option');
	$date_page_subtitle = get_field('date_page_subtitle', 'option');
	$date_header_description = get_field('date_header_description', 'option');
	
	if( $date_page_title ){
		$page_title = $date_page_title;
	}else{
		$page_title = 'Our Thinking';
	}
	
	if( $date_page_subtitle ){
		$header_subtitle = $date_page_subtitle;
	}
	if( is_single() ){
		$header_subtitle = get_the_title();
	}
	if( $date_header_description ){
		$header_description = $date_header_description;
	}
	
}elseif(is_search()){
	
	$search_page_title    = get_field('search_page_title', 'option');
	$search_page_subtitle = get_field('search_page_subtitle', 'option');
	$search_header_description = get_field('search_header_description', 'option');
	
	if( $search_page_title ){
		$page_title = $search_page_title;
	}else{
		$page_title = 'Our Thinking';
	}
	
	if( $search_page_subtitle ){
		$header_subtitle = $search_page_subtitle;
	}else{
		$header_subtitle = 'Search';
	}
	if( is_single() ){
		$header_subtitle = get_the_title();
	}
	if( $search_header_description ){
		$header_description = $search_header_description;
	}
	$header_description = sprintf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' );
}elseif( is_404() ){
	$page_title = 'Page Not Found';
}

if( $post->post_type == 'case-study'  ){
	$page_title = 'Case Studies';
	$header_subtitle = get_the_title();
}
?>
<div id="page-banner" class="<?php echo ( $banner_video_stat ? 'page-banner-video' : 'page-banner-image' );?>">
	<?php
	if( $banner_video_stat ){
		?>
		<div class="page-banner-video">
			<video poster="<?php echo $video_cover;?>" id="bg-vid" loop autoplay preload="auto">
				<?php
				if( $video_mp4 ){
					?>
					<!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
					<source type="video/mp4" src="<?php echo $video_mp4;?>"></source>
					<?php
				}
				if( $video_webm ){
					?>
					<!-- WebM/VP8 for Firefox4, Opera, and Chrome -->
					<source type="video/webm" src="<?php echo $video_webm;?>"></source>
					<?php
				}
				if( $video_ogv ){
					?>
					<!-- Ogg/Vorbis for older Firefox and Opera versions -->
					<source type="video/ogg" src="<?php echo $video_ogv;?>"></source>
					<?php
				}
				?>
				
			</video>
		</div>
		<?php
	}
	?>
    <?php if ($post->post_type == 'case-study'){$hid = 'header_case_id'; } else{$hid='';}?>
	<div class="page-banner-content" id="<?php echo $hid; ?>">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
                					<div class="top-content">
						<?php
						if( $page_title ){
							?>
							<h1 class="page-title lt wow fadeInUp" data-wow-duration="1s"><?php echo $page_title;?>:</h1>
							<?php
						}
						if( $header_subtitle ){
							?>
							<h1 class="page-subtitle bt wow fadeInUp" data-wow-duration="1s"><?php echo $header_subtitle;?></h1>
							<?php
						}
						?>
						<div class="small-logo wow fadeInUp" data-wow-duration="1s">
							<img src="<?php echo get_stylesheet_directory_uri();?>/images/logo-symbol.png" width="22" height="22">
						</div>
						<?php
						if( $header_description ){
							?>
							<p class="big-text wow fadeInUp" data-wow-duration="1s"><?php echo $header_description;?></p>
							<?php
						}
						?>
					</div>
                    <?php if(is_front_page()) { ?>
                    
                    <div class="two-color-border wow fadeInUp" data-wow-duration="1s">
						<img class="img-responsive" src="<?php echo get_stylesheet_directory_uri();?>/images/round-border.png" width="329" height="324" alt="Out of bounds">
					</div>
                    
                    <?php }else{ }?>
                    
                    

				</div>
			</div>
		</div>
	</div>
	<?php
	if( $banner_video_stat ){
		?>
		<a class="video-pause" id="bg-vid-control">Pause</a>
		<?php
	}
	?>
</div>