<?php
/**
 * Template part for displaying secondary meta data container for posts.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="entry-meta-secondary-wrap entry-meta-wrap grid-container">

	<div class="grid-x align-center">
		<div class="cell large-8 medium-9 small-12">
			<?php get_template_part( 'template-parts/post/common/entry-meta-secondary' ); ?>
		</div><!-- .cell .large-8 .medium-9 .small-12-->
	</div><!-- .grid-x -->
	
</div><!-- .entry-meta-secondary-wrap .entry-meta-wrap .grid-container -->
