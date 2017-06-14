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

//
// Posts Pagination (Archives)
//

/**
 * Pagination for post type archives template.
 */
function hermi_archive_pagination() {
	get_template_part( 'templates/pagination/pagination-archive' );		
}

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

/**
 * Numeric pagination via WP core function paginate_links().
 * @link http://codex.wordpress.org/Function_Reference/paginate_links
 * 
 * @param array $srgs
 *			
 * @return string HTML for numneric pagination
 */
function hermi_pagination( $args = array() ) {
	global $wp_query;
	$output = '';
	
	if ( $wp_query->max_num_pages <= 1 ) {
		return;	
	}
	
	$pagination_args = array(
		'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
		'total'        => $wp_query->max_num_pages,
		'current'      => max( 1, get_query_var( 'paged' ) ),
		'format'       => '?paged=%#%',
		'show_all'     => false,
		'type'         => 'plain',
    'end_size'     => 2,
    'mid_size'     => 1,
    'prev_next'    => true,
    //'prev_text'    => __( '&laquo; Prev', 'hermi' ),
    //'next_text'    => __( 'Next &raquo;', 'hermi' ),
    //'prev_text'    => __( '&lsaquo; Prev', 'hermi' ),
    //'next_text'    => __( 'Next &rsaquo;', 'hermi' ),
    'prev_text'    => sprintf( '<i></i> %1$s', apply_filters( 'hermi_pagination_page_numbers_previous_text',__( 'Newer Posts', 'hermi' ) ) ),
    'next_text'    => sprintf( '%1$s <i></i>', apply_filters( 'hermi_pagination_page_numbers_next_text', __( 'Older Posts', 'hermi' ) ) ),
    'add_args'     => false,
    'add_fragment' => '',
		
		// Custom arguments not part of WP core:
		'show_page_position' => false, // Optionally allows the "Page X of XX" HTML to be displayed.
	);
	
	$pagination_args = apply_filters( 'hermi_pagination_args', array_merge( $pagination_args, $args ), $pagination_args );
	
	$output .= paginate_links( $pagination_args );
	
	// Optionally, show Page X of XX.
	if ( true == $pagination_args['show_page_position'] && $wp_query->max_num_pages > 0 ) {
		$output .= '<span class="page-of-pages">' . 
									sprintf( __( 'Page %1s of %2s', 'hermi' ), $pagination_args['current'], $wp_query->max_num_pages ) .
								'</span>';
	}
	
	return $output;
}

//
// Post
//
// Also serves as default for all post types unless otherwise noted.
//

/**
 * Post title template.
 */
function hermi_post_title() {
	get_template_part( 'templates/entry-title' );
}

/**
 * Helper function to check if a post has a title.
 * 
 * @param int $post_id ID of the post to check. Checks current post if no ID is passed.
 */
