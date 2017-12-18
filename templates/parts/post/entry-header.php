<?php
/**
 * Template part for outputting contents of <header> for an entry.
 * This template pulls in template parts using the default, wide container.
 */ ?>

<header class="entry-header">
	<?php 
	// Sticky/Featured post banner.
	if ( is_sticky() && is_home() && ! is_paged() ) {  
		get_template_part( 'templates/parts/post/archive/entry-sticky-message-container' );
	}

	// Featured image.
	if ( ! is_search() ) {
		get_template_part( 'templates/parts/common/entry-featured-image-container' );
	}

	// Post Title.
	get_template_part( 'templates/parts/common/entry-title-container' );

	// Primary post meta. E.g.: Date/author/comment links
	if ( 'post' === get_post_type() && ! is_search() ) {
		get_template_part( 'templates/parts/post/entry-meta-primary-container' );
	}
 ?>
</header><!-- .entry-header -->
