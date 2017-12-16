<?php
/**
 * Template part for displaying the container for secondary post meta.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="entry-meta-secondary-container entry-meta-container grid-container">

	<div class="grid-x align-center">
		<div class="cell small-12">
			<?php get_template_part( 'templates/parts/post/entry-meta-secondary' ); ?>
		</div><!-- .cell .small-12 -->
	</div><!-- .grid-x -->
	
</div><!-- .entry-meta-secondary-container .entry-meta-container .grid-container -->
