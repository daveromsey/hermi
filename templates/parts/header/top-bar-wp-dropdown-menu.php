<?php
/**
 * Template part for displaying the top bar used with the WP Dropdown Menu.
 *
 * @package Hermi
 * @subpackage Hermi/Navigation
 * @since Hermi 0.1.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div id="top-bar" class="top-bar hermi-dropdown-nav-top-bar">

	<div class="top-bar-title">
	
		<!-- Off-canvas menu trigger -->
		<span data-responsive-toggle="responsive-menu" data-hide-for="large" class="hide-for-large">
			<span class="menu-icon dark" data-toggle="off-canvas"></span>
		</span>

		<div class="site-title title-bar-title menu-text">
			<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
		</div>
		
	</div><!-- .top-bar-title -->

</div><!-- .top-bar .hermi-dropdown-nav-top-bar -->