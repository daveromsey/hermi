<?php
/**
 * The default sidebar template used by posts and pages.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php do_action( 'hermi_sidebars_before' ); ?>
<aside id="main-widget-area" class="main-widget-area widget-area sidebar">

	<div class="grid-container">
		<div class="grid-x">
			<div class="cell small-12">
		
				<ul class="xoxo js-masonry">
					<?php
						do_action( 'hermi_sidebar_top' );
						
						dynamic_sidebar( 'main-widget-area' );
						
						do_action( 'hermi_sidebar_bottom' ); 
					?>
				</ul>

			</div><!-- .grid-container -->
		</div><!-- .grid-x -->
	</div><!-- .cell small-12 -->
	
</aside>
<?php do_action( 'hermi_sidebars_after' ); ?>

