<?php 
/** 
 * Template part for displaying pagination using page numbers.
 * 
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
	return;
}	
?>
<nav class="archive-pagination-page-numbers">

	<div class="grid-x align-center">	
		<div class="small-12 cell">
			<?php echo hermi_pagination(); ?>
		</div><!-- .small-12 .cell -->					
	</div><!-- .grid-x -->
	
</nav><!-- .archive-pagination-page-numbers -->