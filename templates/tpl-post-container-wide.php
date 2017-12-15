<?php
/**
 * Template Name: Wide Container
 * Template Post Type: post
 *
 * Template for showing posts in a wide grid.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>
	
		<?php get_template_part( 'template-parts/post/layout-post', 'container-wide' ); ?>
			
	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
