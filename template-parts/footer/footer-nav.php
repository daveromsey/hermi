<?php
/**
 * Template part used for displaying the navigation menu in the footer.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
		
<div class="footer-nav-wrap">
	<div class="footer-nav-row row">
		<div class="large-12 columns">
		
			<nav class="footer-nav">
				<?php
					wp_nav_menu( array(
						'menu_class'     => 'menu-nav menu menu-footer',
						'theme_location' => 'footer',
						'container'      => false,
					));
				?>
			</nav>
			
		</div><!-- .columns -->
	</div><!-- .row -->
</div><!-- .footer-nav-wrap -->
