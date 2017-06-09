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
		switch ( hermi_get_layout( 'archives' ) ) :
		
			case ( 'layout-content-sidebar' ) :
				get_template_part( 'templates/post/archive/layouts/layout', 'content-sidebar' );
			break;
			
			case ( 'layout-sidebar-content' ) :
				get_template_part( 'templates/post/archive/layouts/layout', 'sidebar-content' );
			break;

			case ( 'layout-content-only' ) :
				get_template_part( 'templates/post/archive/layouts/layout', 'content-only' );
			break;
			
		endswitch;
	?>
	
	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
