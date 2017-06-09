<?php
/**
 * The template for displaying comments.
 * This is roughly based on Twenty Sixteen's comments.php
 *
 * This template handles the area of the page that contains both current comments
 * and the comment form. The actual display of comments is handled by hermi_list_comments()
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<?php do_action( 'hermi_comments_before' ); ?>
<div id="comments" class="entry-comments">

	<div class="row">
		<div class="large-12 columns">
			<?php do_action( 'hermi_comments_top' ); ?>

			<?php if ( have_comments() ) { ?>
			
				<h2 class="comments-title">
					<?php
						$comments_number = get_comments_number();
						if ( 1 === $comments_number ) {
							/* translators: %s: post title */
							printf( _x( 'One comment on &ldquo;%s&rdquo;', 'comments title', 'hermi' ), get_the_title() );
						} else {
							printf(
								/* translators: 1: number of comments, 2: post title */
								_nx(
									'%1$s comment on &ldquo;%2$s&rdquo;',
									'%1$s comments on &ldquo;%2$s&rdquo;',
									$comments_number,
									'comments title',
									'hermi'
								),
								number_format_i18n( $comments_number ),
								get_the_title()
							);
						}
					?>
				</h2>

				
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
					<nav class="comment-pagination-nav comment-nav-top">
						<?php hermi_comment_nav_links(); ?>
					</nav>
				<?php } ?>

				<ol class="commentlist">
					<?php
						wp_list_comments( array (
							'callback' => apply_filters( 'hermi_list_comments_callback_name', 'hermi_list_comments' ),
						) );
					?>
				</ol>
			<?php } ?>
			
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
				<nav class="comment-pagination-nav comment-nav-bottom">
					<?php hermi_comment_nav_links(); ?>
				</nav>
			<?php } ?>			

			
			<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
				<p class="comments-closed"><?php _e( 'Comments are closed.', 'hermi' ); ?></p>
			<?php } ?>			

			<?php
				comment_form( array( 
					'title_reply' => __( 'Reply', 'hermi' ),
					//'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
					//'title_reply_after'  => '</h2>',					
				) );
			?>
			
			<?php do_action( 'hermi_comments_bottom' ); ?>
		</div><!-- .large-12 .columns -->
	</div><!-- .row -->
	
</div><!-- #comments -->
<?php do_action( 'hermi_comments_after' ); ?>