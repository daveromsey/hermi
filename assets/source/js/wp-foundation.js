/*
 * These functions ensure that WordPress and Foundation play nice together.
 * ----------------------------------------------------------------------------
 */
jQuery( document ).ready( function() {
	// Remove empty P tags created by WP inside of Accordion and Orbit
	// doing via Sass
	//jQuery( '.accordion p:empty, .orbit p:empty' ).remove();

	// Adds Flex Video to YouTube and Vimeo Embeds
	// Flex video is going to be changed to responsive-embeds: https://github.com/zurb/foundation-sites/pull/8765
	// Using a responsive embeds plugin for this because it's more flexible.
	//jQuery( 'iframe[src*="youtube.com"]' ).wrap( "<div class='flex-video widescreen'/>" );
	//jQuery( 'iframe[src*="vimeo.com"]' ).wrap( "<div class='flex-video vimeo widescreen'/>" );
});