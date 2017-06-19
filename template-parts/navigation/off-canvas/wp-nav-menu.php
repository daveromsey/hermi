<?php
	if ( has_nav_menu( 'mobile-nav' ) ) {
		wp_nav_menu( [
			'theme_location' => 'mobile-nav',    // Where it's located in the theme
			'container'      => false,           // Remove nav container
			'menu_class'     => 'vertical menu', // Adding custom nav class
			'walker'         => new Off_Canvas_Menu_Walker(),
			'fallback_cb'    => false,           // Fallback function used when there are no items to show.
			'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
		] );
	}
