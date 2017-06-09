<?php
/**
 * The default template for post content.
 *
 * A note about Post Formats:
 * To create a post format-specific template, add a format-{format-name}.php file to your child theme's
 * theme-name/templates/content/ directory.
 * For posts without an assigned format, the format.php template will be used (this file). It can be overridden by child theme too.
 *
 * Additional reading on post formats:
 *   @link http://www.rvoodoo.com/projects/wordpress/wordpress-tip-post-formats-get-template-part-loop-php-and-maximum-child-theme-compatibility/
 *   @link http://dougal.gunters.org/blog/2010/12/10/smarter-post-formats/
 *
 * @since Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'hermi_entry_before' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php do_action( 'hermi_entry_header_type_post' ); ?>
	</header><!-- .entry-header -->
	
	
	<div class="entry-content-wrap">
	
		<div class="row"><!-- entry-content-wrap-row -->
			<div class="large-12 columns"><!-- entry-content-wrap-columns -->
			
				<?php do_action( 'hermi_entry_content_before' ); ?>
				<div class="entry-content">
					<?php
						if ( is_search() ) {
							the_excerpt();
						} else {
							the_content( hermi_read_more_link() );
							wp_link_pages();
						}
					?>
				</div><!-- .entry-content -->
				<?php do_action( 'hermi_entry_content_after' ); ?>
		
			</div><!-- .entry-content-wrap-columns -->
		</div><!-- .entry-content-wrap-row -->
		
	</div><!-- .entry-content-wrap -->

	
	<footer class="entry-footer">
		<?php do_action( 'hermi_entry_footer_type_post' ); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-{id} -->
<?php do_action( 'hermi_entry_after' ); ?>
