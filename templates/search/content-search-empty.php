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
<article id="post-0" class="post no-results not-found">

	<header class="entry-header">
		<div class="entry-title-wrap">
			<div class="row">
				<div class="large-12 columns">
					<h1 class="entry-title"><?php _e( 'No results found.', 'hermi' ); ?></h1>
				</div>
			</div>
		</div>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<div class="row">
			<div class="large-12 columns">
				<p class="content-not-found-message">
					<?php
						/*
						printf( '%1$s<span class="search-terms">%2$s</span>%3$s',
										__( 'The search for ', 'hermi' ),
										esc_html( get_search_query() ),
										__( ' returned no results.', 'hermi' )
						);
					*/ ?>
				</p>
			</div>
		</div>
	</div><!-- .entry-content -->


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

</article><!-- #post-0 -->
<?php do_action( 'hermi_entry_after' ); ?>