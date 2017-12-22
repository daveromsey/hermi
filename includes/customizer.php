<?php
/**
 * Theme customizer related functionality
 * 
 * Note: This is a stripped down version of Twenty Seventeen's customizer.php file
 * Take a look at Twenty Seventeen's customizer.php file for a more complete example.
 *
 * Alternatively, consider using the Kirki Customizer Toolkit to handle
 * customizer functionality.
 * @see https://wordpress.org/plugins/kirki/
 * 
 * @since Hermi 0.0.1
 * @package Hermi
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
add_action( 'customize_register', 'hermi_customize_register' );
function hermi_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'hermi_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'hermi_customize_partial_blogdescription',
	) );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Hermi 0.0.1
 * @see hermi_customize_register()
 *
 * @return void
 */
function hermi_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Seventeen 1.0
 * @see hermi_customize_register()
 *
 * @return void
 */
function hermi_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
add_action( 'customize_preview_init', 'hermi_customize_preview_js' );
function hermi_customize_preview_js() {
	wp_enqueue_script(
		'hermi-customize-preview',
		get_theme_file_uri( '/assets/dist/js/customize-preview' . hermi_get_script_suffix() . '.js' ),
		[ 'customize-preview' ],
		'1.0',
		true
	);
}

/**
 * Load dynamic logic for the customizer controls area.
 */
add_action( 'customize_controls_enqueue_scripts', 'hermi_panels_js' );
function hermi_panels_js() {
	wp_enqueue_script(
		'hermi-customize-controls',
		get_theme_file_uri( '/assets/dist/js/customize-controls' . hermi_get_script_suffix() . '.js' ),
		array(),
		'1.0',
		true
	);
}
