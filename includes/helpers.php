<?php
/**
 * This file contains helper functions.
 * 
 */
 
/**
 * Determine if a string is a URL.
 *
 * @link via http://stackoverflow.com/questions/4397157/validate-url-in-php-jquery
 *
 * @param string $url the string to check
 * @Return 1 if $url is valid, 0 if invalid, and false upon error
 */
// 
function hermi_is_valid_url( $url ) {
	return preg_match( '|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url );
}

/**
 * Convert HTML color code in hex to RGB
 * 
 * @link http://www.caperna.org/computing/repository/hsl-rgb-color-conversion-php
 * 
 * @param string $hex_code 3 or 6 character hex code. Preceding # is optional
 * @return string|false RGB color as R,G,B or false on error
 */
function hermi_hex_to_rgb( $hex_code ) {
	if ( empty ( $hex_code ) ) {
		return false;
	}
		
	if (  $hex_code[0] == '#' ) {
		$hex_code = substr( $hex_code, 1 );
	}
	
	if ( strlen( $hex_code ) == 3 ) {
		$hex_code = $hex_code[0] . $hex_code[0] . $hex_code[1] . $hex_code[1] . $hex_code[2] . $hex_code[2];
	}
	
	$r = hexdec( $hex_code[0] . $hex_code[1] );
	$g = hexdec( $hex_code[2] . $hex_code[3] );
	$b = hexdec( $hex_code[4] . $hex_code[5] );

	return "$r,$g,$b";
}

/**
 * Get the top-most parent id of a post/page
 * 
 * @param int $post_id Optional. Post ID. Defaults to ID of global $post.
 * @retun int post id
 */
function hermi_get_top_most_parent( $post_id = 0 ) {
	// If no ID is passed, use the global post's ID.
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}
	
	// Bail if we can't get the ID.
	if ( false === $post_id ) {
		return false;
	}
	
	$parent_id = get_post( $post_id )->post_parent;
	if ( $parent_id == 0 ) {
		return $post_id;
	} else {
		return hermi_get_top_most_parent( $parent_id );
	}
}

/**
 * Used for highlighting menu item when viewing a page or child of a given page.
 * 
 * @param int|object Post ID or object 
 * @return int Post ID
 */
function hermi_get_ancestor( $post = 0 ) {
	if ( $post === null ) {
		return false;
	}
	
	if ( empty( $post ) ) {
		$post = get_post();
	} else {
		$post = get_post( $post );
	}
		
	$post_ancestors = get_post_ancestors( $post );
	if ( count( $post_ancestors ) ) {
		$top_page = array_pop( $post_ancestors );
		return $top_page;
	} else {
		return $post->ID;
	}
}

/**
 * Return a CSS class name for use with even/odd row styling
 * 
 * @param int $counter Externally incremented counter. Tells us what row number we are on.
 * @param string $even The name for the even class
 * @param string $odd The name for the odd class
 *
 * @return string row class name | false on error
 */
function hermi_get_alt_row_class( $counter, $even = 'even', $odd = 'odd' ) {
	if ( ( $counter % 2 ) == 0 ) {
		return $even;
	} else {
		return $odd;
	}
}
