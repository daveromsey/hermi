<?php
/**
 * This file contains template tags.
 * 
 */
 
/**
 * Output a post's featured image sized according to $image_size. The image 
 * will be unlinked on singular pages and will link to the singular post when
 * viewing archives. 
 *
 * @param string|array $image_size WP image size to use for featured image.
 *
 * @package Hermi
 * @since Hermi 0.1.0
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


/**
 * Retun an edit post link.
 * 
 * @param string $before text to show before edit link.
 * @param string $after text to show after edit link.
 * 
 * @return string | false
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
 * Prints current post's date link.
 * @since Hermi 0.1.0
 *
 */
function hermi_posted_on( $label = 'Date:' ) {
	printf( '<span class="post-date-label meta-label">%1$s </span>%2$s',
		esc_html( $label ),
		hermi_published_date()
	);
}


/**
 * Output published date with archive links for day, month, and year. (customize as needed)
 * Via: @link http://justintadlock.com/archives/2010/08/06/linking-post-published-dates-to-their-archives
 * Create your own hermi_posted_on() to override in a child theme
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
 * @since twentysixhundred 1.0
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


// Note: comments_popup_link(), which this function uses, has no way to return the output. @link http://core.trac.wordpress.org/ticket/17763
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
 *
 * @since twentysixhundred 1.0
 *
 */
function hermi_permalink_meta() {
	global $post;
	$title_attribute = strip_tags( $post->post_title ); // Alternative to the_title_attribute() since we're not in the loop @todo ?
	$title_attribute = ( $title_attribute ) ? $title_attribute : __( '{Untitled}', 'hermi' ) ;
	$title_attribute = sprintf( __( 'Permalink to %s', 'hermi' ), $title_attribute );

	return sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
						get_permalink( $post->ID ),
						esc_attr( $title_attribute ),
						__( 'Permalink', 'hermi' )
					);
}


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


function hermi_post_tags_meta( $args = array () ) {
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


function hermi_get_post_format_arhive_link() {
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
 *
 *
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
 * Pagination
 * ----------------------------------------------------------------------------
 */ 
 
/**
 * Numeric pagination via WP core function paginate_links().
 * @link http://codex.wordpress.org/Function_Reference/paginate_links
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
