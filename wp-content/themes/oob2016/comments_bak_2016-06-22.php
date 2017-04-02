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

<div class="post-comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h4 class="wow fadeInUp" data-wow-duration="1s">
			<?php
					printf( _n( 'One thought on', '%1$s comments ', get_comments_number(), 'twentytwelve' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h4>
			<div class="row">
              <div class="col-sm-12 wow fadeInUp" data-wow-duration="1s">
                <div class="post-panel">
                  <figure class="thumbnail"><img src="images/user-img.jpg" class="img-circle"></figure>
                  <div class="panel-body">
                    <header>
                      <h5 class="comment-user">John Deo</h5>
                      <time class="comment-date">April 6, 2016  8:00 am</time>
                    </header>
                    <div class="comment-post">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et hendrerit augue. </p>
                    </div>
                    <div class="post-btn">
                      <ul>
                        <li class="post-reply"><a href="#">Reply</a></li>
                        <li class="post-comment"><a href="#">1 Comments</a></li>
                      </ul>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>


		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'twentytwelve_comment', 'style' => 'ol' ) ); ?>
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
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'twentytwelve' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->