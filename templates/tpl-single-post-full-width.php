<?php
/**
 * Template Name: Full Width
 * Template Post Type: post
 *
 * Full width content template for Posts. Content will expand to fill the viewport.
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
			<?php get_template_part( 'templates/parts/post-type/post/single-loop', 'full-width' ); ?>
		</div><!-- .layout-primary -->
			
	</div><!-- .layout-full-width -->
			
	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
