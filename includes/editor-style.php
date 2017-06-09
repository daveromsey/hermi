<?php
/**
 * This file contains code related to Editor styling.
 * @package Hermi
 * 
 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add styles to WP Editor.
 * 
 * @since Hermi 0.1.0
 * 
 * @return void
 */
add_action( 'after_setup_theme', 'hermi_editor_styles' );
function hermi_editor_styles() {
	// Use our main stylesheet for WP's editor too.
	// See /hermi/assets/source/scss/partials/_editor-style.scss for styles specific to the WP Editor.
	add_editor_style( 'assets/dist/css/style' . hermi_get_script_suffix() . '.css' );
	
	// Add Google Fonts to editor styles in the admin.
	// This is based on the Google Fonts stuff in hermi_styles().
	//$query_args =  [
	//	'family' => 'Open+Sans:400italic,700italic,400,700',
	//];
	//add_editor_style( str_replace( ',', '%2C', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) ) );
}

/**
 * Adds JS used to adjust TinyMCE for better looking editor styling.
 *
 * @since 0.1.0
 *
 * @param array $plugins  Default array of plugins to be loaded by TinyMCE.
 *
 * @return array $plugins Amended array of plugins to be loaded by TinyMCE.
 */
add_filter( 'mce_external_plugins', 'hermi_tinymce_editor_style_plugin' );
function hermi_tinymce_editor_style_plugin( $plugins ) {
	$plugins['hermi_editor_style'] = get_stylesheet_directory_uri() . '/assets/dist/js/tinymce-editor-style' . hermi_get_script_suffix() . '.js';
	
	return $plugins;
}

/**
 * Add additional classes to the TnyMCE's <body> tag 
 * to allow front end styles to more seamlessly apply
 * on inside the WYSIWYG editor.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 *
 * @param array $mceInit TinyMCE settings
 *
 * @return array
 */
add_filter( 'tiny_mce_before_init', 'hermi_tinymce_body_class' );
function hermi_tinymce_body_class( $mceInit ) {
	// Adds the .entry-content class to TinyMCE <body>.
	$mceInit['body_class'] .= ' entry-content';
	
	global $post;
	// Adds post classes to TinyMCE <body>.
	// @link http://wordpress.stackexchange.com/questions/235194/add-post-class-to-the-tinymce-iframe
  if ( is_a( $post, 'WP_Post' ) ) {
    $mceInit['body_class'] .= ' ' . join( ' ', get_post_class( '', $post->ID ) );
  }
	
  return $mceInit;
}
