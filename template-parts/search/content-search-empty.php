<?php
/**
 * The template part for displaying the result of a search which returned no results.
 *
 *
 * @since Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'hermi_entry_before' ); ?>
<article id="post-0" <?php post_class( [ 'hentry', 'no-results' ] ); ?>>
	<?php do_action( 'hermi_entry_top' ); ?>
	
	<header class="entry-header">
		<div class="entry-title-wrap">
			<div class="row">
				<div class="small-12 columns">
					<h1 class="entry-title"><?php _e( 'No results found.', 'hermi' ); ?></h1>
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->

	<?php do_action( 'hermi_entry_content_before' ); ?>
	<div class="entry-content">
		<div class="row">
			<div class="small-12 columns">
				<p class="content-not-found-message">
					<?php
						do_action( 'hermi_entry_content_top' );
						
						_e( 'Please try searching  again.', 'hermi' );
						
						do_action( 'hermi_entry_content_bottom' );
					?>
				</p>
			</div>
		</div>
	</div><!-- .entry-content -->
	<?php do_action( 'hermi_entry_content_after' ); ?>
	
	<footer class="entry-footer">
		<div class="entry-not-found-search-wrap">
			<div class="row">
				<div class="large-12 columns">
					<p>
						<?php get_search_form(); // Loads the searchform.php template. ?>
					</p>
				</div>
			</div>
		</div>	
	</footer><!-- .entry-footer -->

	<?php do_action( 'hermi_entry_bottom' ); ?>	
</article><!-- #post-0 -->
<?php do_action( 'hermi_entry_after' ); ?>


