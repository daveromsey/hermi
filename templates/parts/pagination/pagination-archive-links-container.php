<?php 
/**
 * Template part for displaying previous and next posts links.
 *
 * This is an alternative/supplement to numeric pagination.
 * 
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
	return;
}	
?>
 
<nav class="pagination-archive-links-container pagination-container grid-container">

	<div class="grid-x align-center">	
		<div class="small-12 cell">
			<?php get_template_part( 'templates/parts/pagination/pagination-archive-links' ); ?>
		</div><!-- .small-12 .cell -->					
	</div><!-- .grid-x -->
	
</nav><!-- .pagination-archive-links-container -->