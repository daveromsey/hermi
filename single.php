<?php
/**
 * The default singular template file.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Load the default template.
 * Use require_once() because we don't want this to fail silently. 
 */
// require_once( locate_template( 'templates/tpl-single-post-sidebar-right.php' ) );
// require_once( locate_template( 'templates/tpl-single-post-sidebar-left.php' ) );
// require_once( locate_template( 'templates/tpl-single-post.php' ) );
require_once( locate_template( 'templates/tpl-single-post-narrow.php' ) );
// require_once( locate_template( 'templates/tpl-single-post-full-width.php' ) );

exit();
