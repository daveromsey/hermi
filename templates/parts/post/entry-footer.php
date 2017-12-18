<?php
/**
 * Template part for outputting contents of <footer> for a post entry.
 * This template pulls in template parts using the default, wide container.
 */ ?>

<footer class="entry-footer">
	<?php
		if ( 'post' === get_post_type() && ! is_search() ) {
			get_template_part( 'templates/parts/post/entry-meta-secondary-container' );
		}
	?> 
</footer><!-- .entry-footer -->
