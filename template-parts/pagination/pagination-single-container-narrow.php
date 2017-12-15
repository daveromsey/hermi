<?php 
/**
 * Template part for displaying pagination container for singular posts.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */  
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<nav class="single-pagination nav-pagination">

	<div class="grid-container">	
		<div class="grid-x align-center">	
			<div class="cell large-8 medium-9 small-12">
				<?php get_template_part( 'template-parts/pagination/pagination-single' ); ?>
			</div><!-- .cell .large-8 .medium-9 .small-12-->				
		</div><!-- .grid-x -->
	</div><!-- .grid-container-->
		
</nav><!-- .single-pagination .nav-pagination -->
