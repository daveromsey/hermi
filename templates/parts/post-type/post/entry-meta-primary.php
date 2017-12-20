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
 
<div class="entry-meta-primary entry-meta-container grid-container">

	<div class="grid-x align-center">
		<div class="cell small-12">
			<?php get_template_part( 'templates/parts/post-type/post/entry-meta-primary-inner' ); ?>
		</div><!-- .cell .small-12 -->
	</div><!-- .grid-x -->
	
</div><!-- .entry-meta-primary .entry-meta-container .grid-container -->