<?php
/**
 * Template Name: Full Width
 *
 * A full width page template. Content spans the full width of the window.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

		<div class="layout-content-full-width">
			<div class="layout-primary">
				<?php get_template_part( 'template-parts/page/loop', 'page-full-width-no-grid' ); ?>
			</div>
		</div>

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
