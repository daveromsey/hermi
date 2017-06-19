<?php
/**
 * Template part for displaying the secondary dropdown menu.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<nav class="nav-secondary hermi-dropdown-nav horizontal">
 	<?php get_template_part( 'template-parts/navigation/hermi-dropdown-nav/wp-nav-menu-secondary' ); ?>
</nav><!-- .nav-secondary .hermi-dropdown-nav .horizontal -->	
