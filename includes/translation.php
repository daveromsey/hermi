<?php
/**
 * Make theme available for translation.
 *
 * @Since 0.1.0
 */
add_action( 'after_setup_theme', 'hermi_translation' );
function hermi_translation() {
	// Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'hermi', get_template_directory() . '/includes/languages' );
}
