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

do_action( 'hermi_comments_top' );
if ( have_comments() ) { ?>

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
		<nav class="pagination-comments pagination-container comments-pagination-top">
			<?php get_template_part( 'templates/parts/comments/pagination-comments' ); ?>
		</nav>
	<?php } ?>

	<ol class="commentlist">
		<?php
			wp_list_comments( [
				'callback' => apply_filters( 'hermi_list_comments_callback_name', 'hermi_list_comments' ),
			] );
		?>
	</ol>
<?php } ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
	<nav class="pagination-comments pagination-container comments-pagination-bottom">
		<?php get_template_part( 'templates/parts/comments/pagination-comments' ); ?>
	</nav>
<?php } ?>			

<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
	<p class="comments-closed"><?php _e( 'Comments are closed.', 'hermi' ); ?></p>
<?php } ?>

<?php
	comment_form( [
		'title_reply' => __( 'Reply', 'hermi' ),
		//'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
		//'title_reply_after'  => '</h2>',					
	] );
	
do_action( 'hermi_comments_bottom' );
