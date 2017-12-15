<?php
/**
 * Single template for cptdemo post type.
 *
 * Content is contained within a large grid cell.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<div class="layout-container-wide">
		<div class="layout-grid">
		
			<div class="layout-primary">
				<?php get_template_part( 'template-parts/cptdemo/single/loop', 'single' ); ?>
			</div><!-- .layout-primary -->
			
		</div><!-- .layout-grid -->
	</div><!-- .layout-container-wide -->

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
