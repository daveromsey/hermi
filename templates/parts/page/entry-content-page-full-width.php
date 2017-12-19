<?php
/**
 * The template part for displaying content within page.
 * This template does not use a grid for the content area.
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

	<?php get_template_part( 'templates/parts/page/entry-header' ); ?>

	<?php do_action( 'hermi_entry_content_before' ); ?>
	<div class="entry-content">
		<?php
			do_action( 'hermi_entry_content_top' ); 
			
			the_content();
			wp_link_pages();
			
			do_action( 'hermi_entry_content_bottom' );
		?>
	</div><!-- .entry-content -->
	<?php do_action( 'hermi_entry_content_after' ); ?>

	<?php
		 /* Footer is not used here by default.
		<footer class="entry-footer">
		</footer><!-- .entry-footer --> */
	?>

	<?php do_action( 'hermi_entry_bottom' ); ?>
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>