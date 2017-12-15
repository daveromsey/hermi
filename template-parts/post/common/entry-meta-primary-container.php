<?php
/**
 * Template part for displaying primary meta for posts.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
 
<div class="entry-meta-primary-wrap entry-meta-wrap grid-container">

	<div class="grid-x">
		<div class="cell small-12">
			<?php get_template_part( 'template-parts/post/common/entry-meta-primary' ); ?>
		</div><!-- .cell .small-12 -->
	</div><!-- .grid-x -->
	
</div><!-- .entry-meta-primary-wrap .entry-meta-wrap .grid-container -->