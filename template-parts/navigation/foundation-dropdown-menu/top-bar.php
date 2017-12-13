<?php 
/**
 * Template part for displaying the Top Bar.
 */ ?>	
<div id="top-bar-menu" class="top-bar">

	<div class="top-bar-title">
		<!-- Off-canvas menu trigger -->
		<span data-responsive-toggle="responsive-menu" data-hide-for="medium">
			<span class="menu-icon dark" data-toggle="off-canvas"></span>
		</span>
		
		<div class="title-bar-title menu-text">
			<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
		</div>
	</div>
	
	<div class="top-bar-nav">
		<?php get_template_part( 'template-parts/navigation/foundation-dropdown-menu/wp-nav-menu' ); ?>
	</div>
	
</div><!-- top-bar -->