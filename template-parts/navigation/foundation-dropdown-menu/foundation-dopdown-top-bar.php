<?php 
/*
		<div class="top-bar-left">
		
		</div>
		
		<div class="top-bar-right show-for-medium">
			<?php hermi_foundation_dropdown_nav_right(); ?>	
		</div>

*/

 ?>	
<div id="top-bar-menu" class="top-bar">

	<div class="top-bar-title">
		<span data-responsive-toggle="responsive-menu" data-hide-for="medium">
			<span class="menu-icon dark" data-toggle="off-canvas"></span>
		</span>
		
		<div class="title-bar-title menu-text">
			<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
		</div>
	</div>
	
	<div class="top-bar-nav">
		<?php 
			if ( has_nav_menu( 'main-nav' ) ) {
				wp_nav_menu( [
					'theme_location'  => 'main-nav',
					'walker'          => new Topbar_Menu_Walker(),
					'fallback_cb'     => false,
					'container'       => 'div',
					'container_class' => 'top-bar-right show-for-medium foundation-dropdown',
					'menu_class'      => 'vertical medium-horizontal menu',
					'items_wrap'      => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
				] );
			}
		?>
	</div>
	
</div>