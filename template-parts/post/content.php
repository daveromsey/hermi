<?php
/**
 * The default template for post content.
 *
 * For posts without an assigned format, this file will be used. 
 * It can be overridden by child theme.
 *
 * To create a post format-specific template, add a content-{format-name}.php file to your 
 * child theme's /template-parts/post/ directory. 
 *
 * @link http://dougal.gunters.org/blog/2010/12/10/smarter-post-formats/
 *
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'hermi_entry_before' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action( 'hermi_entry_header' ); ?>

	<?php do_action( 'hermi_entry_content_before' ); ?>
	<div class="entry-content">
		<div class="row">
			<div class="small-12 columns">
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
			</div><!-- .columns -->
		</div><!-- .row -->
	</div><!-- .entry-content -->
	<?php do_action( 'hermi_entry_content_after' ); ?>
	
	<?php do_action( 'hermi_entry_footer' ); ?>
	
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>
