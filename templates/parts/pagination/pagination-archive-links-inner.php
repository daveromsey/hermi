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
?>

<div class="pagination-archive-links-inner">
	<div class="previous-posts-link-wrap">
		<?php
			previous_posts_link( apply_filters( 'hermi_previous_posts_link_label',
				sprintf( '<i></i>%1$s', __( 'Newer Posts', 'hermi' ) )
			) );
		?>
	</div>
	
	<div class="next-posts-link-wrap">
		<?php
			next_posts_link( apply_filters( 'hermi_next_posts_link_label',
				sprintf( '%1$s<i></i>', __( 'Older Posts', 'hermi' ) )
			) );
		?>
	</div>
</div><!-- .pagination-archive-links-inner -->
