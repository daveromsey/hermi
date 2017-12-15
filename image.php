<?php
/**
 * Image attachment template.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<div class="layout-image">
		<div class="layout-grid">
		
			<div class="layout-primary">
				<?php get_template_part( 'templates/parts/image/loop', 'image' ); ?>
			</div><!-- .layout-primary -->
			
		</div><!-- .layout-grid -->
	</div><!-- .layout-image -->

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
