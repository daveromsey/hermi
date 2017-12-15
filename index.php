<?php
/**
 * The main template file.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<?php do_action( 'hermi_content_inner_before' ); ?>
<div id="content-inner" class="site-content-inner">
	<?php do_action( 'hermi_content_inner_top' ); ?>

	<?php
		// Determine which layout to display based on what has been set within the customizer.
		switch ( hermi_get_layout( 'post-archive' ) ) :

			case ( 'layout-content-sidebar' ) :
				get_template_part( 'templates/parts/post/layout-post', 'sidebar-right' );
			break;

			case ( 'layout-sidebar-content' ) :
				get_template_part( 'templates/parts/post/layout-post', 'sidebar-left' );
			break;

			case ( 'layout-container-wide' ) :
				get_template_part( 'templates/parts/post/layout-post', 'container-wide' );
			break;

			case ( 'layout-container-narrow' ) :
				get_template_part( 'templates/parts/post/layout-post', 'container-narrow' );
			break;

			case ( 'layout-full-width' ) :
				get_template_part( 'templates/parts/post/layout-post', 'full-width' ); 
			break;
		endswitch;
	?>

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
