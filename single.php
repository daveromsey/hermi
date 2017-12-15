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
switch ( hermi_get_layout( 'post-single' ) ) :

	case ( 'layout-content-sidebar' ) :
		require_once( locate_template( 'templates/tpl-post-sidebar-right.php' ) );
		exit();
	break;

	case ( 'layout-sidebar-content' ) :
		require_once( locate_template( 'templates/tpl-post-sidebar-left.php' ) );
		exit();
	break;

	case ( 'layout-container-wide' ) :
		require_once( locate_template( 'templates/tpl-post-container-wide.php' ) );
		exit();
	break;

	case ( 'layout-container-narrow' ) :
		require_once( locate_template( 'templates/tpl-post-container-narrow.php' ) );
		exit();
	break;

	case ( 'layout-full-width' ) :
		require_once( locate_template( 'templates/tpl-post-full-width.php' ) );
		exit();
	break;

endswitch;

