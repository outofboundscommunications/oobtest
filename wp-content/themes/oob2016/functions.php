<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $dynamic_css;
$dynamic_css = array();

// Includes
require_once get_stylesheet_directory() . '/inc/cpts.php';
require_once get_stylesheet_directory() . '/inc/shortcodes.php';
require_once get_stylesheet_directory() . '/inc/comments.php';
require_once get_stylesheet_directory() . '/minifier-script.php';

add_action( 'after_setup_theme', 'remove_parent_theme_features', 11 );
function remove_parent_theme_features() {
	remove_theme_support( 'custom-header' );
	remove_theme_support( 'custom-background' );
}

add_action( 'widgets_init', 'wp_tuts_parent_unregister_sidebars', 11 );
function wp_tuts_parent_unregister_sidebars() {
	// remove a sidebar registered by the Parent Theme
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
}

add_action( 'after_setup_theme', 'clear_ventures_theme_setup',11 );
function clear_ventures_theme_setup(){
	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( 150, 150, true );
	
	add_image_size( 'thumbnail', 150, 150, true );
	add_image_size( 'our_thinking_section_thumbnail', 372, 372, true );
	add_image_size( 'our_thinking_icon', 121, 125, true );
	add_image_size( 'blog_thumb', 255, 255, true );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'footer', __( 'Footer Menu', 'twentytwelve' ) );
	register_nav_menu( 'footer-social', __( 'Footer Social', 'twentytwelve' ) );
	
	if( function_exists('acf_add_options_page') ) {
		
		$parent = acf_add_options_page(array(
			'page_title' 	=> 'Out of Bounds Site Settings',
			'menu_title' 	=> 'Site Settings',
			'redirect' 		=> true
		));
		
		acf_add_options_sub_page(array(
			'page_title' 	=> 'General Setting',
			'menu_title' 	=> 'General',
			'parent_slug' 	=> $parent['menu_slug'],
		));
		
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Header Setting',
			'menu_title' 	=> 'Header',
			'parent_slug' 	=> $parent['menu_slug'],
		));
		
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Footer Setting',
			'menu_title' 	=> 'Footer',
			'parent_slug' 	=> $parent['menu_slug'],
		));
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Social Profiles',
			'menu_title' 	=> 'Social Profiles',
			'parent_slug' 	=> $parent['menu_slug'],
		));
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Blog Page',
			'menu_title' 	=> 'Blog Page',
			'parent_slug' 	=> $parent['menu_slug'],
		));
	}
	
	// Remove Parent Stylesheet and Javascripts
	remove_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles', 10 );
}

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function oob_widgets_init() {
	register_sidebar( array(
		'name'         => __( 'Page Sidebar', 'twentytwelve' ),
		'id'           => 'page-sidebar',
		'description'  => __( 'Appears on pages.', 'twentytwelve' ),
		'before_widget'=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title'  => '</h3>',
	) );
}
add_action( 'widgets_init', 'oob_widgets_init' );

// CSS & Javascripts
add_action( 'wp_enqueue_scripts', 'oob_scripts_styles' );
//add_action( 'admin_enqueue_scripts', 'oob_admin_scripts_styles' );
function oob_admin_scripts_styles(){
	if( $_SERVER['SERVER_NAME'] == 'test.outofboundscommunications.com' ){
		wp_enqueue_script( 'google_map',   'https://maps.googleapis.com/maps/api/js?key=AIzaSyBob92fPkzMAyZOu1NdGX2ozNEgI1tJWyM', array('jquery') );
	}elseif( $_SERVER['SERVER_NAME'] == 'outofboundscommunications.com' ){
		wp_enqueue_script( 'google_map',   'https://maps.googleapis.com/maps/api/js?key=AIzaSyBob92fPkzMAyZOu1NdGX2ozNEgI1tJWyM', array('jquery') );
	}elseif( $_SERVER['SERVER_NAME'] == '192.168.22.201' ){
		wp_enqueue_script( 'google_map',   'https://maps.googleapis.com/maps/api/js?key=AIzaSyBJSO0PAKxuJAyGzp85T0j3wy_23WJOIYY', array('jquery') );
	}
	else{
		wp_enqueue_script( 'google_map',   'https://maps.googleapis.com/maps/api/js?key=AIzaSyBd-RehNhknU2w9JS0rwIgHwfF0BuDDHXU', array('jquery') );
	}
}

