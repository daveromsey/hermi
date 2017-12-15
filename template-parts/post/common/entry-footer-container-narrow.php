<?php
/**
 * Template part for outputting contents of <footer> for a post entry using a narrow container.
 */
 
if ( 'post' === get_post_type() && ! is_search() ) {
	get_template_part( 'template-parts/post/common/entry-meta-secondary-container-narrow' );
}
