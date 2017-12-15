<?php
/**
 * Template part for comments container using narrow grid for larger screens.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password, we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

/**
 * Bail if comments should not be shown. This logic is copied from comments_template()
 * because this container should only be displayed if comments are displayed.
 */ 
global $withcomments, $post;
if ( ! ( is_single() || is_page() || $withcomments ) || empty( $post ) ) {
	return;
}	
?>

<?php do_action( 'hermi_comments_before' ); ?>
<div id="comments" class="entry-comments grid-container">

	<div class="grid-x align-center">
		<div class="cell large-8 medium-9 small-12">
			<?php comments_template( './templates/parts/comments/comments.php', true ); ?>
		</div><!-- .cell .large-8 .medium-9 .small-12-->
	</div><!-- .grid-x -->

</div><!-- #comments .entry-comments .grid-container -->
<?php do_action( 'hermi_comments_after' ); ?>