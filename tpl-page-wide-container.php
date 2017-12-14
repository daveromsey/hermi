<?php
/**
 * Template Name: Wide Container
 *
 * A full width page template. Content is contained within the large grid cell.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<div class="layout-wide-container">
		<div class="layout-grid">
		
			<div class="layout-primary">
				<?php get_template_part( 'template-parts/page/standard/loop', 'page' ); ?>
			</div><!-- .layout-primary -->
			
		</div><!-- .layout-grid -->
	</div><!-- .layout-wide-container -->

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
