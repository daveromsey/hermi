/**
 * This file initializes all of the site's JavaScript
 *
 */

/**
 * Initialize Foundation.
 * ----------------------------------------------------------------------------
 */

// Make the DropdownMenu more responsive feeling.
Foundation.DropdownMenu.defaults.hoverDelay = 0;
Foundation.DropdownMenu.defaults.closingTime = 0;

// Initialize Foundation
jQuery(document).foundation();

/**
 * These functions ensure that WordPress and Foundation play nice together.
 * ----------------------------------------------------------------------------
 */
jQuery(document).ready(function() {
	// Remove empty P tags created by WP inside of Accordion and Orbit
	// doing via Sass
	//jQuery( '.accordion p:empty, .orbit p:empty' ).remove();
	// Adds Flex Video to YouTube and Vimeo Embeds
	// Flex video is going to be changed to responsive-embeds: https://github.com/zurb/foundation-sites/pull/8765
	// Using a responsive embeds plugin for this because it's more flexible.
	//jQuery( 'iframe[src*="youtube.com"]' ).wrap( "<div class='flex-video widescreen'/>" );
	//jQuery( 'iframe[src*="vimeo.com"]' ).wrap( "<div class='flex-video vimeo widescreen'/>" );
});

/**
 * Initialize scrollUP, a jQuery plugin used for scrolling to the top of the page.
 * ----------------------------------------------------------------------------
 */

jQuery(document).ready(function($) {
	// Scroll Up button v3  - https://github.com/markgoodyear/scrollup/tree/v3
	ScrollUp.init({
		triggerTemplate: '<a id="back-to-top" class="back-to-top"></a>',
		scrollDistance: 150,
		scrollThrottle: 50,
		scrollDuration: 200,
		classes: {
			init: "animated",
			show: "animate-fade-in",
			hide: "animate-fade-out"
		},
		scrollEasing: "easeInOutCube",
		onInit: function() {
			// `this` references the element
			//console.log(this, 'Init');
		},
		onDestroy: function() {
			// `this` references the element
			// console.log(this, 'Destroy');
		},
		onHide: function() {
			// Remove the hide class manually because it will still be display:block via CSS, which is needed for the animiation to work.
			var triggerElement = this;
			setTimeout(function() {
				$(triggerElement).removeClass(ScrollUp.settings.classes.hide);
			}, 300); // The timeout should be slightly longer than the animation-duration set in CSS.
		}
	});
});

/**
 * Initialize the theme's JS and run other JS related to the theme.
 */
jQuery(document).ready(function($) {
	/**
	 * Initialize Hermi JS plugin
	 */

	var hermi = new Hermi();
	hermi.init({
		/*
		// Example overrides
		comments : {
			replyContainer    : "#respond",
			replySmallWidth   : 760,
			replySmallClass   : "comment-reply-small",
			replyLinkSelector : ".comment-reply-link"
		}
		*/
	});

	/**
	 * Add miscellaneous JavaScript used by the theme below.
	 */

	/**
	 * Select contents of search fields on focus.
	 * @link http://stackoverflow.com/a/35941346/3059883
	 */
	$(document).on("focus", "input[type=search]", function() {
		$(this).select();
	});
});
