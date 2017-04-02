<?php
// [bartag foo="foo-value"]

function oob_testimonial_func( $atts ) {
    $a = shortcode_atts( array(
        'id' => '',
    ), $atts );

	// Return blank if not ID is provided

	if( empty($a['id']) ) return '';
	$testimonial = get_post( $a['id'] );

	// Return blank if no post found with ID
	if ( !$testimonial ) return '';

	// Return blank if post_type is not testimonials

	if( $testimonial->post_type != 'testimonial' ) return '';
	$post_content = get_post_field('post_content', $a['id']);
	$author = get_field('author', $a['id']);
	$company = get_field('company', $a['id']);
	ob_start();
?>

<div class="user-details testmonial_shortcode text-left clearfix" >
     <?php 
		if( has_post_thumbnail($testimonial) ){
        // Featured Image
        $case_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id($testimonial), 'our_thinking_section_thumbnail' );
        $case_img_url    = $case_img_data['0'];
        $case_img_width  = $case_img_data['1'];
        $case_img_height = $case_img_data['2'];
       	}else{
        	$case_img_url = get_stylesheet_directory_uri().'/images/testimonials-img.png';
       	}
	 ?>

     <img src="<?php echo $case_img_url; ?>" class="img-responsive <?php if(has_post_thumbnail($testimonial) ){ echo 'img-circle'; }?> user-img fadeInRight wow" width="329" height="328" data-wow-duration="1s">

	<!--<img src="<?php echo get_stylesheet_directory_uri();?>/images/testimonials-img.png" class="img-responsive user-img wow fadeInRight" ata-wow-duration="1s">-->
	<div class="testimonials-content wow fadeInLeft" data-wow-duration="1s">
		<p><?php echo $post_content;?></p>
		<div class="test_meta">
			<span class="test_author">- <?php echo $author;?></span> | <span class="test_company oob_red"><?php echo $company;?></span>
		</div>
	</div>
</div>

<?php
$content = ob_get_clean();
    return $content;
}
add_shortcode( 'oob_testimonial', 'oob_testimonial_func' );

function contact_name_fun(){
	if( isset($_GET['n']) && !empty($_GET['n']) )
	return sanitize_text_field($_GET['n']);
}

add_shortcode('contact_name', 'contact_name_fun');