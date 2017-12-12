<?php
/**
 * Template Name: Sidebar on the Right
 *
 * A page template that has a sidebar on the right side of larger screens.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<div class="layout-content-sidebar">
		<div class="layout-grid">
		
			<div class="layout-primary">
				<?php get_template_part( 'template-parts/page/loop', 'page' ); ?>
			</div><!-- .layout-primary -->

			<div class="layout-secondary">
				<?php get_template_part( 'template-parts/sidebar/sidebar', 'main' ); ?>
			</div><!-- .layout-secondary -->
			
		</div><!-- .layout-grid -->
	</div><!-- .layout-sidebar-content -->

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
