<?php
/**
 * Functions for the templating system.
 * 
 * @package Hermi/Template/Functions
 */

//
// Menus
// 
 
/**
 * Starting portion of Off Canvas menu template.  
 */
function hermi_off_canvas_start() {
	get_template_part( 'templates/navigation/off-canvas/off-canvas', 'start' );
}

/**
 * Ending portion of Off Canvas menu template.  
 */
function hermi_off_canvas_end() {
	get_template_part( 'templates/navigation/off-canvas/off-canvas', 'end' );
}

/**
 * Top Bar for WP Dropdown menu template (menus are included separately).
 */
function hermi_dropdown_nav_top_bar() {
	get_template_part( 'templates/navigation/hermi-dropdown-nav/hermi-dropdown-nav-top-bar' );
}

/**
 * Secondary WP Dropdown menu template.
 */
function hermi_dropdown_nav_secondary_template() {
	get_template_part( 'templates/navigation/hermi-dropdown-nav/hermi-dropdown-nav-secondary' );
}

/**
 * Primary WP Dropdown menu template.
 */
function hermi_dropdown_nav_primary_template() {
	get_template_part( 'templates/navigation/hermi-dropdown-nav/hermi-dropdown-nav-primary' );
}

/**
 * Top Bar and Foundation Dropdown Menu template (includes menu).
 */
function hermi_foundation_dopdown_menu_top_bar() {
	get_template_part( 'templates/navigation/foundation-dropdown-menu/foundation-dopdown-top-bar' );
}

/**
 * 'Skip to content' link template. Used to allow skipping menus for accessibility.
 */
function hermi_skip_to_content() {
	get_template_part( 'templates/accessibility/skip-to-content' );
}

//
// Posts
//

/**
 * Heading for various post type archives template.
 */
function hermi_archive_heading() {
	get_template_part( 'templates/post/archive/heading' );
}

/**
 * Sticky post (aka Featured post) template part.
 */
function hermi_post_sticky() {
	get_template_part( 'templates/post/archive/entry-sticky' );
}

/**
 * Change WordPress's .sticky class to .wp-sticky to prevent a conflict with Foundation.
 *
 * @param array $classes post class names
 * @return array
 */
function hermi_sticky_post_class( $classes ) {
	if ( in_array( 'sticky', $classes ) ) {
		$classes   = array_diff( $classes, [ 'sticky' ] );
		$classes[] = 'wp-sticky';
	}
	
	return $classes;
}

/**
 * Pagination for post type archives template.
 */
function hermi_archive_pagination() {
	get_template_part( 'templates/pagination/pagination-archive' );		
}

//
// Post (Also serves as default for all post types)
//

/**
 * Post title template.
 */
function hermi_post_title() {
	get_template_part( 'templates/entry-title' );
}

/**
 * Post featured image template.
 */
function hermi_post_featured_image() {
	if ( ! is_search() ) {
		get_template_part( 'templates/entry-featured-image' );
	}
}

/**
 * Opening <header> tag for post entry.
 */
function hermi_entry_header_open() {
	get_template_part( 'templates/entry-header-open' );
}

/**
 * Closing </header> tag for post entry.
 */
function hermi_entry_header_close() {
	get_template_part( 'templates/entry-header-close' );
}

/**
 * Opening <footer> tag for post entry.
 */
function hermi_entry_footer_open() {
	get_template_part( 'templates/entry-footer-open' );
}

/**
 * Closing </footer> tag for post entry.
 */
function hermi_entry_footer_close() {
	get_template_part( 'templates/entry-footer-close' );
}

//
// Post only
//

/**
 * Output for primary meta location for posts.
 * For example: post date, author, comments link
 */
function hermi_post_meta_primary() {
	if ( 'post' === get_post_type() ) {
		get_template_part( 'templates/post/entry-meta-primary' );
	}
}

/**
 * Output for secondary meta location for posts.
 * For example: post categories, post tags
 */
function hermi_post_meta_secondary() {
	if ( 'post' === get_post_type() ) {
		get_template_part( 'templates/post/entry-meta-secondary' );
	}
}

//
// Site Footer
//

/**
 * Footer widgets template.
 */
function hermi_footer_widgets() {
	get_template_part( 'templates/footer/footer-widgets' );
}

/**
 * Footer navigation template.
 */ 
function hermi_footer_nav() {
	get_template_part( 'templates/footer/footer-nav' );
}

/**
 * Copyright template.
 */ 
function hermi_footer_copyright() {
	get_template_part( 'templates/footer/footer-copyright' );
}

//
// Pagination - Archives
//
 
/**
 * Add HTML class to next posts links.
 */
function hermi_next_posts_link_attributes() {
	return 'class="next"';
}

/**
 * Add HTML class to previous posts links.
 */
function hermi_previous_posts_link_attributes() {
	return 'class="prev"';
}

//
// Pagination - Singular
//
 
/**
 * Add a title attribute to the link output by next_post_link().
 */
function hermi_next_post_link( $adjacent ) {
	return str_replace( '<a ', sprintf( '<a title="%s" ', __( 'Newer posts', 'hermi' ) ), $adjacent );
}

