<?php 
/**
 * Template part for displaying pagination for singular posts.
 * 
 * @link http://www.kinocreative.co.uk/hints-and-tips/wordpress-nextprevious-post-navigation-with-images-and-inactive-links/
 *
 * *** Beware of the confusing naming conventions of next_post_link() and previous_post_link() ***
 * 			
 *      Posts are typically listed in descending order by date, starting from the most recent post first.
 * 			next_post_link() gets the link for the next NEWER post
 * 			previous_post_link() gets the link for the next OLDER post
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */  
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="pagination-single">
	<!--  < Newer  -->
	<div class="next-post-link-wrap">
		<?php next_post_link( '%link', sprintf( '<i></i> %1$s', __( 'Newer', 'hermi' ) ), false, '' ); ?>
		<?php if ( ! get_adjacent_post( false, '', false ) ) : ?>
			<span class="no-more" title="<?php _e( "You're viewing our most recent post.", 'hermi' );?>"><?php 
				printf( '<i></i> %1$s', __( 'Newer', 'hermi' ) ); ?></span>
		<?php endif; ?>		
	</div>

	<!--  Older >  -->
	<div class="previous-post-link-wrap">
		<?php previous_post_link( '%link', sprintf( '%1$s <i></i>', __( 'Older', 'hermi' ) ), false, ''); ?>
		<?php if ( ! get_adjacent_post( false, '', true ) ) : ?>
			<span class="no-more" title="<?php _e( "You're viewing our oldest post.", 'hermi' ); ?>"><?php
				printf( '%1$s <i></i>', __( 'Older', 'hermi' ) ); ?></span>
		<?php endif; ?>
	</div>
</div><!-- .pagination-single -->
