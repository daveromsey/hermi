<?php
/**
 * The template part for displaying a post in a narrow container.
 *
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
		<?php get_template_part( 'templates/parts/post/common/entry-header-container-narrow' ); ?>
	</header><!-- .entry-header -->

	<?php do_action( 'hermi_entry_content_before' ); ?>
	<div class="entry-content grid-container">
		<div class="grid-x align-center">
			<div class="cell large-8 medium-9 small-12">

			<?php
				do_action( 'hermi_entry_content_top' );

				if ( is_search() ) {
					the_excerpt();
				}	else {
					the_content( hermi_read_more_link() );
					wp_link_pages();
				}

				do_action( 'hermi_entry_content_bottom' );
			?>

			</div><!-- .cell .large-8 .medium-9 .small-12-->
		</div><!-- .grid-x -->		
	</div><!-- .entry-content -->
	<?php do_action( 'hermi_entry_content_after' ); ?>

	<footer class="entry-footer">
		<?php get_template_part( 'templates/parts/post/common/entry-footer-container-narrow' ); ?>
	</footer><!-- .entry-footer -->

	<?php do_action( 'hermi_entry_bottom' ); ?>
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>