function hermi_has_title( $post_id = null ) {
	global $post;
	$post_id = ( null === $post_id ) ? intval( $post->ID ) : intval( $post_id );
	$post_title = get_the_title( $post_id );
	return ( '' === trim( $post_title ) ) ? false : true;
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
 * Output a post's featured image sized according to $image_size. The image 
 * will be unlinked on singular pages and will link to the singular post when
 * viewing archives. 
 *
 * @since Hermi 0.1.0
 *
 * @param string|array $image_size WP image size to use for featured image.
 *
 */
function hermi_featured_image( $image_size = 'thumbnail' ) {
	if ( ! has_post_thumbnail() ) {
		return;
	} ?>
	
	<div class="featured-image-wrap"><?php 
		if ( is_singular() ) {
			the_post_thumbnail( $image_size );
		} else {
			printf( '<a href="%1$s">%2$s</a>',
				get_permalink(),
				get_the_post_thumbnail( get_the_ID(), $image_size )
			);
		} ?>
	</div><?php
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

/**
 * Output current post's date link.
 * 
 * @since Hermi 0.1.0
 * 
 * @param string $label used for post date link
 */
function hermi_posted_on( $label = 'Date:' ) {
	printf( '<span class="post-date-label meta-label">%1$s </span>%2$s',
		esc_html( $label ),
		hermi_published_date()
	);
} 

/**
 * Output published date with archive links for day, month, and year. (customize as needed)
 * @link http://justintadlock.com/archives/2010/08/06/linking-post-published-dates-to-their-archives
 *
 * @param bool $include_time whether published time will be appended to published date.
 * @return string post's published date
 */
function hermi_published_date( $include_time = false ) {

	// Get the day, month, and year of the current post.
	$day 		= get_the_time( 'd' );
	$month 	= get_the_time( 'm' );
	$year 	= get_the_time( 'Y' );
	$time 	= get_the_time( 'H:i' );
	$output = '';

	// Add a link to the monthly archive.
	$output .= sprintf( '<a href="%1$s" title="%2$s %3$s">%4$s</a> ',
		get_month_link( $year, $month ),
		__( 'Archive for', 'hermi' ),
		esc_attr( get_the_time( 'F Y' ) ),
		get_the_time( 'M' )
	);

	// Add a link to the daily archive.
	$output .= sprintf( '<a href="%1$s" title="%2$s %3$s">%4$s</a>',
		get_day_link( $year, $month, $day ),
		__( 'Archive for', 'hermi' ),
		esc_attr( get_the_time( 'F d, Y' ) ),
		$day
	);
	
	// Add a link to the yearly archive.
	$output .= sprintf( ', <a href="%1$s" title="%2$s %3$s">%4$s</a>',
		get_year_link( (int) $year ),
		__( 'Archive for', 'hermi' ),
		esc_attr( $year ),
		$year
	);	
	
	// Maybe add the time (typical with status updates).
	if ( true === $include_time )
		$output .= sprintf( ' %1$s %2$s ', __( 'at', 'hermi' ), $time );

	return $output;
}

/**
 * Prints current post's meta for the author.
 *
 */
function hermi_posted_by( $label = 'Author:' ) {
	printf( '
		<span class="by-author">
			<span class="sep meta-label">%1$s</span>
			<span class="author"><a class="url fn n" href="%2$s" title="%3$s" rel="author">%4$s</a></span>
		</span>',
		esc_html( $label ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'hermi' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}

/*
//This is a modified the_author_posts_link() which just returns the link. This is necessary to allow usage of the usual l10n process with printf()
// via jointswp
function hermi_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'hermi' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}
*/

/**
 * Outputs the comments meta link.
 * 
 * Note: Uses comments_popup_link() which has no way to return the output. @link http://core.trac.wordpress.org/ticket/17763
 * 
 * @param 
 */
function hermi_comments_meta( $open_wrap = '<span class="comment-meta">', $close_wrap = '</span>', $label = 'Comments:' ) {
	if ( comments_open() || ( get_comments_number() >= 1 ) ) {
		echo $open_wrap;
		
		printf( '<span class="comments-permalink-label">%1$s </span> ', $label );
		
		printf( '<span class="num-comments">%1$s </span>',
			comments_popup_link( __( '( 0 )', 'hermi' ), __( '( 1 )', 'hermi' ), __( '( % )', 'hermi' ), 'comment-count', '' )
		);
		
		echo $close_wrap;
	}
}

/**
 * Returns HTML used for permalink to post text 'Permalink'. 
 * This could be used for a post format that doesn't have a title,
 * or for when the post title is not wanted for the permalink's text.
 */
function hermi_permalink_meta() {
	global $post;
	$title_attribute = strip_tags( $post->post_title ); // Alternative to the_title_attribute() since we're not in the loop @todo ?
	$title_attribute = ( $title_attribute ) ? $title_attribute : __( '(Untitled)', 'hermi' );
	$title_attribute = sprintf( __( 'Permalink to %s', 'hermi' ), $title_attribute );

	return sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
						get_permalink( $post->ID ),
						esc_attr( $title_attribute ),
						__( 'Permalink', 'hermi' )
					);
}

/**
 * Determines if hermi_permalink_meta() should be used or not.
 *
 * @return bool true if yes, false if no
 */
function hermi_use_permalink_meta() {
	global $post;
	$post_format = get_post_format();

	if (
		'' === trim( $post->post_title )
		|| ( 'aside' 	=== $post_format )
		|| ( 'chat' 	=== $post_format && '' === trim( $post->post_title ) )
		|| ( 'link' 	=== $post_format )
		|| ( 'quote' 	=== $post_format )
		|| ( 'status' === $post_format )
	) {
		return true;
	}
	else {
		return false;
	}
}

/**
 * Return HTML for post categories meta.
 */
function hermi_post_category_meta( $args = array() ) {
	global $post;
	$defaults = array(
		'default_only_supress' => false,
		'wrap_open'            => '',
		'wrap_close'           => '',
		'label'                => __( 'Categorized:', 'hermi' ),
	);
	$args = array_merge( $defaults, $args );
	extract( $args, EXTR_SKIP );

	if ( 'post' === get_post_type() ) { // Hide category and tag text for pages on Search

		$categories_list = get_the_category_list( __( ', ', 'hermi' ) );

		/* Similar to exclude categories from get_the_category_list() ...maybe later
		foreach( ( get_the_category() ) as $category ) {
			if ( $category->name=='xxx'|| $category->name=='yyy' ) continue;
			$category_id = get_cat_ID( $category->cat_name );
			$category_link = get_category_link( $category_id );
			echo '<li><a href="'.$category_link.'">'.$category->cat_name.'</a></li>';
		}
		*/

		// For everything except for the default post formats...
		if ( false != get_post_format() ) {
			// (Optionally) supress display if the only category is the default (typically 'uncategorized').
			if ( true == $default_only_supress ) {
				if ( false === hermi_has_category_meta() )
					return false;
			}
		}

		if ( 'post' === get_post_type() ) { // Hide category and tag text for pages on Search
			// Output categories as a list of category archive links.
			if ( $categories_list ) {
				return sprintf( '
					%1$s
						<span class="cat-links"><span class="meta-label cat-links">%2$s </span> %3$s</span>
					%4$s',
					$wrap_open,
					$label,
					$categories_list,
					$wrap_close );
			}
		}
	}
}

/**
 * Helper function used to determine if category meta will need to be printed.
 *
 * (!) If the only category is the default category, it will be considered empty. This was done to allow easier, valid, and minimalist post format display handling.
 */ 
function hermi_has_category_meta() {
	global $post;
	$category_terms = wp_get_post_terms( $post->ID, 'category', array( 'hide_empty' => true, 'fields' => 'ids' ) );
	if (
			 ( count( $category_terms ) === 0 )
		|| ( count( $category_terms ) === 1 ) && ( in_array( get_option( 'default_category' ), $category_terms ) )
	) {
		return false;
	}
	else {
		return true;
	}

}

/**
 * Return HTML for post tags meta.
 */
function hermi_post_tag_meta( $args = array () ) {
	$defaults = array (
		'wrap_open' => '',
		'wrap_open' => '',
		'label' =>  __( 'Tagged:', 'hermi' ),
	);
	$args = array_merge( $defaults, $args );
	extract( $args, EXTR_SKIP );

	if ( 'post' === get_post_type() ) { // Hide category and tag text for pages on Search
		$tags_list = get_the_tag_list( '', __( ', ', 'hermi' ) );
		if ( $tags_list ) {
			return sprintf( '
				%1$s
					<span class="tag-links"><span class="meta-label tag-links">%2$s </span> %3$s</span>
				%4$s',
				$wrap_open,
				$label,
				$tags_list,
				$wrap_close );
		}
	}
}

/**
 * Helper function used to determine if tag meta will need to be printed
 */
function hermi_has_tag_meta() {
	global $post;
	$tag_terms = wp_get_post_terms( $post->ID, 'post_tag', array( 'hide_empty' => true, 'fields' => 'ids' ) );
	if ( count( $tag_terms ) >= 1 ) {
		return true;
	}
	else {
		return false;
	}
}

/**
 * Return edit post link.
 * 
 * @param string $before text to show before edit link.
 * @param string $after text to show after edit link.
 * 
 * @return string|false
 */
function hermi_get_edit_post_link( $before = '', $after = '' ) {
	$edit_post_link = get_edit_post_link();
	
	if ( $edit_post_link ) {
		return sprintf( '%1$s<a class="edit-link" href="%2$s"><i></i> %3$s</a>%4$s',
			wp_kses_post( $before ),
			esc_url( $edit_post_link ),
			__( 'Edit', 'hermi' ),
			wp_kses_post( $after )
		);
	}
	
	return;
}


/**
 * Template helper function that returns the current post's format name.
 * If were dealing regular posts, or posts with no format, return the string set by $no_format.
 * 
 * @param string $no_format Name to use for posts with no format.
 *
 * @return string format name
 */ 
function hermi_get_post_format_name( $no_format = '' ) {
	$format            = get_post_format();
	$supported_formats = get_theme_support( 'post-formats' );
	
	// Supported formats will be returned as the first key in a multi dimensional array by get_theme_support().
	// Simplify this so that it's just an array of the supported formats, or false, if there are none.
	$supported_formats = ( isset( $supported_formats[0] ) && is_array( $supported_formats[0] ) ) ? $supported_formats[0] : false;
	
	if ( false !== $format && is_array( $supported_formats ) && in_array( $format, $supported_formats ) ) {
		$format = $format;
	} else {
		$format = $no_format;
	}
	
	return $format;
}

/**  
 * Returns HTML used to display Post Format meta.
 */
function hermi_post_format_meta() {
	if ( 'post' !== get_post_type() ) {
		return;
	}
	
	$post_format = get_post_format();
	return sprintf( '<span>%1$s</span> <a class="post-format-archive-link %2$s" href="%3$s">%2$s</a>',
		__( 'Format:', 'hermi' ),
		$post_format,
		get_post_format_link( $post_format )
	);
}

/**  
 * Returns Post Format archive link HTML (all asides, images, quoutes, etc).
 */
function hermi_get_post_format_archive_link() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	$post_format = get_post_format();
	return sprintf( '<a class="post-format-archive-link %1$s" href="%2$s">%1$s</a>',
		$post_format,
		get_post_format_link( $post_format )
	);
}

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
// Excerpts
//
 
/**
 * Replaces "[...]" appended to automatically generated excerpts with an ellipsis and hermi_read_more_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function assinged to the excerpt_more filter.
 */
function hermi_auto_excerpt_more( $more ) {
	return ( is_search() ) ? '&hellip;' : '&hellip;' . hermi_read_more_link();
}

/**
 * Adds a pretty "Read More" link to customized post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @param
 *
 */
function hermi_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() /*&& ! is_search()*/ ) {
		$output .= hermi_read_more_link();
	}

	return $output;
}

