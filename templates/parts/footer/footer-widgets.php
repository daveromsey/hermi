<?php
/**
 * Template part for displaying the widgetized footer area.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly 
}
?>

<div id="footer-widgets" class="footer-widgets">

	<div class="footer-widgets-inner-wrap grid-container">
		<div class="grid-x small-up-1 medium-up-2 large-up-3">
		
			<ul id="footer-widget-area-1" class="footer-widget-area-1 cell widget-area">
				<?php dynamic_sidebar( 'footer-widget-area-1' ); ?>
			</ul>

			<ul id="footer-widget-area-2" class="footer-widget-area-2 cell widget-area">
				<?php dynamic_sidebar( 'footer-widget-area-2' ); ?>
			</ul>
			
			<ul id="footer-widget-area-3" class="footer-widget-area-3 cell widget-area">
				<?php dynamic_sidebar( 'footer-widget-area-3' ); ?>
			</ul>
			
		</div><!-- .grid-x -->
	</div><!-- .footer-widgets-inner-wrap  .grid-container -->
	
</div><!-- .footer-widgets -->
