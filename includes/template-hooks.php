<?php
/**
 * Template Hooks
 *
 * Action/filter hooks used for functions/templates.
 *
 * @package 	Hermi/Templates
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
 
add_action( 'hermi_body_top',    'hermi_off_canvas_start' );
add_action( 'hermi_body_bottom', 'hermi_off_canvas_end' );

/**
 * WP Dropdown Menu
 * 
 * @see hermi_dropdown_nav_top_bar()
 * @see hermi_dropdown_nav_secondary_template()
 * @see hermi_dropdown_nav_primary_template()
 */
add_action( 'hermi_header', 'hermi_dropdown_nav_top_bar' );
add_action( 'hermi_header_top', 'hermi_dropdown_nav_secondary_template', 15 );
add_action( 'hermi_header_bottom', 'hermi_dropdown_nav_primary_template',   10 );

/**
 * Foundation Dropdown Menu
 * 
 * @see hermi_foundation_dopdown_menu_top_bar()
 */
//add_action( 'hermi_header', 'hermi_foundation_dopdown_menu_top_bar' );

/**
 * Adds 'Skip to content' link to skip menus for accessibility.
 * 
 * @see hermi_skip_to_content()
 */
add_action( 'hermi_site_top', 'hermi_skip_to_content' );

// 
// Posts
//
add_action( 'hermi_content_top', 'hermi_archive_heading' );
		
add_action( 'hermi_content_bottom_archive', 'hermi_archive_pagination' );

// 
// Post
//

/**
 * Post class
 * 
 * @see hermi_sticky_post_class()
 */
add_filter( 'post_class', 'hermi_sticky_post_class' );

/**
 * Entry Header
 * 
 * @see hermi_post_sticky()
 * @see hermi_post_featured_image()
 * @see hermi_post_title()
 * @see hermi_post_meta_primary()
 */
add_action( 'hermi_entry_header', 'hermi_entry_header_open',   -10000 );
add_action( 'hermi_entry_header', 'hermi_post_sticky',         20 );
add_action( 'hermi_entry_header', 'hermi_post_featured_image', 30 );
add_action( 'hermi_entry_header', 'hermi_post_title',          40 );
add_action( 'hermi_entry_header', 'hermi_post_meta_primary',   50 );
add_action( 'hermi_entry_header', 'hermi_entry_header_close',  10000 );

/**
 * Entry Footer
 * 
 * @see hermi_entry_footer_open()
 * @see hermi_post_meta_secondary()
 * @see hermi_entry_footer_close()
 */
add_action( 'hermi_entry_footer', 'hermi_entry_footer_open',    -10000 );
add_action( 'hermi_entry_footer', 'hermi_post_meta_secondary' );
add_action( 'hermi_entry_footer', 'hermi_entry_footer_close',    10000 );

//
// Pagination - Archives
//

/**
 * Adds helper classes to archive pagination links.
 * 
 * @see hermi_next_posts_link_attributes()
 * @see hermi_previous_posts_link_attributes()
 */
add_filter( 'next_posts_link_attributes',     'hermi_next_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'hermi_previous_posts_link_attributes' );


//
// Pagination - Single Post
//

/**
 * Adds helper classes to single pagination links.
 * 
 * @see hermi_next_post_link()
 * @see hermi_previous_post_link()
 */
add_filter( 'next_post_link', 'hermi_next_post_link' );
add_filter( 'previous_post_link', 'hermi_previous_post_link' );

//
// Pagination - Paged post
//

/**
 * Modify args used by wp_link_pages
 * 
 * @see hermi_wp_link_pages_args()
 */
add_filter( 'wp_link_pages_args', 'hermi_wp_link_pages_args' );

// 
// Site Footer
//

/**
 * Site Footer
 * 
 * @see hermi_footer_widgets()
 * @see hermi_footer_nav()
 * @see hermi_footer_copyright()
 */
add_action( 'hermi_footer', 'hermi_footer_widgets' );
add_action( 'hermi_footer', 'hermi_footer_nav',       30 );
add_action( 'hermi_footer', 'hermi_footer_copyright', 40 );