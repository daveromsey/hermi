<?php 
/**
 * Template part for displaying a search box within a navigation menu.
 *
 * @package Hermi
 * @since Hermi 0.1.0 
 */ 
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
 
<div class="search-wrap">
	<?php get_search_form(); ?>
</div>