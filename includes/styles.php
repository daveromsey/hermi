<?php
/**
 * Handle styles.
 * 
 * CSS is compiled via Gulp.
 * 
 * @package Hermi
 */
 
// Exit if accessed directly 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue front end styles.
 */
add_action( 'wp_enqueue_scripts', 'hermi_styles' );
function hermi_styles() {
	// Enqueue Google Fonts.
	wp_enqueue_style(
		'hermi-google-fonts',
		hermi_get_google_fonts_url(),
		array(),
		HERMI_VERSION
	);
	
	// Enqueue the theme's main stylesheet.
	// Child themes can dequeue this stylesheet and enqueue their own recompiled version using only the desired components via Sass.
	wp_enqueue_style(
		'hermi-theme-style', 
		get_template_directory_uri() . '/assets/dist/css/style' . hermi_get_script_suffix() . '.css',
		array(),
		HERMI_VERSION
	);
}

/**
 * Helper function used to get Google fonts URL.
 * Based on code from Twentysixteen theme.
 */
function hermi_get_google_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	//$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	//$fonts[] = 'Montserrat:400,700';
	//$fonts[] = 'Inconsolata:400';
	//$fonts[] = 'Lakki Reddy';
	//$fonts[] = 'Montserrat:400,700';
	//$fonts[] = 'Bungee Inline';
	
	$fonts = apply_filters( 'hermi_google_fonts', $fonts );
	
	if ( $fonts ) {
		$fonts_url = add_query_arg( [
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		], 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * WordPress adds styles for some front end components. These
 * styles are removed so that they don't interfere with the 
 * styles added by the theme.
 */
add_action( 'after_setup_theme', 'hermi_clean_up_styles' ); 
function hermi_clean_up_styles() {
	/**
	 * Removes Recent Comments default widget styles.
	 */
	add_filter( 'show_recent_comments_widget_style', '__return_false' );

	/**
	 * Remove embedded CSS added by WordPress for galleries. 
	 * Note that adding html5 support for galleries also disablies these
	 * styles. See add_theme_support().
	 */
	add_filter( 'use_default_gallery_style', '__return_false' );
}