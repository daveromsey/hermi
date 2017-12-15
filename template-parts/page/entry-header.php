<?php
/**
 * Template part for outputting contents of <header> for entry on a page.
 */

if ( ! is_search() ) {
	get_template_part( 'template-parts/common/entry-featured-image-container' );
}

get_template_part( 'template-parts/common/entry-title-container' );
