<?php
/**
 * Template part for displaying inner secondary meta data for posts.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */ 
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<ul class="entry-meta-secondary entry-meta">
	<?php
		// Category links
		$post_category_meta = hermi_get_post_category_meta();
		if ( $post_category_meta ) { ?>
			<li class="post-category-meta">
				<span class="post-meta-label"><?php _e( 'Categorized: ', 'hermi' ); ?></span>
				<span class="post-meta"><?php echo wp_kses_post( $post_category_meta ); ?></span>	
			</li><?php
		}
	?>
	
	<?php 
		// Tag links
		$post_tag_meta = hermi_get_post_tag_meta();
		if ( $post_tag_meta ) { ?>
			<li class="post-tag-meta">
				<span class="post-meta-label"><?php _e( 'Tagged: ', 'hermi' ); ?></span>
				<span class="post-meta"><?php echo wp_kses_post( $post_tag_meta ); ?></span>	
			</li><?php
		}
	?>
	
	<?php
		// Edit link
		$edit_post_link = get_edit_post_link();
		if ( $edit_post_link && ! is_singular() ) { ?>
			<li class="edit-post-link-wrap">
				<a class="edit-post-link" href="<?php echo esc_url( $edit_post_link ); ?>">
					<?php _e( 'Edit', 'hermi' ); ?>
				</a>
			</li><?php
		}
	?>
</ul><!-- .entry-meta-secondary .entry-meta -->