/**
 * Returns a Read More link for excerpts
 *
 * Here are some handy HTML entities for various arrows:
 * 	&gt; 			greater-than sign
 * 	&raquo; 	right-pointing double angle quotation mark
 * 	&rsaquo; 	single right-pointing angle quotation mark
 * 	&rarr; 		rightwards arrow
 * 	&rArr; 		rightwards double arrow
 */
function hermi_read_more_link() {
	// Wrapper helps fix problems with floated link on search pages.
	return sprintf( '<div class="read-more-wrap"><a href="%1$s" class="more-link">%2$s</a></div>',
									 get_permalink(),
									 __( 'Read More &rsaquo;', 'hermi' )
	);
}

//
// Post Pagination (Singular)
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
// Post Pagination (content split by <!--nextpage-->)
//

/**
 * Set the arguments that passed to wp_link_pages() throughout the theme.
 */
function hermi_wp_link_pages_args( $args ) {
	$args['before'] = '<div class="page-link">' . sprintf( '<span>%s </span>', __( 'Pages:', 'hermi' ) );
	$args['after']  = '</div>';
	
	return $args;
}

//
// Attachments
//

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

/**
 * Gets the link to the next gallery image when viewing a single gallery page.
 *
 *	-	The next image, under normal conditions
 *	-	The first image, if viewing the last image
 *	-	If there is only one image, a disabled control stating that this is the only image in the gallery.
 *
 *	-	The previous image, under normal conditions
 *	-	The last image, if viewing the first image
 *	-	If there is only one image, a disabled control stating that this is the only image in the gallery.
 *
 */
