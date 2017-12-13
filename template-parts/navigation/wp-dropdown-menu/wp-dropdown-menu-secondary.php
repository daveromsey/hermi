<?php 
/**
 * Template part for displaying the primary dropdown navigation.
 *
 * @package Hermi
 * @subpackage Hermi/Navigation
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<nav class="nav-secondary hermi-dropdown-nav horizontal">
 	<?php get_template_part( 'template-parts/navigation/wp-dropdown-menu/wp-nav-menu-secondary' ); ?>
</nav><!-- .nav-secondary .hermi-dropdown-nav .horizontal -->	
