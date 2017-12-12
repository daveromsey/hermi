<?php
/**
 * The default template for post content.
 *
 * For posts without an assigned format, this file will be used.
 *
 * To create a post format-specific template, add a content-{format-name}.php file to your
 * child theme's /template-parts/post/ directory.
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
		<?php get_template_part( 'template-parts/post/entry-header' ); ?>
	</header><!-- .entry-header -->

	<?php do_action( 'hermi_entry_content_before' ); ?>
	<div class="entry-content">
	
		<div class="grid-x">
			<div class="cell small-12">
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
			</div><!-- .cell .small-12 -->
		</div><!-- .grid-x -->
		
	</div><!-- .entry-content -->
	<?php do_action( 'hermi_entry_content_after' ); ?>

	<footer class="entry-footer">
		<?php get_template_part( 'template-parts/post/entry-footer' ); ?>
	</footer><!-- .entry-footer -->

	<?php do_action( 'hermi_entry_bottom' ); ?>
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>