function oob_scripts_styles(){
	global $wp_styles;
	
	/*De register wp-pagenavi style */
	wp_deregister_style( 'wp-pagenavi');
	
	// wp_enqueue_style( 'requried_css', 'https://cdn.jsdelivr.net/g/bootstrap@3.3.6(css/bootstrap-theme.min.css+css/bootstrap.min.css),fontawesome@4.6.3' );
	wp_enqueue_style( 'bootstrap',    get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
	//wp_enqueue_style( 'fontawesoe',   get_stylesheet_directory_uri() . '/css/font-awesome.min.css' );
	
	/*wp_enqueue_style( 'owl_carousel', get_stylesheet_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'owl_theme',    get_stylesheet_directory_uri() . '/css/owl.theme.css' );
	wp_enqueue_style( 'slicknav',     get_stylesheet_directory_uri() . '/css/slicknav.min.css' );
	wp_enqueue_style( 'animate-css',     get_stylesheet_directory_uri() . '/css/animate.min.css' );*/
	
	/*Combain owl.carousel.css, owl.theme.css, slicknav.css and animate.css in customs.css file */
	wp_enqueue_style( 'animate-css',     get_stylesheet_directory_uri() . '/css/customs.min.css' );
	wp_enqueue_style( 'child-theme',  get_stylesheet_directory_uri() . '/css/style.css' );
	
	
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
		
	wp_enqueue_script( 'bootstrap',     get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	//wp_enqueue_script( 'google_map',   'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&ver=4.5.3', array('jquery'), '', true );
	
	if( $_SERVER['SERVER_NAME'] == 'test.outofboundscommunications.com' ){
		wp_enqueue_script( 'google_map',   'https://maps.googleapis.com/maps/api/js?key=AIzaSyBob92fPkzMAyZOu1NdGX2ozNEgI1tJWyM', array('jquery') );
	}elseif( $_SERVER['SERVER_NAME'] == 'outofboundscommunications.com' ){
		wp_enqueue_script( 'google_map',   'https://maps.googleapis.com/maps/api/js?key=AIzaSyBob92fPkzMAyZOu1NdGX2ozNEgI1tJWyM', array('jquery') );
	}elseif( $_SERVER['SERVER_NAME'] == '192.168.22.201' ){
		wp_enqueue_script( 'google_map',   'https://maps.googleapis.com/maps/api/js?key=AIzaSyBJSO0PAKxuJAyGzp85T0j3wy_23WJOIYY', array('jquery') );
	}
	wp_enqueue_script( 'owl_carousel',  get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true );
	// wp_enqueue_script( 'owl_cthumb', get_stylesheet_directory_uri() . '/js/owl.carousel2.thumbs.min.js', array('jquery','owl_carousel'), '', true );
	wp_enqueue_script( 'slicknav',      get_stylesheet_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'matchheight',   get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array('jquery'), '', true );
	wp_enqueue_script( 'functions',     get_stylesheet_directory_uri() . '/js/functions.js', array('jquery', 'slicknav'), '', true );
	wp_enqueue_script( 'wow-js',     get_stylesheet_directory_uri() . '/js/wow.min.js', array('jquery'), '', true );
	
	?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var ajaxurl_new = '<?php echo get_stylesheet_directory_uri().'/inc/admin-ajax.php';?>';
	</script>
	<?php
}

/**
 * Converts a multidimensional array of CSS rules into a CSS string.
 *
 * @param array $rules
 *   An array of CSS rules in the form of:
 *   array('selector'=>array('property' => 'value')). Also supports selector
 *   nesting, e.g.,
 *   array('selector' => array('selector'=>array('property' => 'value'))).
 *
 * @return string
 *   A CSS string of rules. This is not wrapped in <style> tags.
 * 
 * source : http://www.grasmash.com/article/convert-nested-php-array-css-string
 */
function grasmash_generate_css_properties($rules, $indent = 0) {
	$css = '';
	$prefix = str_repeat('  ', $indent);
	foreach ($rules as $key => $value) {
		if (is_array($value)) {
			$selector = $key;
			$properties = $value;
			
			$css .= $prefix . "$selector {\n";
			$css .= $prefix .grasmash_generate_css_properties($properties, $indent + 1);
			$css .= $prefix . "}\n";
		}
		else {
			$property = $key;
			$css .= $prefix . "$property: $value;\n";
		}
	}
	return $css;
}


/*
 * This function use for subscribe user in mailchimp.
 */
add_action('wp_ajax_mailchimp_singup','thecorps_mailchimp_signup_action');
add_action('wp_ajax_nopriv_mailchimp_singup','thecorps_mailchimp_signup_action');
function thecorps_mailchimp_signup_action(){
	
	require_once get_stylesheet_directory().'/inc/MCAPI.class.php';
	
	$mailchimp_api_key = get_field('mailchimp_api_key','option');
	$mailchimp_list_id = get_field('mailchimp_list_id','option');
	
	//INCLUDE DEFAULT MAILCHIMP FILES FINISH.
	$apikey = $mailchimp_api_key;
	$listId = $mailchimp_list_id;
	
	$apiUrl = 'http://api.mailchimp.com/1.3/';
	
	//CONFIGURE VARIABLES START.
	$api = new MCAPI($apikey);
	
	//$name = $_REQUEST['news_letter_name'];
	$email = $_REQUEST['news_letter_email'];
	$merge_vars = array('FNAME' => '');
	
	//CONFIGURE VARIABLES FINISH.
	//MAKE API CALLSE FOR MAILCHIMP START.
	
	$retval = $api->listSubscribe( $listId, $email, $merge_vars );
	
	//MAKE API CALLSE FOR MAILCHIMP FINISH.
	//CONFIGURE ERROR OR SUCCESS PROCESS START.
	if ($api->errorCode){
		echo $api->errorMessage;
	} else {
		_e("Successfully Subscribed. Please check confirmation email.",DOMAIN);
	}
	
	wp_die();	
}

require_once get_stylesheet_directory() . '/inc/dynamic_css.php';

add_action( 'save_post', 'oob_save_css', 10, 3 );
function oob_save_css( $post_id, $post, $update ) {
	
	// If it is a autosave return
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	// If this is a revision, return
	if ( wp_is_post_revision( $post_id ) )
		return;
	
	// If this is not a page, return
	if ( 'page' != $post->post_type )
		return;
	
	$css = array();
	
	$media_sizing = array(
		'xs' => '@media (max-width: 767px)',
		'sm' => '@media (min-width: 768px)',
		'md' => '@media (min-width: 992px)',
		'lg' => '@media (min-width: 1200px)',
	);
	$section_css = array();
	
	if( have_rows('sections') ){
		
		while( have_rows('sections') ){
			the_row();
			
			// vars
			$section_id = get_sub_field('section_id');
			$section_id = "section_$section_id";
			$background_type = get_sub_field('background_type');
			$background_color = get_sub_field('background_color');
			$background_image = get_sub_field('background_image');
			
			// Background Spacing
			$spacing_size = get_sub_field('spacing_size');
			if( have_rows('spacing_size') ){
				while( have_rows('spacing_size') ){ the_row();
					
					// Spacing CSS
					$display_size   = get_sub_field('display_size');
					$spacing_top    = get_sub_field('spacing_top');
					$spacing_bottom = get_sub_field('spacing_bottom');
					if( $display_size ){
						if( !empty($spacing_top) ){
							$section_css[$media_sizing[$display_size]]['body #main #'.$section_id]['padding-top'] = "{$spacing_top}px";
						}
						if( !empty($spacing_bottom) ){
							$section_css[$media_sizing[$display_size]]['body #main #'.$section_id]['padding-bottom'] = "{$spacing_bottom}px";
						}
					}
				}
			}
			
			// Section Background
			$background_type = get_sub_field('background_type');
			if( empty($background_type) ){
				$background_type = 'color';
			}
			$background_color = get_sub_field('background_color');
			if( empty($background_color) ){
				$background_color = '#FDFDFD';
			}
			$background_image = get_sub_field('background_image');
			
			if( $background_type == 'image' && $background_image ){
				$section_css['#'.$section_id] = array(
					'background-image' => "url('$background_image')",
				);
			}else{
				$section_css['#'.$section_id] = array(
					'background-color' => $background_color,
				);
			}
		}
	}
	
	if ( empty( $section_css ) ) {
		delete_post_meta( $post_id, '_section_css' );
	} else {
		update_post_meta( $post_id, '_section_css', $section_css );
	}
}

function get_excerpt_max_charlength($charlength, $excerpt = null) {
	if( empty($excerpt) ){
		$excerpt = get_the_excerpt();
	}
	$charlength++;
	
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		
		$new_excerpt = '';
		if ( $excut < 0 ) {
			$new_excerpt = mb_substr( $subex, 0, $excut );
		} else {
			$new_excerpt = $subex;
		}
		//$new_excerpt .= '[...]';
		return $new_excerpt;
	} else {
		return $excerpt;
	}
}
function the_excerpt_max_charlength($charlength, $excerpt = null) {
	$new_excerpt = get_excerpt_max_charlength($charlength, $excerpt);
	echo $new_excerpt;
}

function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_filter( 'body_class', 'oob_class_names' );
function oob_class_names( $classes ) {
	global $post;
	if( is_404() ){
		$post_id = 0;
	}else{
		$post_id = $post->ID;
	}
	
	$banner_type = get_field('banner_type', $post_id);
	$banner_video = get_field('banner_video', $post_id);
	$banner_video = get_field('banner_video', $post_id);
	
	if( $banner_type && $banner_type == 'video' && $banner_video && isset($banner_video[0]) ){
		$classes[] = 'banner-type-video';
	}else{
		$classes[] = 'banner-type-image';
	}
	
	// return the $classes array
	return $classes;
}

function oob_logo_url(){
	global $post;
	
	if( is_404() ){
		$post_id = 0;
	}else{
		$post_id = $post->ID;
	}
	
	$banner_type = get_field('banner_type', $post_id);
	$banner_video = get_field('banner_video', $post_id);
	$banner_video = get_field('banner_video', $post_id);
	
	if( $banner_type && $banner_type == 'video' && $banner_video && isset($banner_video[0]) ){
		$logo = get_field('logo_alt', 'option');
		if( $logo ){
			return $logo;
		}else{
			return get_stylesheet_directory_uri().'/images/logo_alt.png';
		}
		
	}else{
		$logo = get_field('logo', 'option');
		if( $logo ){
			return $logo;
		}else{
			return get_stylesheet_directory_uri().'/images/logo.png';
		}
	}
}
require get_stylesheet_directory() . '/inc/function-alt.php';

add_filter( 'wp_pagenavi', 'ik_pagination', 10, 2 );
function ik_pagination($html){
	$html = str_replace( array(
		"<div class='wp-pagenavi'>",//1
		'</div>',                   //2
		"<span class='pages'>",     //3
		'</span>',                  //4
		"<span class='current'>",   //5
		'<a ',                 //6
		'</a>',                     //7
		"<span class='extend'>",    //8
		__( '« First', 'ipt_kb' ),  //9 translator: Translate it to the output of WP PageNavi for your lang
		__( 'Last »', 'ipt_kb' ),   //10 translator: Translate it to the output of WP PageNavi for your lang
		'«',                        //11
		'»',                        //12
	), array(
		'<ul class="pagination pagination-lg">',
		'</ul>',
		'<li class="disabled"><span>',
		'</span></li>',
		'<li class="active"><span>',
		'<li><a ',
		'</a></li>',
		'<li class="disabled"><span>',
		// __( '« First', 'ipt_kb' ),  //9 translator: Translate it to the output of WP PageNavi for your lang
		// __( 'Last »', 'ipt_kb' ),   //10 translator: Translate it to the output of WP PageNavi for your lang
		// '«',                        //11
		// '»',                        //12
		'<i class="fa fa-fast-backward"></i>',
		'<i class="fa fa-fast-forward"></i>',
		'<i class="fa fa-backward"></i>',
		'<i class="fa fa-forward"></i>',
	), $html );
	return $html;
}

require_once get_stylesheet_directory() . '/inc/optimization.php';


add_filter('img_caption_shortcode','oobc_img_caption_shortcode',10,3);
function oobc_img_caption_shortcode($html, $attr, $content){

	$atts = shortcode_atts( array(
		'id'	  => '',
		'align'	  => 'alignnone',
		'width'	  => '',
		'caption' => '',
		'class'   => '',
	), $attr, 'caption' );

	$atts['width'] = (int) $atts['width'];	

	if ( ! empty( $atts['id'] ) )
		$atts['id'] = 'id="' . esc_attr( sanitize_html_class( $atts['id'] ) ) . '" ';

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	$html5 = current_theme_supports( 'html5', 'caption' );
	// HTML5 captions never added the extra 10px to the image width
	$width = $html5 ? $atts['width'] : ( 10 + $atts['width'] );

	/**
	 * Filter the width of an image's caption.
	 *
	 * By default, the caption is 10 pixels greater than the width of the image,
	 * to prevent post content from running up against a floated image.
	 *
	 * @since 3.7.0
	 *
	 * @see img_caption_shortcode()
	 *
	 * @param int    $width    Width of the caption in pixels. To remove this inline style,
	 *                         return zero.
	 * @param array  $atts     Attributes of the caption shortcode.
	 * @param string $content  The image element, possibly wrapped in a hyperlink.
	 */
	$caption_width = apply_filters( 'img_caption_shortcode_width', $width, $atts, $content );

	$style = '';
	if ( $caption_width )
		$style = 'style="width: ' . (int) $caption_width . 'px" ';

	$html = '';
	if ( $html5 ) {
		$html = '<figure ' . $atts['id'] . $style . 'class="' . esc_attr( $class ) . '">'
		. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
	} else {
		$html = '<div ' . $atts['id'] . $style . 'class="' . esc_attr( $class ) . '">'
		. do_shortcode( $content ) . '<p class="wp-caption-text">' . $atts['caption'] . '</p></div>';
	}

	return $html;
}

function oob2016_excerpt_more($more) {      
	return '';
}
add_filter('excerpt_more', 'oob2016_excerpt_more');


function custom_search_form( $form, $value = "Search", $post_type = 'post' ) {
    $form_value = (isset($value)) ? $value : attribute_escape(apply_filters('the_search_query', get_search_query()));
    $form = '<form method="get" id="searchform" class="searchform" action="' . get_option('home') . '/" >
    <div>
        <input type="hidden" name="post_type" value="'.$post_type.'" />
        <input type="text" value="' . $form_value . '" name="s" id="s" />
        <input type="submit" id="searchsubmit" class="btn btn-primary" value="'.attribute_escape(__('Search')).'" />
    </div>
    </form>';
    return $form;
}

add_shortcode('wpbsearch', 'custom_search_form');


add_action( 'wp_ajax_nopriv_load-filter', 'prefix_load_cat_posts' );
add_action( 'wp_ajax_load-filter', 'prefix_load_cat_posts' );
function prefix_load_cat_posts () {
    $cat_id = $_POST[ 'cat' ];
         $args = array (
        'cat' => $cat_id,
        'posts_per_page' => 10,
        'order' => 'DESC'

    );
    $posts = get_posts( $args );

    ob_start ();

    foreach ( $posts as $post ) {
    setup_postdata( $post ); ?>
    
    <div class="col-sm-6 col-md-6">
	<article id="post-<?php echo $post->ID; ?>" <?php post_class('post image wow fadeInUp'); ?>  data-wow-duration="1s">
    <div class="post-thumbnail">
            <?php 
         		if( has_post_thumbnail($post->ID) ){
        		// Featured Image
        		$case_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'our_thinking_section_thumbnail' );
        		$case_img_url    = $case_img_data['0'];
        		$case_img_width  = $case_img_data['1'];
        		$case_img_height = $case_img_data['2'];
       			}else{
        			$case_img_url = get_stylesheet_directory_uri().'/images/defaults/blog_thumb.png';
       			}
				
	   		?>
            <img height="255" width="255" src="<?php echo $case_img_url; ?>" class="img-responsive"/>

       		</div>
        	
			<div class="post-content">
				
					<h3 class="widget-title">
						<a href="<?php echo  get_permalink($post->ID); ?>" rel="bookmark"><?php echo $post->post_title; ?></a>
					</h3>
				
                 </div>		
	</article>       
    </div>

   <?php } wp_reset_postdata();

   $response = ob_get_contents();
   ob_end_clean();

   echo $response;
   die(1);
   }