/**
 * Add a title attribute to the link output by previous_post_link().
 */
function hermi_previous_post_link( $adjacent ) {
	return str_replace( '<a ', sprintf( '<a title="%s" ', __( 'Older posts', 'hermi' ) ), $adjacent );
}
 
//
// Pagination - Paged post
//

/**
 * Set the arguments that passed to wp_link_pages() throughout the theme.
 */
function hermi_wp_link_pages_args( $args ) {
	$args['before'] = '<div class="page-link">' . sprintf( '<span>%s </span>', __( 'Pages:', 'hermi' ) );
	$args['after']  = '</div>';
	
	return $args;
}




/**
 * General Template Stuff
 * ----------------------------------------------------------------------------
 */


//
// Excerpts
//
 
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and hermi_read_more_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function hermi_auto_excerpt_more( $more ) {
	return ( is_search() ) ? '&hellip;' : '&hellip;' . hermi_read_more_link();
}
add_filter( 'excerpt_more', 'hermi_auto_excerpt_more' );

/**
 * Adds a pretty "Read More" link to customized post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function hermi_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() /*&& ! is_search()*/ ) {
		$output .= hermi_read_more_link();
	}

	return $output;
}
add_filter( 'get_the_excerpt', 'hermi_custom_excerpt_more' );





/**
 * Attachments
 * ----------------------------------------------------------------------------
 */
 
/**
 * Force comments to be closed on attachment pages. 
 */	
function hermi_attachments_disable_comments( $open, $post_id ) {
	$post = get_post( $post_id );
	if ( $post->post_type == 'attachment' ) {
		return false;
	}
	
	return $open;
}
add_filter( 'comments_open', 'hermi_attachments_disable_comments', 10 , 2 );


/**
 * Comments
 * ----------------------------------------------------------------------------
 */

/**
 * Output comment pagination links.
 * 
 * @package Hermi
 * @since Hermi 0.1.0
 */
function hermi_comment_nav_links() { ?>
	<div class="comment-nav-previous">
		<?php previous_comments_link( sprintf( '<i></i> %1$s', apply_filters( 'hermi_previous_comments_link_text', __( 'Older Comments', 'hermi' ) ) ) ); ?>
	</div>
	
	<div class="comment-nav-next">
		<?php next_comments_link( sprintf( '%1$s <i></i>', apply_filters( 'hermi_next_comments_link_text',__( 'Newer Comments', 'hermi' ) ) ) ); ?>
	</div><?php
}


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
		<p><?php _e( 'Pingback:', 'hermi' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'hermi' ), ' ' ); ?></p>
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
								sprintf( '<span class="fn">%s</span>',
									get_comment_author_link()
								),
								'<a class="published-date" href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '"><time pubdate datetime="' . get_comment_time( 'c' ) . '">',
								get_comment_date(),
								get_comment_time(),
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
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'hermi' ); ?></em><br />
				<?php } ?>
				
			</header><!-- .comment-meta -->
			
			
			<div class="comment-body">	
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
				
				<div class="reply-link-wrap">
					<?php 
						comment_reply_link( array_merge( $args, array(
							'reply_text' => __( 'Reply', 'hermi' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						) ) );
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
 * 
 */
function hermi_get_cancel_comment_reply_link( $link, $text ) {
	$new_text = sprintf( '<span class="mdi-close"></span>' ); 
	$new_link = esc_html( remove_query_arg( 'replytocom' ) ) . '#respond';
	$style    = isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"';
	
	return '<a rel="nofollow" id="cancel-comment-reply-link" href="' . $new_link . '"' . $style . '>' . $new_text . '</a>';
}
add_filter( 'cancel_comment_reply_link', 'hermi_get_cancel_comment_reply_link', 10, 2 );


/**
 * Adds Spam and Delete links to the Edit link.
 *
 * @wp-hook edit_comment_link
 * @param   string  $edit_link Edit link markup
 * @param   int $comment_id Comment ID
 * @return  string
 */
function hermi_comment_moderation_links( $edit_link, $comment_id ) {
		$template  = '<a class="comment-edit-link destructive" href="%1$s%2$s">%3$s</a>';
		$sep       = '<span class="separator"></span>';
		$admin_url = admin_url( "comment.php?c={$comment_id}&action=" );
		
		// Edit comment
		$comment_moderation_links = $edit_link . $sep;
		 
		// Mark as spam
		$comment_moderation_links .= sprintf( $template, $admin_url, 'cdc&dt=spam', __( 'Spam', 'hermi' ) );
		$comment_moderation_links .= $sep;
		
		// Delete comment
		$comment_moderation_links .= sprintf( $template, $admin_url, 'cdc', __( 'Delete', 'hermi' ) );

		return "<div class='comment-moderation-links'>{$comment_moderation_links}</div>";
}
add_filter( 'edit_comment_link', 'hermi_comment_moderation_links', 10, 2 );


/**
 * (Not used. Left in as example.)
 * 
 * Return the default comment form fields.
 */
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
// add_filter( 'comment_form_default_fields', 'hermi_comment_form_default_fields' );


