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

<nav class="nav-primary hermi-dropdown-nav horizontal">
	<?php get_template_part( 'template-parts/navigation/dropdown-menu/wp-nav-menu-primary' ); ?>
</nav><!-- .nav-primary .hermi-dropdown-nav .horizontal -->
