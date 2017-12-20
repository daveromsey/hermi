<?php
/**
 * Template part for displaying secondary meta data for posts.
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
		echo hermi_get_post_category_meta( [
			'wrap_open'  => '<li class="post-categories-meta"><i></i> ',
			'wrap_close' => '</li>'
		] );
		
		echo hermi_get_post_tag_meta( [
			'wrap_open'  => '<li class="post-tags-meta"><i></i> ',
			'wrap_close' => '</li>'
		] );
	
		if ( ! is_singular() ) {
			echo hermi_get_edit_post_link( '<li class="edit-post-link-wrap">', '</li>' );
		}

		// printf( '<li class="edit-user-link-wrap"><a href="%s">%s</a></li>', get_edit_user_link(), __( 'Edit User', 'hermi' ) );
		// echo get_edit_user_link();
		// printf( '<a href="%s">Edit User</a>', get_edit_user_link() );
	?>
</ul><!-- .entry-meta-secondary .entry-meta -->