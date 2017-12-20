<?php
/**
 * Template part for outputting the <header> for a cptdemo entry.
 */ ?>

<header class="entry-header">
	<?php 
		if ( ! is_search() ) {
			get_template_part( 'templates/parts/common/entry-featured-image' );
		}

		get_template_part( 'templates/parts/common/entry-title' );
	?>
</header><!-- .entry-header -->
