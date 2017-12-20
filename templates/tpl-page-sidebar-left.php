<?php
/**
 * Template Name: Sidebar on the Left
 *
 * A page template that has a sidebar on the left side when viewing larger screens.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<div class="layout-sidebar-content grid-container">
	
		<div class="grid-x">
		
			<div class="layout-primary cell small-12 large-9 large-order-1">
				<?php get_template_part( 'templates/parts/post-type/page/loop' ); ?>
			</div><!-- .layout-primary -->

			<div class="layout-secondary cell small-12 large-3 large-order-0">
				<?php get_template_part( 'templates/parts/sidebar/sidebar', 'main' ); ?>
			</div><!-- .layout-secondary -->
			
		</div><!-- .grid-x -->
	</div><!-- .layout-sidebar-content -->

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
