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
 * Determine which template to load by default based on 
 * the "Default blog single template" setting in the Customizer.
 * 
 * Note that posts allow a custom template to be selected, which 
 * overrides the default template.
 */
switch ( hermi_get_layout( 'single-post' ) ) :

	default : // Failover template
	case ( 'layout-standard' ) :
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
