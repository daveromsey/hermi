<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Returns an array of layout options registered for the theme.
 *
 * @since Hermi 0.1.0
 */
function hermi_layouts() {
	$layout_options = array(
		'layout-content-sidebar' => array(
			'value' => 'layout-content-sidebar',
			'label' => __( 'Content on left, sidebar on right', 'hermi' ),
		),
		'layout-sidebar-content' => array(
			'value' => 'layout-sidebar-content',
			'label' => __( 'Content on right, sidebar on left', 'hermi' ),
		),
		'layout-content-only' => array(
			'value' => 'layout-content-only',
			'label' => __( 'Content only, no sidebar', 'hermi' ),
		),		
	);

	return apply_filters( 'hermi_layouts', $layout_options );
}

/**
 * Helper function: Get the layout for a particular context.
 *
 * @since Hermi 0.1.0
 */
function hermi_get_layout( $context ) {

	switch ( $context ) {
		case ( 'archives' ) :
			return get_theme_mod( 'layout_blog_archives', 'layout-content-sidebar' );
		break;
	
		case ( 'single' ) :
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
		$layouts = hermi_layouts();
		$choices = array();
		
		foreach ( $layouts as $layout ) {
			$choices[ $layout['value'] ] = $layout['label'];
		}
		



		/**
		 * Layout section
		 * ----------------------------------------------------------------------------
		 */	
		$wp_customize->add_section( 'hermi_layout', array(
			'title'    => __( 'Blog Layout', 'hermi' ),
			'priority' => 90,
		) );
		
		// Layout - Blog Archives
		$wp_customize->add_setting( 'layout_blog_archives', array(
			'default'           => hermi_get_layout( 'archives' ),
			'sanitize_callback' => 'sanitize_key',
		) );
		
		$wp_customize->add_control( 'layout_blog_archives', array(
			'label'    => __( 'Blog Archives', 'hermi' ),
			'section'    => 'hermi_layout',
			'type'       => 'radio',
			'choices'    => $choices,
		) );
		
		// Layout - Blog Single
		$wp_customize->add_setting( 'layout_blog_single', array(
			'default'           => hermi_get_layout( 'single' ),
			'sanitize_callback' => 'sanitize_key',
		) );
		
		$wp_customize->add_control( 'layout_blog_single', array(
			'label'    => __( 'Blog Single Pages', 'hermi' ),
			'section'    => 'hermi_layout',
			'type'       => 'radio',
			'choices'    => $choices,
		) );
		
		/**
		 * Logos section
		 * ----------------------------------------------------------------------------
		 */	
		$wp_customize->add_section( 'logos', array (
			'title'    => __( 'Logos', 'hermi' ),
			'priority' => 41,
		) );
		
		// Large logo
		$wp_customize->add_setting( 'logo_image_large', array(
			'default'  => false,
			'sanitize_callback' => 'esc_url',
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image_large', array(
			'label'      => __( 'Logo Image (large)', 'hermi' ),
			'section'    => 'logos',
			'settings'   => 'logo_image_large',
		) ) );
		
		// Small logo
		$wp_customize->add_setting( 'logo_image_small', array (
			'default'  => false,
			'sanitize_callback' => 'esc_url',
		) );
		
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
add_action( 'customize_register', array( 'Hermi_Theme_Customizer' , 'register' ) );
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



