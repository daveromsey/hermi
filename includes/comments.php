<?php
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * Override this walker using the hermi_list_comments_callback_name filter.
 *
 * @since Hermi 0.1.0
 */
function hermi_list_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>
			<?php _e( 'Pingback:', 'hermi' ); ?>
			<?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'hermi' ), ' ' ); ?>
		</p>
	<?php
			break;
		default :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<header class="comment-meta">
				<div class="comment-author vcard">
					<div class="avatar">
						<?php
							// Output avatar image. The size of top level and child avatars can be set independently.
							$avatar_size = apply_filters( 'hermi_comment_avatar_size_top_level', 60 );

							if ( '0' != $comment->comment_parent ) {
								$avatar_size = apply_filters( 'hermi_comment_avatar_size_child', 60 );
							}
							echo get_avatar( $comment, $avatar_size );
						?>
					</div><!-- .avatar -->

					<div class="links">
						<?php
							printf( __( '%1$s %2$s%3$s at %4$s%5$s', 'hermi' ),
								sprintf( '<div class="fn">%s</div>',
													get_comment_author_link()
								),
								'<a class="published-date" href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . 
										'<time pubdate datetime="' . esc_attr( get_comment_time( 'c' ) ) . '">',
								esc_html( get_comment_date() ),
								esc_html( get_comment_time() ),
								'</time><i></i></a>'
							);

							// See hermi_comment_moderation_links(). We're outputting spam and delete links here too.
							if ( current_user_can( 'edit_post', $post->ID ) ) {
								edit_comment_link( __( 'Edit', 'hermi' ), ' ' );
							}
						?>
					</div><!-- .links -->
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) { ?>
					<em class="comment-awaiting-moderation">
						<?php _e( 'Your comment is awaiting moderation.', 'hermi' ); ?>
					</em><br />
				<?php } ?>
			</header><!-- .comment-meta -->


			<div class="comment-body">
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>

				<div class="reply-link-wrap">
					<?php
						comment_reply_link( array_merge( $args, [
							'reply_text' => __( 'Reply', 'hermi' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						] ) );
					?>
				</div><!-- .reply-link-wrap -->
			</div><!-- .comment-body -->

		</article><!-- #comment-## -->

	<?php
		break;
	endswitch;
}

/**
 * Cancel comment reply link markup.
 */
add_filter( 'cancel_comment_reply_link', 'hermi_get_cancel_comment_reply_link', 10, 2 ); 
function hermi_get_cancel_comment_reply_link( $link, $text ) {
	$new_link = remove_query_arg( 'replytocom' ) . '#respond';
	$close_button = '<span class="mdi-close"></span>';
	$style    = isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"';

	return '<a rel="nofollow" id="cancel-comment-reply-link" href="' . 
						esc_url( $new_link ) . '"' . $style . '>' . $close_button . '</a>';
}

/**
 * Adds Spam and Delete links to the Edit link.
 *
 * @wp-hook edit_comment_link
 * @param   string  $edit_link Edit link markup
 * @param   int $comment_id Comment ID
 * @return  string
 */
add_filter( 'edit_comment_link', 'hermi_comment_moderation_links', 10, 2 ); 
function hermi_comment_moderation_links( $edit_link, $comment_id ) {
	$template  = '<a class="comment-edit-link destructive" href="%1$s%2$s">%3$s</a>';
	$sep       = '<span class="separator"></span>';
	$admin_url = admin_url( "comment.php?c={$comment_id}&action=" );

	// Edit comment
	$comment_moderation_links = $edit_link;

	// Add separator
	$comment_moderation_links .= $sep;

	// Mark as spam
	$comment_moderation_links .= sprintf( $template,
																	esc_url( $admin_url ),
																	'cdc&dt=spam',
																	esc_html( __( 'Spam', 'hermi' ) )
															 );

	// Add separator
	$comment_moderation_links .= $sep;

	// Delete comment
	$comment_moderation_links .= sprintf( $template,
																	esc_url( $admin_url ),
																	'cdc',
																	esc_html( __( 'Delete', 'hermi' ) )
															 );

	return "<div class='comment-moderation-links'>" . wp_kses_post( $comment_moderation_links ) . "</div>";
}

/**
 * Return the default comment form fields.
 *
 * (Not used. Leaving commented code as example.)
 */
// add_filter( 'comment_form_default_fields', 'hermi_comment_form_default_fields' );
function hermi_comment_form_default_fields( $fields ) {
	$commenter     = wp_get_current_commenter();
	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$req           = get_option( 'require_name_email' );
	$aria_req      = ( $req ? " aria-required='true'" : '' );

	$fields = [
		'author' => '<p class="comment-form-author">' .
									'<label for="author">' . __( 'Name *', 'hermi' ) . '</label>' .
									'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
									 ( $req ? '<span class="required">(required)</span>' : '' ) .
								'</p>',

		'email'  => '<p class="comment-form-email">' .
									'<label for="email">' . __( 'E-mail *', 'hermi' ) . '</label> <small>(never published) </small>' .
									'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
									( $req ? '<span class="required">(required)</span>' : '' ) .
								'</p>',

		'url'    => '<p class="comment-form-url">' .
									'<label for="url">' . __( 'Website', 'hermi' ) . '</label>' .
									'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />' .
								'</p>',
	];

	return $fields;
}
