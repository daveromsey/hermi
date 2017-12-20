<?php 
/**
 * Template part for displaying pagination for singular posts.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */  
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<nav class="pagination-single pagination-container grid-container">
	<div class="grid-x align-center">	
		<div class="small-12 cell">
			<?php get_template_part( 'templates/parts/pagination/pagination-single-inner' ); ?>
		</div><!-- .small-12 .cell -->					
	</div><!-- .grid-x -->
</nav><!-- .pagination-single .pagination-container .grid-container -->
