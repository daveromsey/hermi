<?php
/**
 * Template Name: Narrow Content Width
 *
 * Content is contained within a narrow grid cell on larger screens.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<div class="layout-grid-narrow">
		<div class="layout-primary">
			<?php get_template_part( 'templates/parts/post-type/page/loop' ); ?>
		</div>
	</div><!-- .layout-grid-narrow -->
		
	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
