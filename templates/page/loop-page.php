<?php 
/**
 * Template part for displaying the loop for pages.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly 
}
?>

<?php do_action( 'hermi_content_before' ); ?>
<main id="main-content" class="site-main">
	<?php
		do_action( 'hermi_content_top' );
		
		if ( have_posts() ) {
			do_action( 'hermi_content_while_before' );
			while ( have_posts() ) {
				the_post();
				get_template_part( 'templates/page/content', 'page' );
				
				//comments_template( '', true );
			}
			do_action( 'hermi_content_while_after' );
		}
		
		do_action( 'hermi_content_bottom' );
	?>
</main><!-- .main-content -->
<?php do_action( 'hermi_content_after' ); ?>