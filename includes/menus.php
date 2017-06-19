<?php
/**
 * Menu registration.
 * 
 * See Menus section of template-hooks.php and template-functions.php for
 * information on where menus are hooked and how they are displayed.
 * 
 * @package Hermi
 * @subpackage Menus
 */

/**
 * Register the navigation menus used by the theme.
 */
add_action( 'after_setup_theme', 'hermi_register_nav_menus' );
function hermi_register_nav_menus() {
	register_nav_menus( [
		// Mobile nav (Same for both Foundation and WP dropdown navs)
		'mobile-nav'      => __( 'Mobile Menu', 'hermi' ),

		/*
	   * Note: It is suggested to use either the Foundation nav
		 * or the WP Dropdown navs.
		 */
		
		// Foundation dropdown nav for large screens
		'main-nav'      => __( 'Main Menu', 'hermi' ),
		
		// WP Dropdown nav for large screens.
		//'secondary-left'  => __( 'Secondary Menu - Left', 'hermi' ),
		//'secondary-right' => __( 'Secondary Menu - Right', 'hermi' ),
		//'primary-left'    => __( 'Primary Menu - Left', 'hermi' ),
		//'primary-center'  => __( 'Primary Menu - Center', 'hermi' ), // unused example
		//'primary-right'   => __( 'Primary Menu - Right', 'hermi' ),
		
		
		// Footer nav
		'footer'        => __( 'Footer Menu', 'hermi' ),
	] );
}