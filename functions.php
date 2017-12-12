<?php
/**
 * Hermi functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hermi
 */

/**
 * Set theme's version number. This is handy for cache busting on styles and scripts.
 */
define( 'HERMI_VERSION', '0.1.0' );

/**
 * Include files that handle various functionality.
 */

// Utility functions.
require_once( get_template_directory() . '/includes/utilities.php' );

// Helper functions.
require_once( get_template_directory() . '/includes/helpers.php' );

// Make the theme availble for translation.
require_once( get_template_directory() . '/includes/translation.php' );

// Features added via add_theme_support() (mostly) are located here.
require_once( get_template_directory() . '/includes/theme-support.php' );

// Load JavaScript.
require_once( get_template_directory() . '/includes/scripts.php' );

// Load styles.
require_once( get_template_directory() . '/includes/styles.php' );

// Wire up template hooks related to customizing the site's main structure.
require_once( get_template_directory() . '/includes/site-template-hooks.php' );

// Functions used for generating output for templates.
require_once( get_template_directory() . '/includes/site-template-functions.php' );

// Menus, menu walkers, menu set up.
require_once( get_template_directory() . '/includes/menus.php' );

// Register sidebars and widget areas
require_once( get_template_directory() . '/includes/widget-areas.php' );

// Post hooks and functions.
require_once( get_template_directory() . '/includes/posts.php' );

// Comment hooks and functions.
require_once( get_template_directory() . '/includes/comments.php' );

// Attachment hooks and functions.
require_once( get_template_directory() . '/includes/attachments.php' );

// Pagination hooks and functions.
require_once( get_template_directory() . '/includes/pagination.php' );

// Handle TinyMCE styling.
require_once( get_template_directory() . '/includes/editor-style.php' );

// Handle theme customization via the Theme Customizer.
require_once( get_template_directory() . '/includes/theme-customizer.php' );

// Customize the WordPress log in page.
require_once( get_template_directory() . '/includes/log-in.php' );

// Functionality related to the custom post type demo templates
// Enable this for demo and testing purposes only.
//require_once( get_template_directory() . '/includes/custom-post-type-demo.php' );
