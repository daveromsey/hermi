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
	//exit ( print_r( hermi_get_google_fonts_url() ) );
	
	// Enqueue Google Fonts.
	// If there are no fonts specified, hermi_get_google_fonts_url()
	// will return an empty string and nothing will be enqueued.
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
 */
function hermi_get_google_fonts_url() {
	// Stores output buffer.
	$fonts_url = '';
	
	$fonts = hermi_get_google_fonts();
	
	if ( $fonts ) {
		$fonts_url = add_query_arg( [
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( apply_filters( 'hermi_google_fonts_subsets', 'latin,latin-ext' ) ),
		], apply_filters( 'hermi_google_fonts_api_url', '//fonts.googleapis.com/css' ) );
	}

	return $fonts_url;
}

/**
 * Helper function used to get Google fonts array.
 * This assists with getting the fonts on the front end or
 * back end. See includes/editor-style.php
 *
 * @return array of Google Fonts
 */
function hermi_get_google_fonts() {
	/**
	 * Filterable array of Google Fonts to use.
	 *
	 * @link https://fonts.google.com/
	 * 
	 * 	 Examples:
	 *     $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	 *     $fonts[] = 'Montserrat:400,700';
	 *     $fonts[] = 'Inconsolata:400';
	 *     $fonts[] = 'Bungee Inline';
	 */	
	$fonts = apply_filters( 'hermi_google_fonts', array() );
	$fonts[] = 'Montserrat:400,700';
	$fonts[] = 'Bungee Inline';
	return $fonts;
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