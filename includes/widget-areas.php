<?php
/**
 * Register our sidebars (widgetized areas).
 *
 * @since Hermi 0.1.0
 * @return void
 */
add_action( 'widgets_init', 'hermi_widgets_init' );
function hermi_widgets_init() {
	// Main widget area used for blog and pages.
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'hermi' ),
		'id'            => 'main-widget-area',
		'description'   => __( 'This is the main widget are used by the theme.', 'hermi' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer Area 1
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 1', 'hermi' ),
		'id'            => 'footer-widget-area-1',
		'description'   => __( 'Footer column 1 widget area.', 'hermi' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	

	// Footer Area 2
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 2', 'hermi' ),
		'id'            => 'footer-widget-area-2',
		'description'   => __( 'Footer column 2 widget area.', 'hermi' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );		

	// Footer Area 3
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 3', 'hermi' ),
		'id'            => 'footer-widget-area-3',
		'description'   => __( 'Footer column 3 widget area.', 'hermi' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );	
}