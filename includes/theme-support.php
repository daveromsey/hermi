<?php
/**
 * Set up the theme by loading the text domain and
 * by specifying support for various features.
 *
 * @Since 0.1.0
 */ 
add_action( 'after_setup_theme', 'hermi_setup' );
function hermi_setup() {
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	 /*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery', // Supresses output of embeded gallery styles that WP adds.
		'search-form',
	] );


	/*
	 * Add support for editor styles so that frontend styling will apply to the
	 * visual editing experience on the backend.
	 */
	//add_theme_support( 'editor-styles' );
	
	/*
	 * Add support for new alignment options provided in WP 5.0
	 */
	add_theme_support( 'align-wide' );
	
	/*
	 * Set the content width in pixels. This is based on the theme's design.
	 */
	$GLOBALS['content_width'] = apply_filters( 'hermi_content_width', 1200 );
}
