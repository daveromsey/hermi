<?php
/**
 * The main sidebar template.
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
	<ul class="xoxo js-masonry">
		<?php
			do_action( 'hermi_sidebar_top' );
			
			dynamic_sidebar( 'main-widget-area' );
			
			do_action( 'hermi_sidebar_bottom' ); 
		?>
	</ul>
</aside>
<?php do_action( 'hermi_sidebars_after' ); ?>

