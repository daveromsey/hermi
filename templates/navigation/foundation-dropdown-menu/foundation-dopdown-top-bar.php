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
		<?php do_action( 'hermi_foundation_top_bar_nav' ); ?>
	</div>
	
</div>