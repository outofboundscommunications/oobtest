<?php
if ( ! function_exists( 'oob_comments' ) ) :
function oob_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments.
			?>
			<li <?php comment_class('comments-1'); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
			break;
			
		default :
			// Proceed with normal comments.
			global $post;
			?>
			<li <?php comment_class('wow fadeInUp animated clearfix'); ?> id="li-comment-<?php comment_ID(); ?>">
				<div class="post-panel">
					<div class="comments-photo thumbnail">
						<?php echo get_avatar( $comment, 100 );?>
					</div>
					<div class="comments-info panel-body">
						<div id="comment-<?php comment_ID(); ?>" class="comment">
							<header class="comment-meta comment-author vcard">
								<?php
								printf( '<h5 class="comment-user">%1$s %2$s</h5> <span class="comment-date">%3$s</span>',
									get_comment_author_link(),
									// If current post author is also comment author, make it known visually.
									( $comment->user_id === $post->post_author ) ? '<span>(' . __( 'Post author', 'twentytwelve' ) . ')</span>' : '',
									sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
										esc_url( get_comment_link( $comment->comment_ID ) ),
										get_comment_time( 'c' ),
										/* translators: 1: date, 2: time */
										sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
									)
								);
								?>
							</header><!-- .comment-meta -->

							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
							<?php endif; ?>

							<section class="comment-content comment">
								<?php comment_text(); ?>
								<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
							</section><!-- .comment-content -->
							
							<div class="post-btn">
								<ul>
									
									<li class="post-reply">
										<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
									</li>
								</ul>
								
							</div>
							
						</div><!-- #comment-## -->
					</div>
				</div>
			<?php
		break;
	endswitch; // end comment_type check
}
endif;

/************************************************************************************************************/
// Move comments fields in last
function thecorps_move_comment_form_below( $fields ) {
    $comment_field = $fields['comment']; 
    unset( $fields['comment'] ); 
    $fields['comment'] = $comment_field; 
    return $fields; 
} 
add_filter( 'comment_form_fields', 'thecorps_move_comment_form_below' );
/************************************************************************************************************/