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
switch ( hermi_get_layout( 'post-archive' ) ) :

	case ( 'layout-content-sidebar' ) :
		require_once( locate_template( 'templates/tpl-post-archive-sidebar-right.php' ) );
	break;

	case ( 'layout-sidebar-content' ) :
		require_once( locate_template( 'templates/tpl-post-archive-sidebar-left.php' ) );
	break;

	case ( 'layout-grid' ) :
		require_once( locate_template( 'templates/tpl-post-archive-grid.php' ) );
	break;

	case ( 'layout-grid-narrow' ) :
		require_once( locate_template( 'templates/tpl-post-archive-grid-narrow.php' ) );
	break;

	case ( 'layout-full-width' ) :
		require_once( locate_template( 'templates/tpl-post-archive-full-width.php' ) );
	break;

endswitch;

exit();
