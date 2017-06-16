<?php
/**
 * The template part for displaying content for the cptdemo post type.
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

	<header class="entry-header">
		<?php get_template_part( 'template-parts/cptdemo/entry-header' ); ?>
	</header><!-- .entry-header -->

	<?php do_action( 'hermi_entry_content_before' ); ?>
	<div class="entry-content">
		<div class="row">
			<div class="small-12 columns">
				<?php
					do_action( 'hermi_entry_content_top' );

					the_content();
					wp_link_pages();

					do_action( 'hermi_entry_content_bottom' );
				?>
			</div><!-- .large-12 .columns -->
		</div><!-- .row -->
	</div><!-- .entry-content -->
	<?php do_action( 'hermi_entry_content_after' ); ?>

	<?php do_action( 'hermi_entry_bottom' ); ?>
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>