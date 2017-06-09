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
 

<div class="featured-image-row-wrap">

	<div class="row featured-image-row">
		<div class="large-12 columns featured-image-columns">
		
			<?php hermi_featured_image( 'featured_image' ); ?>
			
		</div>
	</div>
	
</div>			
