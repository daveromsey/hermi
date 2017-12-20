<?php
/**
 * The archive template for the cptdemo post type.
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

		<div class="layout-grid">
			<div class="layout-grid">
			
				<div class="layout-primary">
					<?php get_template_part( 'templates/parts/post-type/cptdemo/archive-loop' ); ?>
				</div><!-- .layout-primary -->
				
			</div><!-- .layout-grid -->
		</div><!-- .layout-grid -->

	<?php do_action( 'hermi_content_inner_bottom' ); ?>
</div><!-- .site-content-inner -->
<?php do_action( 'hermi_content_inner_after' ); ?>

<?php get_footer(); ?>
