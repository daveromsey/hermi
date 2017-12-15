<?php 
/**
 * Template part for displaying the starting portion of the Off-canvas menu.
 * This takes care of the Off-canvas wrapper markup and Off-canvas menu.
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div class="off-canvas-wrapper">
	<div class="off-canvas position-left" id="off-canvas" data-off-canvas>
		<!-- Off-canvas menu -->
		<?php get_template_part( 'templates/parts/navigation/foundation-off-canvas/wp-nav-menu' ); ?>
	</div>

	<div class="off-canvas-content" data-off-canvas-content>
