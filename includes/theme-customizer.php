<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Returns an array of layout options registered for the theme.
 *
 * @since Hermi 0.1.0
 *
 * @return array
 */
function hermi_layouts() {
	/*
	$layout_options = [
		'layout-content-sidebar' => [
			'value' => 'layout-content-sidebar',
			'label' => __( 'Content on left, sidebar on right', 'hermi' ),
		],
		'layout-sidebar-content' => [
			'value' => 'layout-sidebar-content',
			'label' => __( 'Content on right, sidebar on left', 'hermi' ),
		],
		'layout-content-only' => [
			'value' => 'layout-content-only',
			'label' => __( 'Content only, no sidebar', 'hermi' ),
		],		
	];
	*/


	// We will use the same layouts for both post archives and post single pages,
	// but it's possible to change the settings so that separate layouts are used
	// for single and archive templates.
	$post_single_and_archives = [
		'layout-content-sidebar' => [
			'value' => 'layout-content-sidebar',
			'label' => __( 'Content on left, sidebar on right', 'hermi' ),
		],
		'layout-sidebar-content' => [
			'value' => 'layout-sidebar-content',
			'label' => __( 'Content on right, sidebar on left', 'hermi' ),
		],
		'layout-container-wide' => [
			'value' => 'layout-container-wide',
			'label' => __( 'Content in wide container', 'hermi' ),
		],
		'layout-container-narrow' => [
			'value' => 'layout-container-narrow',
			'label' => __( 'Content in narrow container on larger screens', 'hermi' ),
		],
		'layout-full-width' => [
			'value' => 'layout-full-width',
			'label' => __( 'Content expands to fill viewport', 'hermi' ),
		],
	];
	
	// Post archives context
	$layouts['post-archive'] = $post_single_and_archives;
	
	// Single post context
	$layouts['post-single'] = $post_single_and_archives;
	
	return apply_filters( 'hermi_layouts', $layouts );
}

/**
 * Helper function: Get the layout for a particular context.
 *
 * @since Hermi 0.1.0
 *
 * @param $context string Name of context to get layouts for. E.g. post-archive
 * @return string | false
 */
function hermi_get_layout( $context ) {

	switch ( $context ) {
		case ( 'post-archive' ) :
			return get_theme_mod( 'layout_blog_archives', 'layout-content-sidebar' );
		break;
	
		case ( 'post-single' ) :
			return get_theme_mod( 'layout_blog_single', 'layout-content-sidebar' );
		break;
	}
	
	return false;	
}

/**
 * This code is related to setting up the Customizer.
 * JavaScript functions used to update the admin are in /themename/js/theme-customizer.js
 * The code that outputs the results of the customizations is /themename/includes/template.php
 *
 */
class Hermi_Theme_Customizer {