function hermi_get_gallery_nav_info() {
	global $post;
	$gallery_links = array (
										'current' => '',
										'count'   => '',
										'next' => array (
											'url' 				=> '',
											'title' 			=> '',
											'title_attr' 	=> '',
											'id' 					=> '',
											'will_loop' 	=> false, // true if we are viewing the last image, and this link takes us to the begining
										),
										'previous' 			=> array (
											'url' 				=> '',
											'title' 			=> '',
											'title_attr' 	=> '',
											'id' 					=> '',
											'will_loop' 	=> false, // true if we are viewing the first image, and this link takes us to the end
										),
									);

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file.
	 */
	$attachments = array_values( get_children( array (
			'post_type' 			=> 'attachment',
			'post_mime_type' 	=> 'image',
			'post_parent' 		=> $post->post_parent,
			'post_status' 		=> 'inherit',
			'order' 					=> 'ASC',
			'orderby' 				=> 'menu_order ID',
		)	)
	);

	// Populate the value of the current attachment.
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID ) {
			$gallery_links['current'] = $k + 1;
			break;
		}
	}

	// Populate the value of the attachment count.
	$attachments_count 			= count( $attachments );
	$gallery_links['count'] = (int) $attachments_count;

	// Populate the values of the next and previous items...
	// If there is more than 1 attachment in a gallery
	if ( $attachments_count > 1 ) {
		// Next Attachment Link - Next item, if it exists.
		if ( isset ( $attachments[ $k + 1 ] ) ) {
			$gallery_links['next']['url'] 				= get_attachment_link( $attachments[ $k + 1 ]->ID );
			$gallery_links['next']['title'] 			= get_the_title( $attachments[ $k + 1 ]->ID );
			$gallery_links['next']['title_attr'] 	= wptexturize( $gallery_links['next']['title'] );
			$gallery_links['next']['id'] 					= $attachments[ $k + 1 ]->ID;
			$gallery_links['next']['will_loop'] 	= false;
		}
		else { // Next Attachment Link - We're at the end. Get the info for the very first item so we can loop around.
			$gallery_links['next']['url'] 				= get_attachment_link( $attachments[0]->ID );
			$gallery_links['next']['title'] 			= get_the_title( $attachments[0]->ID );
			$gallery_links['next']['title_attr'] 	= sprintf( '%1$s %2$s', __( '(Go to beginning)', 'hermi' ), wptexturize( $gallery_links['next']['title'] ) );
			$gallery_links['next']['id'] 					= $attachments[0]->ID;
			$gallery_links['next']['will_loop'] 	= true;
		}

		// Previous Attachment Link - Previous item, if it exists.
		if ( isset ( $attachments[ $k - 1 ] ) ) {
			$gallery_links['previous']['url'] 				= get_attachment_link( $attachments[ $k - 1 ]->ID );
			$gallery_links['previous']['title'] 			= get_the_title( $attachments[ $k - 1 ]->ID );
			$gallery_links['previous']['title_attr'] 	= wptexturize( $gallery_links['previous']['title'] );
			$gallery_links['previous']['id'] 					= $attachments[ $k - 1 ]->ID;
			$gallery_links['previous']['will_loop'] 	= false;
		}
		else { // Previous Attachment Link - We're at the beginning. Get the info for the very last item so we can navigate backwards from the end.
			$gallery_links['previous']['url'] 				= get_attachment_link( $attachments[ $attachments_count - 1 ]->ID );
			$gallery_links['previous']['title'] 			= get_the_title( $attachments[ $attachments_count - 1 ]->ID );
			$gallery_links['previous']['title_attr'] 	= sprintf( '%1$s %2$s ', __( '(Go to end)', 'hermi' ), wptexturize( $gallery_links['previous']['title'] ) );
			$gallery_links['previous']['id'] 					= $attachments[ $attachments_count - 1 ]->ID;
			$gallery_links['previous']['will_loop'] 	= true;
		}
	}
	else { // If there's only 1 image, return false.
		$gallery_links = false;
	}

	return $gallery_links;
}

//
// Comments
//

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
 */
function hermi_get_cancel_comment_reply_link( $link, $text ) {
	$new_text = sprintf( '<span class="mdi-close"></span>' ); 
	$new_link = esc_html( remove_query_arg( 'replytocom' ) ) . '#respond';
	$style    = isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"';
	
	return '<a rel="nofollow" id="cancel-comment-reply-link" href="' . $new_link . '"' . $style . '>' . $new_text . '</a>';
}

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

/**
 * Return the default comment form fields.
 * 
 * (Not used. Left in as example.)
 * 
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
