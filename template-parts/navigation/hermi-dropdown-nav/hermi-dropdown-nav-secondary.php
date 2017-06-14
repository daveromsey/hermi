<?php
/**
 * Template part for displaying the secondary dropdown menu.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
 
<nav class="nav-secondary hermi-dropdown-nav horizontal">
	<?php 
		do_action( 'hermi_dropdown_nav_secondary_top' );
					
		if ( has_nav_menu( 'secondary-left' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'secondary-left',
				'fallback_cb'    => '__return_false',
				'container'      => false,
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>', // Note, id attribute has been removed.
				'menu_class'     => 'menu-left menu',
				//'link_before'    => '<span>', // This helps with styling for an underline effect.
				//'link_after'     => '</span>',
			) );
		}
		
		do_action( 'hermi_dropdown_nav_secondary_middle' );
		
		if ( has_nav_menu( 'secondary-right' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'secondary-right',
				'fallback_cb'    => '__return_false',
				'container'      => false,
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
				'menu_class'     => 'menu-right menu',
			) );
		}
		
		do_action( 'hermi_dropdown_nav_secondary_bottom' );
	?>
</nav><!-- .nav-secondary .hermi-dropdown-nav -->	
