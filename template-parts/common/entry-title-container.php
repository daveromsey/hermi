<?php
/**
 * Template part for displaying the container for the title of a post/page/CPT/etc.
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
		<div class="cell small-12">
			<?php	get_template_part( 'template-parts/common/entry-title' ); ?>
		</div><!-- .cell .small-12 -->
	</div><!-- .grid-x -->
</div><!-- .entry-title-container grid-container -->