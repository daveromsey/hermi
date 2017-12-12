<?php
//
// Post Pagination (Singular)
//

/**
 * Add a title attribute to the link output by next_post_link().
 */
add_filter( 'next_post_link', 'hermi_next_post_link' );
function hermi_next_post_link( $adjacent ) {
	return str_replace( '<a ', sprintf( '<a title="%s" ', __( 'Newer posts', 'hermi' ) ), $adjacent );
}

/**
 * Add a title attribute to the link output by previous_post_link().
 */
add_filter( 'previous_post_link', 'hermi_previous_post_link' );
function hermi_previous_post_link( $adjacent ) {
	return str_replace( '<a ', sprintf( '<a title="%s" ', __( 'Older posts', 'hermi' ) ), $adjacent );
}

//
// Posts Pagination (Archives)
//

/**
 * Add HTML class to next posts links.
 */
add_filter( 'next_posts_link_attributes',     'hermi_next_posts_link_attributes' );
function hermi_next_posts_link_attributes() {
	return 'class="next"';
}

/**
 * Add HTML class to previous posts links.
 */
add_filter( 'previous_posts_link_attributes', 'hermi_previous_posts_link_attributes' );
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
    'prev_text'    => sprintf( '<i></i> %1$s',
												apply_filters( 'hermi_pagination_page_numbers_previous_text',
												__( 'Newer Posts', 'hermi' ) )
											),
    'next_text'    => sprintf( '%1$s <i></i>',
												apply_filters( 'hermi_pagination_page_numbers_next_text',
												__( 'Older Posts', 'hermi' ) )
											),
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