<?php
/**
 * Functions for the templating system.
 *
 * @package Hermi/Template/Functions
 */

//
// Menus
//

//
// Off-canvas
//

/**
 * Starting portion of Off Canvas menu template.
 */
function hermi_off_canvas_start() {
	get_template_part( 'templates/parts/navigation/foundation-off-canvas/off-canvas-start' );
}

/**
 * Ending portion of Off Canvas menu template.
 */
function hermi_off_canvas_end() {
	get_template_part( 'templates/parts/navigation/foundation-off-canvas/off-canvas-end' );
}

//
// WP Dropdown Menu
//

/**
 * Secondary WP Dropdown Menu template.
 */
function hermi_wp_dropdown_menu_secondary() {
	get_template_part( 'templates/parts/navigation/wp-dropdown-menu/wp-dropdown-menu-secondary' );
}

/**
 * Top Bar for WP Dropdown Menu template.
 */
function hermi_top_bar_wp_dropdown_menu() {
	get_template_part( 'templates/parts/navigation/wp-dropdown-menu/top-bar' );
}

/**
 * Primary WP Dropdown Menu template.
 */
function hermi_wp_dropdown_menu_primary() {
	get_template_part( 'templates/parts/navigation/wp-dropdown-menu/wp-dropdown-menu-primary' );
}

//
// Foundation Dropdown
//

/**
 * Top Bar for Foundation Dropdown menu template.
 */
function hermi_top_bar_foundation_dopdown_menu() {
	get_template_part( 'templates/parts/navigation/foundation-dropdown-menu/top-bar' );
}

//
// Accessibility
//

/**
 * 'Skip to content' link template. Used to allow skipping menus for accessibility.
 */
function hermi_skip_to_content() {
	get_template_part( 'templates/parts/navigation/skip-to-content' );
}

//
// Site Footer
//

/**
 * Footer widgets template.
 */
function hermi_footer_widgets() {
	get_template_part( 'templates/parts/footer/footer-widgets' );
}

/**
 * Footer navigation template.
 */
function hermi_footer_nav() {
	get_template_part( 'templates/parts/footer/footer-nav' );
}

/**
 * Copyright template.
 */
function hermi_footer_copyright() {
	get_template_part( 'templates/parts/footer/footer-copyright' );
}
