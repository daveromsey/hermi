<?php 
/** 
 * Template part for displaying the container for pagination
 * using page numbers.
 * 
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
	return;
}	
?>
<nav class="pagination-archive-page-numbers-container pagination-container grid-container">

	<div class="grid-x align-center">	
		<div class="small-12 cell">
			<?php get_template_part( 'templates/parts/pagination/pagination-archive-page-numbers' ); ?>
		</div><!-- .small-12 .cell -->					
	</div><!-- .grid-x -->
	
</nav><!-- .pagination-archive-page-numbers-container -->