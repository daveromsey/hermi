<?php
/**
 * The template part for displaying content for image attachments.
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
	<?php do_action( 'hermi_entry_top' ); ?>
	<?php do_action( 'hermi_entry_top_type-attachment_image' ); ?>
	
	<div class="entry-content">
		<div class="row">
			<div class="large-12 columns">
				<?php
					do_action( 'hermi_entry_content_before' );
					
					the_content();
					
					do_action( 'hermi_entry_content_after' );
				?>
				
			</div><!-- .large-12 .columns -->
		</div><!-- .row -->
	</div><!-- .entry-content -->
	
	<?php do_action( 'hermi_entry_bottom_type-attachment_image' ); ?>
	<?php do_action( 'hermi_entry_bottom' ); ?>
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>