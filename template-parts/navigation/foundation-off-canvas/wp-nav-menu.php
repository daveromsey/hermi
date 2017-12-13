<?php
/**
 * Template part for displaying the mobile navigation menu.
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( has_nav_menu( 'mobile-nav' ) ) {
	
	// Foundation Drilldown menu
	wp_nav_menu( [
		'theme_location' => 'mobile-nav',    // Where it's located in the theme
		'container'      => false,           // Remove nav container
		'menu_class'     => 'vertical menu drilldown',
		'walker'         => new Hermi_Foundation_Off_Canvas_Menu_Walker(),
		'fallback_cb'    => false,           // Fallback function used when there are no items to show.
		'items_wrap'     => '<ul id="%1$s" class="%2$s" data-drilldown>%3$s</ul>',
	] );

	/*
	// Foundation Accordion menu
	wp_nav_menu( [
		'theme_location' => 'mobile-nav',    // Where it's located in the theme
		'container'      => false,           // Remove nav container
		'menu_class'     => 'vertical menu accordion-menu',
		'walker'         => new Hermi_Foundation_Off_Canvas_Menu_Walker(),
		'fallback_cb'    => false,           // Fallback function used when there are no items to show.
		'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
	] );
	*/	
}