	public static function register( WP_Customize_Manager $wp_customize ) {
		// Get all template layout options.
		$layouts = hermi_layouts();
		
		// Set up choices for post archive layouts
		$layouts_post_archive = $layouts['post-archive'];
		$choices_post_archive = array();
		foreach ( $layouts_post_archive as $layout ) {
			$choices_post_archive[ $layout['value'] ] = $layout['label'];
		}
		
		// Set up choices for post single layouts
		$layouts_post_single  = $layouts['post-single'];
		$choices_post_single  = array();
		foreach ( $layouts_post_single as $layout ) {
			$choices_post_single[ $layout['value'] ] = $layout['label'];
		}

		/**
		 * Layout section
		 * ----------------------------------------------------------------------------
		 */	
		$wp_customize->add_section( 'hermi_layout', [
			'title'    => __( 'Blog Layout', 'hermi' ),
			'priority' => 90,
		] );
		
		// Layout - Blog Archives
		$wp_customize->add_setting( 'layout_blog_archives', [
			'default'           => hermi_get_layout( 'archives' ),
			'sanitize_callback' => 'sanitize_key',
		] );
		
		$wp_customize->add_control( 'layout_blog_archives', [
			'label'    => __( 'Blog archives layout', 'hermi' ),
			'section'    => 'hermi_layout',
			'type'       => 'radio',
			'choices'    => $choices_post_archive,
		] );
		
		// Layout - Blog Single
		$wp_customize->add_setting( 'layout_blog_single', [
			'default'           => hermi_get_layout( 'single' ),
			'sanitize_callback' => 'sanitize_key',
		] );
		
		$wp_customize->add_control( 'layout_blog_single', [
			'label'    => __( 'Default blog single template', 'hermi' ),
			'section'    => 'hermi_layout',
			'type'       => 'radio',
			'choices'    => $choices_post_single,
		] );
		
		/**
		 * Logos section
		 * ----------------------------------------------------------------------------
		 */	
		$wp_customize->add_section( 'logos', [
			'title'    => __( 'Logos', 'hermi' ),
			'priority' => 41,
		] );
		
		// Large logo
		$wp_customize->add_setting( 'logo_image_large', [
			'default'  => false,
			'sanitize_callback' => 'esc_url',
		] );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image_large', array(
			'label'      => __( 'Logo Image (large)', 'hermi' ),
			'section'    => 'logos',
			'settings'   => 'logo_image_large',
		) ) );
		
		// Small logo
		$wp_customize->add_setting( 'logo_image_small', [
			'default'  => false,
			'sanitize_callback' => 'esc_url',
		] );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image_small', array(
			'label'      => __( 'Logo Image (small)', 'hermi' ),
			'section'    => 'logos',
			'settings'   => 'logo_image_small',
		) ) );
		

		/*
		$wp_customize->add_panel('mypanel', array(
				'title'         => __('My awesome panel', 'domain'),
				'description'   => __("This is the description which doesn't want to show up :( ...Until the question mark is clicked :-D", 'domain'),
				'capability'    => 'edit_theme_options',
				'priority'      => 2
		));
		
		$wp_customize->add_section('mysection', array(
				'title'    => __('My even more awesome section', 'domain'),
				'panel'    => 'mypanel',
				'description' => __('Section description which does show up', 'domain')
		));

		$wp_customize->add_setting('mysetting', array(
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
				));

		$wp_customize->add_control('mycontrol', array(
				'settings'          => 'mysetting',
				'label'   => __('The most awesome control', 'domain'),
				'section' => 'mysection',
				'type'    => 'text'
		));
		*/
		
/*
		$wp_customize->add_section( 'intro', array (
			'title'    => __( 'intro', 'hermi' ),
			'priority' => 999,
		) );

		$wp_customize->add_setting( 'intro_page' , array(
			'sanitize_callback' => 'absint',
			'transport' => 'postMessage'
		) );

		$wp_customize->add_control( 'intro_page', array(
			'label'    => __( 'Page to use for intro section', 'veritas' ), 
			'section'  => 'intro',
			'settings' => 'intro_page',
			'type'     => 'dropdown-pages',
			'priority' => 1
		) );

    $wp_customize->selective_refresh->add_partial( 'intro_page', array(
        'selector' => '.cta-wrap',
        'container_inclusive' => true,
        'render_callback' => 'wpse247234_cta_block',
				'fallback_refresh' => false,
    ) );
	*/	
	}

	/**
	 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since Hermi 0.1.0
	 */
	public static function enqueue_js() {
		wp_enqueue_script( 'hermi-theme-customizer-js', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), HERMI_VERSION, true );
	}
	
	
	// Load up custom styles for customizer.
	public static function enqueue_css() {
		wp_enqueue_style( 'hermi-theme-customizer-css', get_template_directory_uri() . '/css/theme-customizer.css' );
	}
}
add_action( 'customize_register', [ 'Hermi_Theme_Customizer' , 'register' ] );
//add_action( 'customize_preview_init', array( 'Hermi_Theme_Customizer' , 'enqueue_js' ) );
//add_action( 'customize_controls_enqueue_scripts', array( 'Hermi_Theme_Customizer' , 'enqueue_css' ) );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_customize_preview_js() {
	wp_enqueue_script( 'mytheme-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), true, true );
}
//add_action( 'customize_preview_init', 'twentysixteen_customize_preview_js' );
