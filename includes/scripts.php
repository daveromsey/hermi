<?php

/**
 * Enqueue JavaScipt used on the front end of the theme.
 * 
 * @since Hermi 0.1.0
 * @return void
 */
function hermi_scripts() {
	// Add Foundation javascript to the footer.
	wp_enqueue_script( 'foundation-js', 
		get_template_directory_uri() . '/assets/dist/js/foundation' . hermi_get_script_suffix() . '.js',
		array( 'jquery' ),
		HERMI_VERSION,
		true
	);
	
	// Add general javascript used by theme to the footer.
	wp_enqueue_script( 'theme-js',
		get_template_directory_uri() . '/assets/dist/js/scripts' . hermi_get_script_suffix() . '.js',
		array( 'jquery', 'foundation-js' ),
		HERMI_VERSION,
		true
	);
	
	// Load comment reply javascript only when necessary.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && ! is_front_page() ) {
		wp_enqueue_script( 'comment-reply' );
	}
} 
add_action( 'wp_enqueue_scripts', 'hermi_scripts' );