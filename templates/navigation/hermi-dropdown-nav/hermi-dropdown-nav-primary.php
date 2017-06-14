<?php 
/**
 * Template part for displaying the primary dropdown navigation menus.
 *
 * @package Hermi
 * @subpackage Hermi/Dropdown Menu
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<nav class="nav-primary hermi-dropdown-nav horizontal">
	<?php
		do_action( 'hermi_dropdown_nav_primary_top' );
					
		if ( has_nav_menu( 'primary-left' ) ) {
			wp_nav_menu( [
				'theme_location' => 'primary-left',
				'fallback_cb'    => '__return_false',
				'container'      => false,
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>', // Note, id attribute has been removed.
				'menu_class'     => 'menu-left menu',
				//'link_before'    => '<span>', // This helps with styling for an underline effect.
				//'link_after'     => '</span>',
			] );
		}
		
		/*
		// (unused) Example of adding center menu
		if ( has_nav_menu( 'primary-center' ) ) {
			wp_nav_menu( [
				'theme_location' => 'primary-center',
				'fallback_cb'    => '__return_false',
				'container'      => false,
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>', // Note, id attribute has been removed.
				'menu_class'     => 'menu-center menu',
				//'link_before'    => '<span>', // This helps with styling for an underline effect.
				//'link_after'     => '</span>',
			] );
		}
		*/
		
		do_action( 'hermi_dropdown_nav_nav_primary_middle' );
		
		if ( has_nav_menu( 'primary-right' ) ) {
			wp_nav_menu( [
				'theme_location' => 'primary-right',
				'fallback_cb'    => '__return_false',
				'container'      => false,
				'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
				'menu_class'     => 'menu-right menu',
			] );
		}
		
		do_action( 'hermi_dropdown_nav_primary_bottom' );
	?>
</nav><!-- .nav-primary .hermi-dropdown-nav -->
