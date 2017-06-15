<?php
/**
 * Customize wp-login.php.
 * 
 */

// Calling your own login css so you can style it
add_action( 'login_enqueue_scripts', 'hermi_log_in_styles', 10 );
function hermi_log_in_styles() {
	wp_enqueue_style(
		'hermi-log-in-styles',
		get_template_directory_uri() . '/assets/dist/css/log-in' . hermi_get_script_suffix() . '.css',
		array(),
		HERMI_VERSION
	);
}

// changing the logo link from wordpress.org to your site
add_filter( 'login_headerurl', 'hermi_log_in_url' );
function hermi_log_in_url() {
	return home_url();
}

// changing the alt text on the logo to show your site name
add_filter( 'login_headertitle', 'hermi_log_in_title' );
function hermi_log_in_title() {
	return get_bloginfo( 'name' );
}
