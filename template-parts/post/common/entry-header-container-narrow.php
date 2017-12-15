<?php
/**
 * Template part for outputting contents of <header> for an entry.
 */

// Sticky/Featured post banner.
if ( is_sticky() && is_home() && ! is_paged() ) {  
	get_template_part( 'template-parts/post/archive/entry-sticky-message-container-narrow' );
}

// Featured image.
if ( ! is_search() ) {
	get_template_part( 'template-parts/common/entry-featured-image-container' );
}

// Post Title.
get_template_part( 'template-parts/common/entry-title-container-narrow' );

// Primary post meta. E.g.: Date/author/comment links
if ( 'post' === get_post_type() && ! is_search() ) {
	get_template_part( 'template-parts/post/common/entry-meta-primary-container-narrow' );
}
