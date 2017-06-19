<?php
/**
 * Template part for generating menus for the Foundation Top Bar.
 * 
 */

if ( has_nav_menu( 'main-nav' ) ) {
	wp_nav_menu( [
		'theme_location'  => 'main-nav',
		'walker'          => new Topbar_Menu_Walker(),
		'container'       => 'div',
		'container_class' => 'top-bar-right show-for-medium foundation-dropdown',
		'menu_class'      => 'vertical medium-horizontal menu',
		'fallback_cb'     => false,
		'items_wrap'      => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
	] );
}
