<?php 
	if ( has_nav_menu( 'secondary-left' ) ) {
		wp_nav_menu( [
			'theme_location' => 'secondary-left',
			'container'      => false,
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>', // Note, id attribute has been removed.
			'menu_class'     => 'menu-left menu',
			'fallback_cb'    => false,
			//'link_before'    => '<span>', // This helps with styling for an underline effect.
			//'link_after'     => '</span>',
		] );
	}
	
	if ( has_nav_menu( 'secondary-right' ) ) {
		wp_nav_menu( [
			'theme_location' => 'secondary-right',
			'container'      => false,
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'menu_class'     => 'menu-right menu',
			'fallback_cb'    => false,
		] );
	}