<?php
/**
 * Template part for displaying inner primary meta for posts.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<ul class="entry-meta-primary-inner entry-meta">
	<li class="post-date-meta">
		<span class="post-meta-label"><?php _e( 'Date: ', 'hermi' ); ?></span>
		<span class="post-meta"><?php echo hermi_get_published_date(); ?></span>
	</li>

	<li class="post-author-meta">
		<span class="post-meta-label"><?php _e( 'Author: ', 'hermi' ); ?></span>
		<span class="post-meta"><?php echo hermi_get_post_author_link(); ?></span>
	</li>
	
	<?php if ( comments_open() || ( get_comments_number() >= 1 ) ) { ?>
		<li class="comments-meta">
			<span class="post-meta-label"><?php esc_html_e( 'Comments: ', 'hermi' ); ?></span> 
			<span class="post-meta"><?php 
				comments_popup_link(
					esc_html__( '0', 'hermi' ),
					esc_html__( '1', 'hermi' ),
					esc_html__( '%', 'hermi' ),
					sanitize_html_class( 'comment-count' ),
					''
				); ?>		
			</span>
		</li>
	<?php } ?>
</ul><!-- .entry-meta-primary-inner .entry-meta -->
