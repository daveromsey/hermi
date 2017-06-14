<div class="off-canvas position-left" id="off-canvas" data-off-canvas data-position="left">
	<button class="close-button" aria-label="Close menu" type="button" data-close="">
		<span aria-hidden="true">×</span>
	</button>
	<?php
		if ( has_nav_menu( 'mobile-nav' ) ) {
			wp_nav_menu( [
				'theme_location' => 'mobile-nav',    // Where it's located in the theme
				'container'      => false,           // Remove nav container
				'menu_class'     => 'vertical menu', // Adding custom nav class
				'fallback_cb'    => false,           // Fallback function
				'walker'         => new Off_Canvas_Menu_Walker(),
				'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
			] );
		}
	?>
</div>