<?php 
/*
 * Allows screen readers to skip over navigation and go straight to content.
 */ 

// Exit if accessed directly 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<a class="skip-link screen-reader-text" tabindex="2" href="#content"><?php esc_html_e( 'Skip to content', 'hermi' ); ?></a>