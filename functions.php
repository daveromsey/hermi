<?php
/**
 * Hermi functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hermi
 */

/**
 * Set theme's version number.
 * This is handy for cache busting styles and scripts.
 */
define( 'HERMI_VERSION', '0.1.0' );

/**
 * Include files that handle various functionality.
 */

// Load dependencies managed by Composer
//require_once( get_template_directory() . '/includes/vendor/autoload.php' );

// Handle recommended plugins functionality via TGM Plugin Activation 
//require_once( get_template_directory() . '/includes/recommended-plugins.php' );

// Utility functions
require_once( get_template_directory() . '/includes/utilities.php' );

// Helper functions
require_once( get_template_directory() . '/includes/helpers.php' );

// Make the theme availble for translation
require_once( get_template_directory() . '/includes/translation.php' );

// Features added via add_theme_support() (mostly) are located here
require_once( get_template_directory() . '/includes/theme-support.php' );

// Load JavaScript
require_once( get_template_directory() . '/includes/scripts.php' );

// Load styles
require_once( get_template_directory() . '/includes/styles.php' );

// Template functions
require_once( get_template_directory() . '/includes/template-functions.php' );

// Template tags
require_once( get_template_directory() . '/includes/template-tags.php' );

// Wire up functions to theme's template hooks.
require_once( get_template_directory() . '/includes/theme-template-hooks.php' );

// Functions attached to theme's hooks.
require_once( get_template_directory() . '/includes/theme-template-functions.php' );

// Menus, menu walkers, menu set up
require_once( get_template_directory() . '/includes/menus.php' );

// Register sidebars and widget areas
require_once( get_template_directory() . '/includes/widget-areas.php' );

// Attachment hooks and functions
require_once( get_template_directory() . '/includes/attachments.php' );

// Comment hooks and functions
require_once( get_template_directory() . '/includes/comments.php' );

// Pagination hooks and functions
require_once( get_template_directory() . '/includes/pagination.php' );

// Handle TinyMCE styling
require_once( get_template_directory() . '/includes/editor-style.php' );

// Handle theme customization via the Theme Customizer
require_once( get_template_directory() . '/includes/customizer.php' );

// Customize the WordPress Log In page
require_once( get_template_directory() . '/includes/log-in.php' );

// Custom post type demo templates
// Enable this for demo and testing purposes only. Custom Post Type and
// Taxonomy registration should be handled by plugins.
 require_once( get_template_directory() . '/includes/custom-post-type-demo.php' );
