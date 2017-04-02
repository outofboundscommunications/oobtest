<?php
add_action( 'wp_head', 'tc_output_css', 160 );
function tc_output_css() {
	global $post, $dynamic_css,$wp_query;
	
	if( is_404() ){
		$post_id = 0;
	}else{
		$post_id = $post->ID;
		
		if(is_home()){
			$page_for_posts = get_option( 'page_for_posts' );
			if(@$wp_query->queried_object->ID==$page_for_posts){
				$post_id = $page_for_posts;
			}			
		}
	}
	
	$dynamic_css = array();	
	$background_image = get_field('background_image', 'option');
	if( !$background_image ){
		$background_image = get_stylesheet_directory_uri().'/images/defaults/banner-bg.png';
	}
	//$dynamic_css['#page-banner']['background-color'] = '#cccccc';
	//$dynamic_css['#page-banner']['background-image'] = 'url("'.$background_image.'")';
	$dynamic_css['#page-banner']['background'] = '#cccccc url("'.$background_image.'")';
	
	if( is_page() || is_single() || is_home()){
		
		$enable_custom_banner = get_field('enable_custom_banner', $post_id);
		
		if($enable_custom_banner){
			$banner_type = get_field('banner_type', $post_id);
			if( empty($banner_type) ){
				$banner_type = 'image';
			}			
			if( $banner_type == 'image' ){
				$background_image = get_field('background_image',$post_id);
				if( !empty($background_image) ){
					//$dynamic_css['#page-banner']['background-image'] = 'url("'.$background_image.'")';
					$dynamic_css['#page-banner']['background'] = '#cccccc url("'.$background_image.'")';
				}
			}
		}
		// Add sections CSS
		$section_css = get_post_meta( $post_id, '_section_css', true );
		if( !empty($section_css) ){
			$dynamic_css = array_merge($dynamic_css, $section_css);
		}
	}
	
	$parsed_css = grasmash_generate_css_properties($dynamic_css);
	echo '<style type="text/css" title="oob-dynamic-css" class="dynamic-css">'.$parsed_css.'</style>'."\r\n";
}
?>