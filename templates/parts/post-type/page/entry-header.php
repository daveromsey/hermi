<?php
/**
 * Template part for outputting a page's <header> element.
 */ ?>

<header class="entry-header">
	<?php 
		if ( ! is_search() ) {
			get_template_part( 'templates/parts/common/entry-featured-image' );
		}

		get_template_part( 'templates/parts/common/entry-title' );
	?>
</header><!-- .entry-header -->
