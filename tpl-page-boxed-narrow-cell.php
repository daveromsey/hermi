<?php
/**
 * Template Name: Boxed, Narrow Cell
 *
 * Content is contained within a cell more narrow than the wide cell.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<div class="layout-content-narrow">
		<div class="layout-grid">
		
			<div class="layout-primary">
				<?php get_template_part( 'template-parts/page/loop', 'page' ); ?>
			</div>
			
		</div><!-- .layout-grid -->
	</div><!-- .layout-content-narrow -->
		
	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>