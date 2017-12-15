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

	<div class="layout-container-wide">
		<div class="layout-primary">
			<?php get_template_part( 'template-parts/page/loop-page', 'container-wide' ); ?>
		</div><!-- .layout-primary -->
	</div><!-- .grid-container .layout-container-wide -->

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
