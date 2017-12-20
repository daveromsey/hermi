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
 * Available templates:
 *	templates/
 *     tpl-single-post.php
 *     tpl-single-post-narrow.php
 *     tpl-single-post-full-width.php
 *     tpl-single-post-sidebar-right.php
 *     tpl-single-post-sidebar-left.php
 */

// Load default template with require_once() because we don't want this to fail silently.  
require_once( locate_template( 'templates/tpl-single-post-narrow.php' ) ); 

switch ( hermi_get_default_layout( 'single-post' ) ) :

	case ( 'layout-standard' ) :
	default : // Failover template
		require_once( locate_template( 'templates/tpl-single-post.php' ) );
	break;

	case ( 'layout-narrow' ) :
		require_once( locate_template( 'templates/tpl-single-post-narrow.php' ) );
	break;

	case ( 'layout-full-width' ) :
		require_once( locate_template( 'templates/tpl-single-post-full-width.php' ) );
	break;

	case ( 'layout-content-sidebar' ) :
		require_once( locate_template( 'templates/tpl-single-post-sidebar-right.php' ) );
	break;

	case ( 'layout-sidebar-content' ) :
		require_once( locate_template( 'templates/tpl-single-post-sidebar-left.php' ) );
	break;

endswitch;

exit();
