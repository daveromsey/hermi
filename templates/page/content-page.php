<?php
/**
 * The template part for displaying content within page.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'hermi_entry_before' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action( 'hermi_entry_header' ); ?>
	
	<?php do_action( 'hermi_entry_content_top' ); ?>
	<div class="entry-content">
		<div class="row">
			<div class="large-12 columns">
				<?php
					do_action( 'hermi_entry_content_before' );
					
					the_content();
					wp_link_pages();
					
					do_action( 'hermi_entry_content_after' );
				?>
			</div><!-- .large-12 .columns -->
		</div><!-- .row -->
	</div><!-- .entry-content -->
	<?php do_action( 'hermi_entry_content_bottom' ); ?>

	<?php do_action( 'hermi_entry_footer' ); ?>
	
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>