<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area post-comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php
	if ( have_comments() ) {
		?>
		<h4 class="comments-title">
			<?php
			printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'twentytwelve' ),number_format_i18n( get_comments_number() ) );
			?>
		</h4>

		<ol class="commentlist">
			<?php
			// wp_list_comments( array( 'callback' => 'twentytwelve_comment', 'style' => 'ol' ) );
			wp_list_comments( array(
				'callback' => 'oob_comments',
				'style' => 'ol'
			) );
			?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) {
			?>
			<p class="nocomments"><?php _e( 'Comments are closed.' , 'twentytwelve' ); ?></p>
			<?php
		}
	} // have_comments()
	// comment_form();
	if ( comments_open() ){
			?>
			<section class="respond-form">
				<?php
				if ( get_option('comment_registration') && !is_user_logged_in() ){
					?>
					<div class="alert help">
						<p><?php printf( __('You must be %1$slogged in%2$s to post a comment.', 'potenzabase'), '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>' ); ?></p>
					</div>
					<?php
				}else{
					$comments_args = array(
						'class_form' => 'comment-form contact-form',
						
						'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-blue mb-30">',
						
						// change the title of send button 
						// 'label_submit'=>'Send',
						
						// change the title of the reply section
						// 'title_reply'=>'<h3 class="text-blue mb-30">Leave a Reply </h3>',
						
						// remove "Text or HTML to be displayed after the set of comment fields"
						'comment_notes_after' => '',
						
						'class_submit' => 'submit btn btn-primary',
						
						'fields' => apply_filters(
							'comment_form_default_fields', array(
								'author' => 
									'<div class="row">'.
										'<div class="col-md-6 wow fadeInLeft" data-wow-duration="1s">'.
											'<div class="form-group">'.
												'<label>Name <span class="req_field">*</span></label>'.
												'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.
											'</div>'.
										'</div>'
									,
								'email' =>
										'<div class="col-md-6 wow fadeInLeft" data-wow-duration="1s">'.
											'<div class="form-group">'.
												'<label>Email <span class="req_field">*</span></label>'.
												'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.
											'</div>'.
										'</div>',
									'</div>',
								'url' =>
									'<div class="form-group wow fadeInUp" data-wow-duration="1s">'.
										'<label>Website</label>'.
										'<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' .
									'</div>'
							)
						),
						'comment_field' =>
							'<div class="form-group wow fadeInUp" data-wow-duration="1s">'.
								'<label for="exampleInputFile">Add Your Comment</label>'.
								'<textarea id="comment" class="input-message form-control" name="comment" cols="45" rows="4" aria-required="true"></textarea>' .
							'</div>',
					);
					comment_form($comments_args);
				}
				// If registration required and not logged in
				?>
			</section>
			<?php
		} // if you delete this the sky will fall on your head
	?>

</div><!-- #comments .comments-area -->