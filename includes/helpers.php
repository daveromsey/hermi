<?php
/**
 * This file contains helper functions.
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

 
/**
 * Helper function to check if a post has a title.
 * 
 * @param int $post_id ID of the post to check. Checks current post if no ID is passed.
 */
function hermi_has_title( $post_id = null ) {
	global $post;
	$post_id = ( null === $post_id ) ? intval( $post->ID ) : intval( $post_id );
	$post_title = get_the_title( $post_id );
	return ( '' === trim( $post_title ) ) ? false : true;
}


function hermi_use_permalink_meta() {
	global $post;
	$post_format = get_post_format();

	if (
		'' === trim( $post->post_title )
		|| ( 'aside' 	=== $post_format )
		|| ( 'chat' 	=== $post_format && '' === trim( $post->post_title ) )
		|| ( 'link' 	=== $post_format )
		|| ( 'quote' 	=== $post_format )
		|| ( 'status' === $post_format )
	) {
		return true;
	}
	else {
		return false;
	}
}


/**
 * Helper function used to determine if category meta will need to be printed.
 *
 * (!) If the only category is the default category, it will be considered empty. This was done to allow easier, valid, and minimalist post format display handling.
 */ 
function hermi_has_category_meta() {
	global $post;
	$category_terms = wp_get_post_terms( $post->ID, 'category', array( 'hide_empty' => true, 'fields' => 'ids' ) );
	if (
			 ( count( $category_terms ) === 0 )
		|| ( count( $category_terms ) === 1 ) && ( in_array( get_option( 'default_category' ), $category_terms ) )
	) {
		return false;
	}
	else {
		return true;
	}

}

 
/**
 * Helper function used to determine if tag meta will need to be printed
 */
function hermi_has_tag_meta() {
	global $post;
	$tag_terms = wp_get_post_terms( $post->ID, 'post_tag', array( 'hide_empty' => true, 'fields' => 'ids' ) );
	if ( count( $tag_terms ) >= 1 ) {
		return true;
	}
	else {
		return false;
	}
}


/**
 * Template helper function that returns the current post's format name.
 * If were dealing regular posts, or posts with no format, return the string set by $no_format.
 * 
 * @param string $no_format Name to use for posts with no format.
 *
 * @return string format name
 */ 
function hermi_get_post_format_name( $no_format = '' ) {
	$format            = get_post_format();
	$supported_formats = get_theme_support( 'post-formats' );
	
	// Supported formats will be returned as the first key in a multi dimensional array by get_theme_support().
	// Simplify this so that it's just an array of the supported formats, or false, if there are none.
	$supported_formats = ( isset( $supported_formats[0] ) && is_array( $supported_formats[0] ) ) ? $supported_formats[0] : false;
	
	if ( false !== $format && is_array( $supported_formats ) && in_array( $format, $supported_formats ) ) {
		$format = $format;
	} else {
		$format = $no_format;
	}
	
	return $format;
}


/**
 * Gets the link to the next gallery image when viewing a single gallery page.
 *
 *	-	The next image, under normal conditions
 *	-	The first image, if viewing the last image
 *	-	If there is only one image, a disabled control stating that this is the only image in the gallery.
 *
 *	-	The previous image, under normal conditions
 *	-	The last image, if viewing the first image
 *	-	If there is only one image, a disabled control stating that this is the only image in the gallery.
 *
 */
function hermi_get_gallery_nav_info() {
	global $post;
	$gallery_links = array (
										'next' => array (
											'url' 				=> '',
											'title' 			=> '',
											'title_attr' 	=> '',
											'id' 					=> '',
											'will_loop' 	=> false, // true if we are viewing the last image, and this link takes us to the begining
										),
										'previous' 			=> array (
											'url' 				=> '',
											'title' 			=> '',
											'title_attr' 	=> '',
											'id' 					=> '',
											'will_loop' 	=> false, // true if we are viewing the first image, and this link takes us to the end
										),
										'current' 			=> '',
										'count' 				=> '',
									);

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file.
	 */
	$attachment_args = array (
			'post_parent' 		=> $post->post_parent,
			'post_status' 		=> 'inherit',
			'post_type' 			=> 'attachment',
			'post_mime_type' 	=> 'image',
			'order' 					=> 'ASC',
			'orderby' 				=> 'menu_order ID'
	);
	$attachments = array_values( get_children( $attachment_args ) );

	// Populate the value of the current attachment.
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID ) {
			$gallery_links['current'] = $k + 1;
			break;
		}
	}

	// Populate the value of the attachment count.
	$attachments_count 			= count( $attachments );
	$gallery_links['count'] = (int) $attachments_count;

	// Populate the values of the next and previous items...
	// If there is more than 1 attachment in a gallery
	if ( $attachments_count > 1 ) {
		// Next Attachment Link - Next item, if it exists.
		if ( isset ( $attachments[ $k + 1 ] ) ) {
			$gallery_links['next']['url'] 				= get_attachment_link( $attachments[ $k + 1 ]->ID );
			$gallery_links['next']['title'] 			= get_the_title( $attachments[ $k + 1 ]->ID );
			$gallery_links['next']['title_attr'] 	= wptexturize( $gallery_links['next']['title'] );
			$gallery_links['next']['id'] 					= $attachments[ $k + 1 ]->ID;
			$gallery_links['next']['will_loop'] 	= false;
		}
		else { // Next Attachment Link - We're at the end. Get the info for the very first item so we can loop around.
			$gallery_links['next']['url'] 				= get_attachment_link( $attachments[0]->ID );
			$gallery_links['next']['title'] 			= get_the_title( $attachments[0]->ID );
			$gallery_links['next']['title_attr'] 	= sprintf( '%1$s %2$s', __( '(Go to beginning)', 'hermi' ), wptexturize( $gallery_links['next']['title'] ) );
			$gallery_links['next']['id'] 					= $attachments[0]->ID;
			$gallery_links['next']['will_loop'] 	= true;
		}

		// Previous Attachment Link - Previous item, if it exists.
		if ( isset ( $attachments[ $k - 1 ] ) ) {
			$gallery_links['previous']['url'] 				= get_attachment_link( $attachments[ $k - 1 ]->ID );
			$gallery_links['previous']['title'] 			= get_the_title( $attachments[ $k - 1 ]->ID );
			$gallery_links['previous']['title_attr'] 	= wptexturize( $gallery_links['previous']['title'] );
			$gallery_links['previous']['id'] 					= $attachments[ $k - 1 ]->ID;
			$gallery_links['previous']['will_loop'] 	= false;
		}
		else { // Previous Attachment Link - We're at the beginning. Get the info for the very last item so we can navigate backwards from the end.
			$gallery_links['previous']['url'] 				= get_attachment_link( $attachments[ $attachments_count - 1 ]->ID );
			$gallery_links['previous']['title'] 			= get_the_title( $attachments[ $attachments_count - 1 ]->ID );
			$gallery_links['previous']['title_attr'] 	= sprintf( '%1$s %2$s ', __( '(Go to end)', 'hermi' ), wptexturize( $gallery_links['previous']['title'] ) );
			$gallery_links['previous']['id'] 					= $attachments[ $attachments_count - 1 ]->ID;
			$gallery_links['previous']['will_loop'] 	= true;
		}
	}
	else { // If there's only 1 image, return false.
		$gallery_links = false;
	}

	return $gallery_links;
}
