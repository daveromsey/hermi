<?php
/**
 * Template Name: Full Width
 *
 * A full width page template. Content spans the full width of the viewport.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<div class="layout-full-width">
		
		<div class="layout-primary">
			<?php get_template_part( 'templates/parts/post-type/page/loop', 'full-width' ); ?>
		</div><!-- .layout-primary -->
		
	</div><!-- .layout-full-width -->
			
	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
