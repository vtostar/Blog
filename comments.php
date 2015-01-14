<?php
/**
 * The template for displaying Comments.
 *
 * @package classPlus
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php comments_number( __('No Comments', 'twenty-theme'), __('1 Comment', 'twenty-theme'), __('% Comments', 'twenty-theme') ); ?>
		</h3>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use classPlus_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define classPlus_comment() and that will be used instead.
				 * See classPlus_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'classPlus_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div class="comment-pagination">
		 	<?php 
		 		$args = array(
		 			'prev_text' => __('&larr; Older Comments', 'twenty-theme'), 
		 			'next_text' => __('Newer Comments &rarr;', 'twenty-theme')
		 		);
		 		paginate_comments_links( $args );
	 		?> 
		 </div>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'twenty-theme' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args = array(
			'title_reply' => __( 'Comment', 'twenty-theme' ),
			'comment_notes_before' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Content" rows="2" aria-required="true"></textarea></p>',
			'comment_notes_after' => '',
			'comment_field' => '',
			'must_log_in' => '<p class="must-log-in alert">' .  sprintf( __( 'You must <a href="%s">log in</a> to post a comment.', 'twenty-theme' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'logged_in_as' => ''
	
			. '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Content" rows="2" aria-required="true"></textarea></p>',
			'label_submit' => __( 'Submit', 'twenty-theme' ),
			'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<p class="comment-form-author">' . '<input id="author" name="author" placeholder="Name *" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><i class="icon-user"></i></p>',
			'email' => '<p class="comment-form-email">' . '<input id="email" name="email" placeholder="Email *" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><i class="icon-envelope"></i></p>') )
		); 
		comment_form($args); 
	?>

</div><!-- #comments -->
