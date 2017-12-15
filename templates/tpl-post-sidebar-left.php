<?php
/**
 * Template Name: Sidebar on the Left
 * Template Post Type: post
 *
 * A post template with a sidebar on the left side when viewing larger screens.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<?php get_template_part( 'template-parts/post/layout-post', 'sidebar-left' ); ?>

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>