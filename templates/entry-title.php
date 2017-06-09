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
?>

<div class="entry-title-wrap">
	<div class="row">
		<div class="large-12 columns">

			<?php if ( is_singular() ) : // Use <h1>s and unlinked titles on singular posts. ?>
			<?php // ( H1/2 tags on one line to prevent unwanted whitespace.) ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : // All other templates use <h2>s and linked titles. ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'hermi' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php endif; ?>

		</div>
	</div>
</div>