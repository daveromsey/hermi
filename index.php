<?php
/**
 * The main template file.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Determine which template to load by default based on 
 * the "Default blog archive template" setting in the Customizer.
 */
switch ( hermi_get_layout( 'archive-post' ) ) :

	case ( 'layout-standard' ) :
	default : // Failover template
		require_once( locate_template( 'templates/tpl-archive-post.php' ) );
	break;

	case ( 'layout-narrow' ) :
		require_once( locate_template( 'templates/tpl-archive-post-narrow.php' ) );
	break;

	case ( 'layout-full-width' ) :
		require_once( locate_template( 'templates/tpl-archive-post-full-width.php' ) );
	break;

	case ( 'layout-content-sidebar' ) :
		require_once( locate_template( 'templates/tpl-archive-post-sidebar-right.php' ) );
	break;

	case ( 'layout-sidebar-content' ) :
		require_once( locate_template( 'templates/tpl-archive-post-sidebar-left.php' ) );
	break;

endswitch;

exit();
