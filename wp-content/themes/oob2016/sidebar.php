<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*$args = array('numberposts' => '5');
$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
foreach( $recent_posts as $recent ){
    if($recent['post_status']=="publish"){
 if ( has_post_thumbnail($recent["ID"])) {
  echo '<li>
  <a href="' . get_permalink($recent["ID"]) . '" >' .   get_the_post_thumbnail($recent["ID"], 'thumbnail'). $recent["post_title"].'</a></li> ';
 }else{
  echo '<li>
  <a href="' . get_permalink($recent["ID"]) . '" >' .   $recent["post_title"].'</a></li> ';
 }
 }
}*/

 if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->
<?php endif;
