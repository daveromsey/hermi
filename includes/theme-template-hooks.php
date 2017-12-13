<?php
/**
 * Template Hooks
 *
 * Action/filter hooks used for functions/templates.
 *
 * @package Hermi/Templates
 */

//
// Menus
//

/**
 * Off-canvas - Mobile nav used for Foundation Dropdown and WP Dropdown
 *
 * @see hermi_off_canvas_start()
 * @see hermi_off_canvas_end()
 */
add_action( 'hermi_body_top',    'hermi_off_canvas_start', -9999 ); // Fire this early. It should be the first thing after the opening <body> tag.
add_action( 'hermi_body_bottom', 'hermi_off_canvas_end',    9999 ); // Fire this late. It should be the last thing before the closing </body> tag.

/**
 * WP Dropdown Menu and Top Bar
 *
 * @see hermi_wp_dropdown_menu_secondary()
 * @see hermi_top_bar_wp_dropdown_menu()
 * @see hermi_wp_dropdown_menu_primary()
 */
add_action( 'hermi_header_top',    'hermi_wp_dropdown_menu_secondary' );
add_action( 'hermi_header',        'hermi_top_bar_wp_dropdown_menu' );
add_action( 'hermi_header_bottom', 'hermi_wp_dropdown_menu_primary' );

/**
 * Foundation Dropdown Menu and Top Bar
 *
 * @see hermi_top_bar_foundation_dopdown_menu()
 */
// add_action( 'hermi_header', 'hermi_top_bar_foundation_dopdown_menu' );

/**
 * Accessibility: Adds 'Skip to content' link allowing menus to be skiped.
 *
 * @see hermi_skip_to_content()
 */
add_action( 'hermi_site_top', 'hermi_skip_to_content' );

//
// Posts
//

/**
 * Heading for archives template.
 *
 * @see hermi_archive_heading()
 */
add_action( 'hermi_content_top', 'hermi_archive_heading' );

//
// Site Footer
//

/**
 * Hooks for site's footer.
 *
 * @see hermi_footer_widgets()
 * @see hermi_footer_nav()
 * @see hermi_footer_copyright()
 */
add_action( 'hermi_footer', 'hermi_footer_widgets' );
add_action( 'hermi_footer', 'hermi_footer_nav',       30 );
add_action( 'hermi_footer', 'hermi_footer_copyright', 40 );