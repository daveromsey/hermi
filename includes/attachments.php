<?php

/**
 * Force comments to be closed on attachment pages.
 */
add_filter( 'comments_open', 'hermi_attachments_disable_comments', 10 , 2 );
function hermi_attachments_disable_comments( $open, $post_id ) {
	$post = get_post( $post_id );
	if ( $post->post_type == 'attachment' ) {
		return false;
	}

	return $open;
}