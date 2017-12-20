<?php 
/** 
 * Template part for displaying for pagination using page numbers.
 * 
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
	return;
}	
?>
<nav class="pagination-archive-numbers pagination-container grid-container">

	<div class="grid-x align-center">	
		<div class="small-12 cell">
			<?php get_template_part( 'templates/parts/pagination/pagination-archive-numbers-inner' ); ?>
		</div><!-- .small-12 .cell -->					
	</div><!-- .grid-x -->
	
</nav><!-- .pagination-archive-numbers -->