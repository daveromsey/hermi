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

	<div class="layout-primary">
		<?php get_template_part( 'template-parts/post/archive/loop', 'archive' ); ?>
	</div><!-- .layout-primary -->

	<div class="layout-secondary">
		<?php get_template_part( 'template-parts/sidebar/sidebar', 'main' ); ?>
	</div><!-- .layout-secondary -->

</div><!-- .layout-content-sidebar -->
