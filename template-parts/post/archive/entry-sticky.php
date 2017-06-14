<?php 
/**
 * Template part for displaying the sticky post message.
 * 
 * Sticky posts are only styled differently on archive pages by design: https://core.trac.wordpress.org/ticket/23559
 */
?>

<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
<div class="entry-sticky-wrap">
	<div class="row">
		<div class="large-12 columns">
			<span class="sticky-post"><?php _e( 'Featured Post', 'hermi' ); ?></span>
		</div>
	</div>
</div>
<?php endif; ?>