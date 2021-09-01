<?php
/**
 * The template for displaying comments
 *
 * @package WordPress
 * @subpackage Apex
 */


if ( post_password_required() )
	return;
?>

<?php if( comments_open() || have_comments() ) { ?>
	
	<div id="comments" class="clearfix">
	
		<a href="#" class="entry-comments"><i class="apex-icon-speech-bubble-1"></i><?php comments_number(); ?></a>

		<?php
		// If there are comments
		if ( have_comments() ) {
			?>
			<div id="commentscontainer">

				<ol class="commentlist">
					<?php wp_list_comments( array( 'callback' => 'apex_comment' ) ); ?>
				</ol>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>

					<nav id="comment-nav">
					<h1 class="assistive-text"><?php _e( 'Comment navigation', 'apex' ); ?></h1>
					<?php
					// Get the user defined page structure
					$structure = get_option( 'permalink_structure' );
					$format = empty( $structure ) ? '&page=%#%' : 'page/%#%/';
					$args = array(
						'prev_next' => false,
						'type' => 'list',
						'echo' => false
					);
					echo paginate_comments_links( $args );
					?>
					</nav>
				<?php } ?>
			</div>
			<?php

			/* If there are no comments and comments are closed, let's leave a little note, shall we?
			 * But we don't want the note on pages or post types that do not support comments.
			 */
			if ( ! comments_open() && get_comments_number() ) { ?>
				<p class="nocomments"><?php _e( 'Comments are closed.', 'apex' ); ?></p>
			<?php
			}
		}

		/**
		 * Setup the comment form
		 *
		 * @since 1.0
		 */
		$author = '<div class="form-group"><input id="author" class="form-control" name="author" type="text" placeholder="'.__( 'Your name', 'apex' ).'*" value="' . esc_attr( $commenter['comment_author'] ) . '" aria-required="true" /></div>';
		$email = '<div class="form-group"><input id="email" class="form-control" name="email" type="text" placeholder="'.__( 'Your email', 'apex' ).'*" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div>';
		$url = '<div class="form-group"><input id="url" class="form-control" name="url" type="text" placeholder="'.__( 'Your website', 'apex' ).'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>';
		$fields =  array(
			'author' => $author,
			'email' => $email,
			'url' => $url
		);
		$comment_field = '<div class="form-group"><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" placeholder="'.__( 'Your message', 'apex' ).'" aria-required="true"></textarea></div>';

		// Set the arguments
		$args = array (
			'fields' => $fields,
			'comment_field' => $comment_field,
			'label_submit' => __( 'Submit', 'apex' ),
			'title_reply' => __( 'Leave a Comment', 'apex' ),
			'comment_notes_before' => '<p class="comment-notes">'.__( 'Your email address will not be published. Required fields are marked *', 'apex' ).'</p>',
			'comment_notes_after' => '',
			'cancel_reply_link' => __( 'Cancel', 'apex' )
		);

		// Display the comment form
		comment_form( $args, get_the_ID() );
		?>

	</div>

<?php } ?>


