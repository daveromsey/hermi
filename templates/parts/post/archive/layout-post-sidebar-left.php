<?php
/**
 * Layout with a sidebar on the left side when viewing larger screens.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ ?>

<div class="layout-sidebar-content grid-container">

	<div class="grid-x">

		<div class="layout-primary cell small-12 large-9 large-order-1">
			<?php get_template_part( 'templates/parts/post/archive/loop-archive', 'grid' ); ?>
		</div><!-- .layout-primary -->

		<div class="layout-secondary cell small-12 large-3 large-order-0">
			<?php get_template_part( 'templates/parts/sidebar/sidebar', 'main' ); ?>
		</div><!-- .layout-secondary -->
		
	</div><!-- .grid-x -->
</div><!-- .layout-content-sidebar .grid-container -->