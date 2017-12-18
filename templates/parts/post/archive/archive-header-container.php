<?php
/**
 * Template part for outputting the header container for various post archives.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Bail right away if this isn't one of the following types of archives:
if ( ! is_search()   && 
		 ! is_category() &&
		 ! is_tag()      &&
		 ! is_date()     &&
		 ! is_author() ) {
	return;
}
?>

<header class="archive-header grid-container">

	<div class="grid-x align-center">
		<div class="cell small-12">
			<?php get_template_part( 'templates/parts/post/archive/archive-header' ); ?>
		</div><!-- .grid-x -->
	</div><!-- .cell .small-12 -->

</header><!-- .archive-header -->