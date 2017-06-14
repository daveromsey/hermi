<?php 
/**
 * Template part for displaying single posts.
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
				get_template_part( 'templates/post/format', hermi_get_post_format_name() );
				
				get_template_part( 'templates/pagination/pagination-single' );
				
				comments_template( '', true );
			}
			do_action( 'hermi_content_while_after' );
		}
		
		do_action( 'hermi_content_bottom_type-post' );
		
		do_action( 'hermi_content_bottom' );
	?>
</main><!-- .main-content -->
<?php do_action( 'hermi_content_after' ); ?>