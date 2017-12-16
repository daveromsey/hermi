<?php
/**
 * Layout for showing posts in a standard grid.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ ?>

<div class="layout-grid">
	
	<div class="layout-primary">
		<?php get_template_part( 'templates/parts/post/archive/loop-archive', 'grid' ); ?>
	</div><!-- .layout-primary -->
		
</div><!-- .layout-grid -->