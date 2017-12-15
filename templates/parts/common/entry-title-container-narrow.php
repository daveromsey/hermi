<?php
/**
 * Template part for displaying the container for the title of a post/page/CPT/etc in
 * a narrow container.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="entry-title-container grid-container">
	<div class="grid-x align-center">
		<div class="cell large-8 medium-9 small-12">
			<?php	get_template_part( 'templates/parts/common/entry-title' ); ?>
		</div><!-- .cell .large-8 .medium-9 .small-12 -->
	</div><!-- .grid-x .align-center -->
</div><!-- .entry-title-container grid-container -->