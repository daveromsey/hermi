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

<nav class="footer-nav">

	<div class="footer-nav-grid grid-x">
		<div class="cell small-12">
			<?php
				wp_nav_menu( [
					'menu_class'     => 'menu-nav menu menu-footer',
					'theme_location' => 'footer',
					'container'      => false,
				] );
			?>
		</div><!-- .cell .small-12 -->
	</div><!-- .grid-x -->
	
</nav><!-- .footer-nav -->
