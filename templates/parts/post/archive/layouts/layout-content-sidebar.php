<?php
/**
 * Template part for displaying blog archive content on the left and the sidebar on the right.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="layout-content-sidebar">
	<div class="layout-grid">
	
		<div class="layout-primary">
			<?php get_template_part( 'templates/parts/post/archive/loop', 'archive' ); ?>
		</div><!-- .layout-primary -->

		<div class="layout-secondary">
			<?php get_template_part( 'templates/parts/sidebar/sidebar', 'main' ); ?>
		</div><!-- .layout-secondary -->

	</div><!-- .layout-grid -->
</div><!-- .layout-content-sidebar -->