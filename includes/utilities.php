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


// Return 1 if $url is valid, otherwise return 0
// @link via http://stackoverflow.com/questions/4397157/validate-url-in-php-jquery
function hermi_is_valid_url( $url ) {
	return preg_match( '|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url );
}


// @link http://www.caperna.org/computing/repository/hsl-rgb-color-conversion-php
function hermi_hex_to_rgb( $htmlCode ) {
	if ( empty ( $htmlCode ) )
		return false;
		
	if( $htmlCode[0] == '#')
		$htmlCode = substr($htmlCode, 1);

	if ( strlen( $htmlCode ) == 3 )
		$htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
		
	$r = hexdec( $htmlCode[0] . $htmlCode[1] );
	$g = hexdec( $htmlCode[2] . $htmlCode[3] );
	$b = hexdec( $htmlCode[4] . $htmlCode[5] );

	return "$r,$g,$b";
	//return $b + ($g << 0x8) + ($r << 0x10);
}



// Get the top-most parent page id of a page
function hermi_get_top_most_parent( $post_id ) {
	$parent_id = get_post( $post_id )->post_parent;
	if ( $parent_id == 0 ) {
		return $post_id;
	} else {
		return hermi_get_top_most_parent( $parent_id );
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

// @link: http://www.heaveninteractive.com/weblog/2009/11/16/wordpress-tutorial-how-to-highlight-a-menu-item-when-viewing-a-page-or-any-child-of-a-given-page/
function hermi_get_ancestor( $post ) {
	global $post; 
	$post_ancestors = get_post_ancestors( $post );
	if ( count( $post_ancestors ) ) {
		$top_page = array_pop( $post_ancestors );
		return $top_page;
	} else {
		return $post->ID;
	}
}

/**
 * get_alt_row_class() Output a CSS class for even/odd row styling
 * @param $counter Externally incremented counter.  Tells us what row number we are on.
 * @param $even The name for the even class
 * @param $odd The name for the odd class
 */
function hermi_get_alt_row_class( $counter, $even = 'even', $odd = 'odd' ) {
	if ( ( $counter % 2 ) == 0 ) {
		echo $even;
	} else {
		echo $odd;
	}
}