<?php
/**
 * Template part for outputting contents of <footer> for and entry.
 * 
 */
 
if ( 'post' === get_post_type() && ! is_search() ) {
	get_template_part( 'template-parts/post/entry-meta-secondary' );
}
