<?php 
/**
 * Template part for displaying a featured image container.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Bail if there is no featured image.
if ( ! has_post_thumbnail() ) {
	return;
}	
?>

<div class="featured-image-container grid-container">
	<div class="grid-x align-center">
		<div class="cell small-12">
			<?php	get_template_part( 'template-parts/common/entry-featured-image' ); ?>
		</div><!-- .cell .small-12 -->
	</div><!-- .grid-x -->
</div><!-- .featured-image-container grid-container -->		
