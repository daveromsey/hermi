<?php
/**
 * Layout for showing posts in a narrow container on larger screens.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ ?>

<div class="layout-container-narrow">
	
	<div class="layout-primary">
		<?php get_template_part( 'templates/parts/post/loop-post', 'container-narrow' ); ?>
	</div><!-- .layout-primary -->
		
</div><!-- .layout-container-narrow -->