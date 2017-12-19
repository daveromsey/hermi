<?php
/**
 * Template part for outputting the page <header> element.
 */ ?>

<header class="entry-header">
	<?php 
		if ( ! is_search() ) {
			get_template_part( 'templates/parts/common/entry-featured-image-container' );
		}

		get_template_part( 'templates/parts/common/entry-title-container' );
	?>
</header><!-- .entry-header -->
