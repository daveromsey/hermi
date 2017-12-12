<?php
/**
 * Functions for the templating system.
 *
 * @package Hermi/Template/Functions
 */

//
// Menus
//

/**
 * Starting portion of Off Canvas menu template.
 */
function hermi_off_canvas_start() {
	get_template_part( 'template-parts/navigation/off-canvas/off-canvas-start' );
}

/**
 * Ending portion of Off Canvas menu template.
 */
function hermi_off_canvas_end() {
	get_template_part( 'template-parts/navigation/off-canvas/off-canvas-end' );
}

/**
 * Top Bar for WP Dropdown menu template.
 */
function hermi_dropdown_menu_top_bar() {
	get_template_part( 'template-parts/navigation/dropdown-menu/top-bar' );
}

/**
 * Top Bar for Foundation Dropdown menu template.
 */
function hermi_foundation_dopdown_menu_top_bar() {
	get_template_part( 'template-parts/navigation/foundation-dropdown-menu/top-bar-dropdown' );
}

/**
 * Secondary WP Dropdown menu template.
 */
function hermi_dropdown_menu_secondary() {
	get_template_part( 'template-parts/navigation/dropdown-menu/dropdown-menu-secondary' );
}

/**
 * Primary WP Dropdown menu template.
 */
function hermi_dropdown_menu_primary() {
	get_template_part( 'template-parts/navigation/dropdown-menu/dropdown-menu-primary' );
}

/**
 * 'Skip to content' link template. Used to allow skipping menus for accessibility.
 */
function hermi_skip_to_content() {
	get_template_part( 'template-parts/navigation/skip-to-content' );
}

//
// Posts
//

/**
 * Heading for various post type archives template.
 */
function hermi_archive_heading() {
	get_template_part( 'template-parts/post/archive/heading' );
}

//
// Site Footer
//

/**
 * Footer widgets template.
 */
function hermi_footer_widgets() {
	get_template_part( 'template-parts/footer/footer-widgets' );
}

/**
 * Footer navigation template.
 */
function hermi_footer_nav() {
	get_template_part( 'template-parts/footer/footer-nav' );
}

/**
 * Copyright template.
 */
function hermi_footer_copyright() {
	get_template_part( 'template-parts/footer/footer-copyright' );
}
