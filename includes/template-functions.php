<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package Hermi
 * @since 0.1.0
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

/**
 * Set the arguments that passed to wp_link_pages() throughout the theme.
 * Post Pagination E.g. content split by <!--nextpage-->
 */
add_filter( 'wp_link_pages_args', 'hermi_wp_link_pages_args' );
function hermi_wp_link_pages_args( $args ) {
	$args['before']  = '<div class="page-link">';
	$args['before']	.= sprintf( '<span>%s </span>', esc_html__( 'Pages:', 'hermi' ) );
	
	$args['after']  = '</div>';

	return $args;
}

/**
 * Check if a post has a title.
 *
 * @param int $post_id ID of the post to check. Checks current post if no ID is passed.
 */
function hermi_has_title( $post_id = null ) {
	$the_post = get_post();
	$post_id = ( null === $post_id ) ? intval( $the_post->ID ) : intval( $post_id );
	$post_title = get_the_title( $post_id );
	
	return ( '' === trim( $post_title ) ) ? false : true;
}
 
/**
 * Determines if hermi_permalink_meta() should be used or not.
 *
 * @return bool true if yes, false if no
 */
function hermi_use_permalink_meta() {
	$the_post    = get_post();
	$post_format = get_post_format();

	if (
		'' === trim( $the_post->post_title )
		|| ( 'aside' 	=== $post_format )
		|| ( 'chat' 	=== $post_format && '' === trim( $the_post->post_title ) )
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
 * Determine if category meta will need to be displayed.
 *
 * (!) If the only category is the default category, it will be considered empty.
 * This was done to achieve a minimalist design for certain post formats.
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
 * Determine if tag meta will need to be displayed.
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
