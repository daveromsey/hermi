<?php
/**
 * Functions that output HTML or alter the output HTML.
 */
 
/**
 * Change WordPress's .sticky class to .wp-sticky to prevent a conflict with Foundation.
 *
 * @param array $classes An array of post classes.
 * @param array $class   An array of additional classes added to the post.
 * @param int   $post_id The post ID.
 *
 * @return array
 */
add_filter( 'post_class', 'hermi_sticky_post_class', 10, 3 );
function hermi_sticky_post_class( $classes ) {
	if ( in_array( 'sticky', $classes ) ) {
		$classes   = array_diff( $classes, [ 'sticky' ] );
		$classes[] = 'wp-sticky';
	}

	return $classes;
}

//
// Featured Image
//

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
				esc_url( get_permalink() ),
				get_the_post_thumbnail( get_the_ID(), $image_size )
			);
		} ?>
	</div><?php
}

//
// Excerpts
//

/**
 * Generated excerpts.
 * Handle excerpt more. E.g. "[...]" or "...Read More" after generated excerpt.
 */
add_filter( 'excerpt_more', 'hermi_auto_excerpt_more' );
function hermi_auto_excerpt_more( $more ) {
	return ( is_search() ) ? '&hellip;' : '&hellip;' . hermi_read_more_link();
}

/**
 * Customized excerpts.
 * Adds a pretty "Read More" link to customized post excerpts.
 */
add_filter( 'get_the_excerpt', 'hermi_custom_excerpt_more' );
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
	// Wrapper helps to fix problems with floated link in certain cases.
	return sprintf( '<span class="read-more-wrap"><a href="%1$s" class="more-link">%2$s</a></span>',
									 esc_url( get_permalink() ),
									 esc_html__( 'Read More &rsaquo;', 'hermi' )
	);
}

//
// Post Pagination (content split by <!--nextpage-->)
//

/**
 * Set the arguments that passed to wp_link_pages() throughout the theme.
 */
add_filter( 'wp_link_pages_args', 'hermi_wp_link_pages_args' );
function hermi_wp_link_pages_args( $args ) {
	$args['before']  = '<div class="page-link">';
	$args['before']	.= sprintf( '<span>%s </span>', esc_html__( 'Pages:', 'hermi' ) );
	
	$args['after']  = '</div>';

	return $args;
}

//
// Post Meta (date, author, categories, etc)
//

/**
 * Output published date with links to day, month, and year archives.
 * @link http://justintadlock.com/archives/2010/08/06/linking-post-published-dates-to-their-archives
 *
 * @param bool $include_time whether published time will be appended to published date.
 *
 * @return string post's published date
 */
function hermi_get_published_date( $include_time = false ) {

	// Get the day, month, and year of the current post.
	$day 		= get_the_time( 'd' );
	$month 	= get_the_time( 'm' );
	$year 	= get_the_time( 'Y' );
	$time 	= get_the_time( 'H:i' );
	$output = '';

	// Add a link to the monthly archive.
	$output .= sprintf( '<a href="%1$s" title="%2$s %3$s">%4$s</a> ',
		esc_url( get_month_link( $year, $month ) ),
		esc_html__( 'Archive for', 'hermi' ),
		esc_attr( get_the_time( 'F Y' ) ),
		esc_html( get_the_time( 'M' ) )
	);

	// Add a link to the daily archive.
	$output .= sprintf( '<a href="%1$s" title="%2$s %3$s">%4$s</a>',
		esc_url( get_day_link( $year, $month, $day ) ),
		esc_html__( 'Archive for', 'hermi' ),
		esc_attr( get_the_time( 'F d, Y' ) ),
		esc_html( $day )
	);

	// Add a link to the yearly archive.
	$output .= sprintf( ', <a href="%1$s" title="%2$s %3$s">%4$s</a>',
		esc_url( get_year_link( (int) $year ) ),
		esc_html__( 'Archive for', 'hermi' ),
		esc_attr( $year ),
		esc_html( $year )
	);

	// Maybe add the time (typical with status updates).
	if ( true === $include_time ) {
		$output .= sprintf( ' %1$s %2$s ',
									esc_html__( 'at', 'hermi' ),
									esc_html( $time )
							 );
	}
	
	return $output;
}

/**
 * Get current post's author archive link.
 *
 * @return string
 */
function hermi_get_post_author_link() {
	return sprintf( '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'hermi' ), esc_attr( get_the_author() ) ),
		esc_html( get_the_author() )
	);
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
						esc_url( get_permalink( $post->ID ) ),
						esc_attr( $title_attribute ),
						esc_html__( 'Permalink', 'hermi' )
					);
}

/**
 * Return HTML for post categories meta.
 */
function hermi_get_post_category_meta( $args = array() ) {
	$defaults = [
		'default_only_supress' => false,
	];
	$args = array_merge( $defaults, $args );
	extract( $args, EXTR_SKIP );

	$categories_list = get_the_category_list( _x( ', ', 'post meta category list separator', 'hermi' ) );

	// For everything except for the default post formats...
	if ( false != get_post_format() ) {
		// (Optionally) supress display if the only category is the default (typically 'uncategorized').
		if ( true == $default_only_supress ) {
			if ( false === hermi_has_category_meta() ) {
				return false;
			}
		}
	}

	// Return categories as a list of category archive links
	if ( $categories_list ) {
		return $categories_list;
	}
	
	return false;
}

/**
 * Return HTML for post tags meta.
 */
function hermi_get_post_tag_meta() {
	$tags_list = get_the_tag_list( '', _x( ', ', 'post meta tag list separator', 'hermi' ) );
	if ( $tags_list ) {
		return $tags_list;
	}

	return false;
}

/**
 * Returns HTML used to display Post Format meta.
 */
function hermi_post_format_meta() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	$post_format = get_post_format();
	return sprintf( '<span>%1$s</span> <a class="post-format-archive-link %2$s" href="%3$s">%4$s</a>',
		esc_html__( 'Format:', 'hermi' ),
		sanitize_html_class( $post_format ),
		esc_url( get_post_format_link( $post_format ) ),
		esc_html( $post_format )
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
	return sprintf( '<a class="post-format-archive-link %1$s" href="%2$s">%3$s</a>',
		sanitize_html_class( $post_format ),
		esc_url( get_post_format_link( $post_format ) ),
		esc_html( $post_format )
	);
}
