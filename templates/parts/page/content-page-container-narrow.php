<?php
/**
 * The template part for displaying content in a wide container on a page.
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
		<?php get_template_part( 'templates/parts/page/entry-header-title-container-narrow' ); ?>
	</header><!-- .entry-header -->

	<?php do_action( 'hermi_entry_content_before' ); ?>
	<div class="entry-content">
	
		<div class="grid-container">
			<div class="grid-x align-center">
				<div class="cell large-8 medium-9 small-12">
					<?php
						do_action( 'hermi_entry_content_top' );

						the_content();
						wp_link_pages();
						
						do_action( 'hermi_entry_content_bottom' );
					?>		
				</div><!-- .cell .large-8 .medium-9 .small-12-->
			</div><!-- .grid-x -->
		</div><!-- .grid-container -->
		
	</div><!-- .entry-content -->
	<?php do_action( 'hermi_entry_content_after' ); ?>

	<?php do_action( 'hermi_entry_bottom' ); ?>
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>