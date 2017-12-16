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
 
<nav class="archive-pagination-links">

	<div class="grid-x align-center">	
		<div class="small-12 cell">
	
			<div class="pagination-links-wrap">
			
				<div class="previous-posts-link-wrap">
					<?php
						previous_posts_link( sprintf(
							apply_filters( 'hermi_previous_posts_link_format', '<i></i>%1$s' ),
							apply_filters( 'hermi_previous_posts_link_text', __( 'Newer Posts', 'hermi' ) )
						) );
					?>
				</div>
				
				<div class="next-posts-link-wrap">
					<?php
						next_posts_link( sprintf(
							apply_filters( 'hermi_next_posts_link_format', '%1$s<i></i>' ),
							apply_filters( 'hermi_next_posts_link_text', __( 'Older Posts', 'hermi' ) )
						) );
					?>
				</div>
				
			</div><!-- .pagination-links-wrap -->			
		
		</div><!-- .small-12 .cell -->					
	</div><!-- .grid-x -->
	
</nav><!-- .archive-pagination-links -->