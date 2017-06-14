<?php
/**
 * The default template for post content.
 *
 * For posts without an assigned format, this file will be used (format.php). 
 * It can be overridden by child theme.
 *
 * To create a post format-specific template, add a format-{format-name}.php file to your 
 * child theme's /templates/post/ directory. 
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
	
	<?php do_action( 'hermi_entry_content_top' ); ?>	
	<div class="entry-content-wrap">
	
		<div class="row"><!-- entry-content-wrap-row -->
			<div class="large-12 columns"><!-- entry-content-wrap-columns -->
			
				<?php do_action( 'hermi_entry_content_before' ); ?>
				<div class="entry-content">
					<?php
						if ( is_search() ) {
							the_excerpt();
						}	else {
							the_content( hermi_read_more_link() );
							wp_link_pages();
						}
					?>
				</div><!-- .entry-content -->
				<?php do_action( 'hermi_entry_content_after' ); ?>
		
			</div><!-- .entry-content-wrap-columns -->
		</div><!-- .entry-content-wrap-row -->
		
	</div><!-- .entry-content-wrap -->
	<?php do_action( 'hermi_entry_content_bottom' ); ?>

	<?php do_action( 'hermi_entry_footer' ); ?>
	
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>
