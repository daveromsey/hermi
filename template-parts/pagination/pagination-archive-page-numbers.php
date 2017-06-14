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

<div class="archive-pagination-page-numbers-wrap">
	<div class="row">	
		<div class="large-12 columns">
		
			<nav class="archive-pagination-page-numbers-nav">
				<?php echo hermi_pagination(); ?>
			</nav>
			
		</div><!-- .large-12 .columns -->					
	</div><!-- .row -->		
</div><!-- .archive-pagination-page-numbers-wrap -->	