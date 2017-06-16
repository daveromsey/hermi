<?php
/**
 * Single template for cptdemo post type.
 *
 * This is a full width template. Content is contained within a large grid row.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

		<div class="layout-content-boxed-large-row">
			<div class="layout-primary">
				<?php get_template_part( 'template-parts/cptdemo/single/loop', 'single' ); ?>
			</div>
		</div>

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
