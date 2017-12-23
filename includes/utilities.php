<?php
/**
 * Utilities
 *
 * @package Hermi
 * @subpackage Utilities
 * @since 0.1.0
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
 * @return array
 */
add_filter( 'theme_scandir_exclusions', 'hermi_theme_scandir_exclusions' ); 
function hermi_theme_scandir_exclusions( $exclusions ) {

	/**
	 * These directories are used for development and do not contain templates.
	 * Exclude them from being scanned for template files to improve performance.
	 * node_modules is excluded by default.
	 */
	$exclusions[] = 'build';
	$exclusions[] = 'bower_components';
	 
	return $exclusions;
}
