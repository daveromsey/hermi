<?php 
/**
 * Template part for displaying a featured image.
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

<div class="featured-image-container">

	<div class="grid-x featured-image-grid">
		<div class="cell small-12 featured-image-cell">
			<?php hermi_featured_image( 'featured_image' ); ?>
		</div>
	</div>
	
</div>			
