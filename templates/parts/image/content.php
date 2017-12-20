<?php
/**
 * The template part for displaying content for image attachments.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$attachment_size_w    = apply_filters( 'hermi_attachment_size_w', $GLOBALS['content_width'] ); // Filterable width.
$attachment_size_h    = apply_filters( 'hermi_attachment_size_h', 800 ); // Filterable height
$attachment_src_thumb = wp_get_attachment_image_src( get_the_ID(), [ $attachment_size_w, $attachment_size_h ] );
$attachment_src_full  = wp_get_attachment_image_src( get_the_ID(), 'full' );
?>

<?php do_action( 'hermi_entry_before' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'hermi_entry_top' ); ?>

	<?php
		 /* Header is not used here by default.
		<header class="entry-header">
		</header><!-- .entry-header --> */
	?>

	<?php do_action( 'hermi_entry_content_before' ); ?>	
	<div class="entry-content grid-container">

		<div class="grid-x align-center">
			<div class="cell small-12">
				<?php do_action( 'hermi_entry_content_top' ); ?>

				<div class="attachment-image">
					<div class="attachment-image-inner">
						
						<div class="attachment-image-wrap">
							<a href="<?php echo ( esc_url( $attachment_src_full[0] ) ); ?>">
								<img src="<?php echo ( esc_url( $attachment_src_thumb[0] ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" width="<?php
									echo ( esc_attr( $attachment_src_thumb[1] ) ); ?>" height="<?php echo ( esc_attr( $attachment_src_thumb[2] ) ); ?>" />
							</a>
						</div><!-- .attachment-image-wrap -->
						
						<?php if ( ! empty ( $post->post_excerpt ) ) { ?>
							<div class="entry-caption wp-caption-text">
								<?php echo wp_kses_post( wptexturize( $post->post_excerpt ) ); ?>
							</div><!-- .entry-caption -->
						<?php } ?>

						<div class="attachment-title">
							<h1 class="attachment-title-heading">
								<?php echo hermi_has_title() ? wp_kses_post( get_the_title() ) : _e( '(Untitled)', 'hermi' ); ?>
							</h1>
						</div><!-- .attachment-title -->

					</div><!-- .attachment-image-inner -->
				</div><!-- .attachment-image -->
			
				<?php do_action( 'hermi_entry_content_bottom' ); ?>
			</div><!-- .cell .small-12 -->
		</div><!-- .grid-x -->

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
