<?php
/**
 * Template part for displaying the loop for image attachments.
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

		do_action( 'hermi_content_top_type-attachment-image' );
		if ( have_posts() ) :

			do_action( 'hermi_content_while_before' );
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/image/content', 'image' );

			endwhile;
			do_action( 'hermi_content_while_after' );

		endif;
		do_action( 'hermi_content_bottom_type-attachment-image' );

		do_action( 'hermi_content_bottom' );
	?>
</main><!-- .main-content -->
<?php do_action( 'hermi_content_after' ); ?>