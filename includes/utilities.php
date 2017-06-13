<?php
/**
 * Utilities
 *
 * @Since 0.1.0
 */


/**
 * Use .min suffix when SCRIPT_DEBUG is false.
 * 
 * This is used to allow uncompressed scripts and styles
 * to be loaded instead of their compressed counterparts
 * when by toggling the SCRIPT_DEBUG constant.
 *
 * @return string
 */
function hermi_get_script_suffix() {
	return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
}
 
/**
 * Filters the array of excluded directories and files while scanning theme folder. 
 * 
 * @see https://core.trac.wordpress.org/ticket/38292
 * 
 * @param array $exclusions Array of excluded directories and files.
 */
add_filter( 'theme_scandir_exclusions', 'hermi_theme_scandir_exclusions' ); 
function hermi_theme_scandir_exclusions( $exclusions ) {
	
	// These directories are used for development and do not contain templates.
	// Exclude them from being scanned for template files to improve performance.
	$exclusions[] = 'gulp';
	$exclusions[] = 'bower_components';
	 
	return $exclusions;
}

/**
 * Determine if a string is a URL.
 *
 * @link via http://stackoverflow.com/questions/4397157/validate-url-in-php-jquery
 *
 * @param string $url the string to check
 *
 * @Return 1 if $url is valid, 0 if invalid, and *false* upon error.
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
 * 
 * @return string RGB color as R,G,B
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
 * @param int $post_id ID of the post to get top most parent for.
 * 
 * @retun int post id
 */
function hermi_get_top_most_parent( $post_id ) {
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
 * @param int | object Post ID or object 
 * 
 * @return int Post ID
 */
function hermi_get_ancestor( $post = false ) {
	
	if ( false === $post ) {
		$post = $GLOBALS['post'];
	}
		
	$post_ancestors = get_post_ancestors( $post );
	if ( count( $post_ancestors ) ) {
		$top_page = array_pop( $post_ancestors );
		return $top_page;
	} else {
		return $post->ID;
	}
}


function hermi_get_top_menu_class( $post, $current_id ) {
	global $post; 
	$post_id = $post->ID;
	if ( $post_id == $current_id || get_ancestor( $post ) == $current_id ) {
		echo 'current_page_item_parent';
	} else {
		echo 'page_item';
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