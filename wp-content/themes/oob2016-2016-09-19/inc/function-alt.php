<?php

class MyNewWidget extends WP_Widget {

	

	function __construct() {

		// Instantiate the parent object

		parent::__construct( false, 'Recent Posts With Thumbnail' );

	}





	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}

		

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );



		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );



		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;

		if ( ! $number )

			$number = 5;

		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;



		/**

		 * Filter the arguments for the Recent Posts widget.

		 *

		 * @since 3.4.0

		 *

		 * @see WP_Query::get_posts()

		 *

		 * @param array $args An array of arguments used to retrieve the recent posts.

		 */

		$r = new WP_Query( apply_filters( 'widget_posts_args', array(

			'posts_per_page'      => $number,

			'no_found_rows'       => true,

			'post_status'         => 'publish',

			'ignore_sticky_posts' => true

		) ) );



		if ($r->have_posts()) :

		?>

		<?php echo $args['before_widget']; ?>

		<?php if ( $title ) {

			echo $args['before_title'] . $title . $args['after_title'];

		} ?>

        

        

        

        

		<ul>

		<?php while ( $r->have_posts() ) : $r->the_post(); ?>

			<li>

                <div class="post-thumbnail-widget">

            	<?php 

         			if( has_post_thumbnail($post_id) ){

        			// Featured Image

        			$case_img_data   = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'our_thinking_section_thumbnail' );

        			$case_img_url    = $case_img_data['0'];

        			$case_img_width  = $case_img_data['1'];

        			$case_img_height = $case_img_data['2'];

       				}else{

        				$case_img_url = get_stylesheet_directory_uri().'/images/defaults/widget_thumb.png';

       				}

				

	   			?>

            	<img height="76" width="76" src="<?php echo $case_img_url; ?>" class="img-responsive img-circle">



       			</div>

                <div class="rec-details">

                  <p><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></p>

                  <span class="rec-dete">

                  <?php if ( $show_date ) : ?>

						<?php echo get_the_date('d-M-Y'); ?>

					<?php endif; ?>

                  

                  </span>

                </div>

         </li>

		<?php endwhile; ?>

		</ul>

		<?php echo $args['after_widget']; ?>

		<?php

		// Reset the global $the_post as this query will have stomped on it

		wp_reset_postdata();



		endif;

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		$instance['number'] = (int) $new_instance['number'];

		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;

	}



	public function form( $instance ) {

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;

		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;

?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>

		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>



		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>

		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>



		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />

		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>

<?php

	}

}



function myplugin_register_widgets() {

	register_widget( 'MyNewWidget' );
}

add_action( 'widgets_init', 'myplugin_register_widgets' );



//[carousel-gallery]
function carousel_gallery( $atts ){
	
	$images = get_field('gallery');
	$temp ='';
	
	foreach( $images as $image ):
		$a = $image['sizes']['large'];
		$b = $image['alt'];    
		$temp = $temp.'<div class="item"><img src="'.$a.'" alt="'.$b.'" /></div>';
	endforeach;
			
	$x = '<div class="owl-carousel-case">'.$temp.'</div>';
	return $x;
}
add_shortcode( 'carousel-gallery', 'carousel_gallery' );


function my_wpcf7_validate_text( $result, $tag ) {

$type = $tag['type'];
$name = $tag['name'];
$value = $_POST[$name] ;

if ( strpos( $name , 'name' ) !== false ){
$regex = '/^[a-zA-Z]+$/';
$Valid = preg_match($regex, $value, $matches );
if ( $Valid > 0 ) {
}
else {
$result->invalidate( $tag, wpcf7_get_message( 'invalid_name' ) );
}
}
return $result;
}
add_filter( 'wpcf7_validate_text*', 'my_wpcf7_validate_text' , 10, 2 );

add_filter( 'wpcf7_messages', 'mywpcf7_text_messages' );
function mywpcf7_text_messages( $messages ) {
return array_merge( $messages, array(
'invalid_name' => array(
'description' => __( "Name is invalid", 'contact-form-7' ),
'default' => __( 'Name seems invalid.', 'contact-form-7' )
)));
}
