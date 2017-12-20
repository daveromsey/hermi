<?php
/**
 * Template part for displaying the title of a post/page/CPT.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
// Use <h1> and unlinked titles on singular posts.
if ( is_singular() ) { ?>
	<h1 class="entry-title-heading"><?php the_title(); ?></h1><?php
	
} else { // All other templates use <h2> and linked titles. ?>
	<h2 class="entry-title-heading"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php printf( 
			esc_attr__( 'Permalink to %s', 'hermi' ),
			esc_attr( the_title_attribute( 'echo=0' ) )
		); ?>" rel="bookmark"><?php the_title(); ?></a></h2><?php
}
