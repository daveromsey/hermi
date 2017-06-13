<?php

/**
 * Hermi functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hermi
 */

/*
 * Set theme's version number. This is handy for cache busting on styles and scripts.
 */
define( 'HERMI_VERSION', '0.1.0' );

/**
 * Include files that handle various functionality.
 * 
 */
 
// Utility functions
require_once( get_template_directory() . '/includes/utilities.php' ); 

// Helper functions
require_once( get_template_directory() . '/includes/helpers.php' ); 

// Make the theme availble for translation. 
require_once( get_template_directory() . '/includes/translation.php' );

// Features added via add_theme_support() are located here.
require_once( get_template_directory() . '/includes/theme-support.php' );

// Load JavaScript
require_once( get_template_directory().'/includes/scripts.php' ); 

// Load styles
require_once( get_template_directory().'/includes/styles.php' ); 

// Menus and menu walkers
require_once( get_template_directory().'/includes/menus.php' );  

// Register sidebars and widget areas
require_once( get_template_directory() . '/includes/widget-areas.php'); 

// Wire up callback functions to hooks.
require_once( get_template_directory() . '/includes/template-hooks.php' ); 
 
// Callback functions hooked to actions or filters that generate output for templates.
require_once( get_template_directory() . '/includes/template-functions.php' ); 

// Functions called directly within templates to generate output.
require_once( get_template_directory() . '/includes/template-tags.php' ); 

// Handle TinyMCE styling
require_once( get_template_directory() . '/includes/editor-style.php'); 

// Handle theme customization via the Theme Customizer
require_once( get_template_directory() . '/includes/theme-customizer.php');


//////

// Customize the WordPress login menu
// require_once(get_template_directory().'/assets/functions/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/assets/functions/admin.php'); 
 