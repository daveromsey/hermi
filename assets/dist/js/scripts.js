/*!
 * scrollup v3.0.0-dev
 * http://markgoodyear.com/labs/scrollup/
 * Copyright (c) Mark Goodyear — @markgdyr — http://markgoodyear.com
 * License: 
 */
(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    define([], function () {
      return factory();
    });
  } else if (typeof exports === 'object') {
    module.exports = factory();
  } else {
    root.ScrollUp = factory();
  }
})(this, function () {
  'use strict';

  /**
   * Public API.
   * @type {Object}
   */
  var ScrollUp = {};

  /**
   * Current version.
   * @type {String}
   */
  ScrollUp.VERSION = '3.0.0';

  /**
   * Expose settings.
   * @type {Object}
   */
  ScrollUp.settings = {};

  /**
   * Global vars.
   */
  var isInitialState = true;
  var triggerVisible = false;
  var start;
  var startPos;
  var scrollToPos;
  var animationId;
  var settings;
  var triggerElem;
  var scrollEventThrottled;

  /**
   * Default options.
   * @type {Object}
   */
  var defaults = {
    triggerTemplate: false,
    scrollDistance: 400,
    scrollThrottle: 250,
    scrollDuration: 500,
    scrollEasing: 'linear',
    scrollTarget: false,
    scrollElement: window,
    classes: {
      init: 'scrollup--init',
      show: 'scrollup--show',
      hide: 'scrollup--hide'
    },
    onInit: null,
    onDestroy: null,
    onShow: null,
    onHide: null,
    onTop: null
  };

  /**
   * Required features.
   * @type {Array}
   */
  var features = [
    'querySelector' in document,
    'addEventListener' in window,
    'requestAnimationFrame' in window,
    'classList' in document.documentElement,
    !!Array.prototype.every
  ];

  /**
   * Extend objects.
   * @param  {Object} objects  Objects to merge
   * @return {Object}          New object
   */
  var extend = function (objects) {
    var extended = {};
    var i = 1;
    var prop;

    var merge = function (obj) {
      for (prop in obj) {
        if (Object.prototype.hasOwnProperty.call(obj, prop)) {
          if (Object.prototype.toString.call(obj[prop]) === '[object Object]') {
            extended[prop] = extend(extended[prop], obj[prop]);
          }
          else {
            extended[prop] = obj[prop];
          }
        }
      }
    };

    merge(arguments[0]);

    for (i = 1; i < arguments.length; i++) {
      var obj = arguments[i];

      merge(obj);
    }

    return extended;
  };

  /**
   * Throttle function.
   * @param  {Function} func Function to call
   * @param  {Number}   wait Throttle delay
   * @return {Function}
   */
  var throttle = function (func, wait) {
    var _now =  Date.now || function () { return new Date().getTime(); };
    var context, args, result;
    var timeout = null;
    var previous = 0;

    var later = function () {
      previous = _now();
      timeout = null;
      result = func.apply(context, args);
      context = args = null;
    };

    return function () {
      var now = _now();
      var remaining = wait - (now - previous);
      context = this;
      args = arguments;

      if (remaining <= 0) {
        clearTimeout(timeout);
        timeout = null;
        previous = now;
        result = func.apply(context, args);
        context = args = null;
      } else if (!timeout) {
        timeout = setTimeout(later, remaining);
      }

      return result;
    };
  };

  /**
   * Easings.
   * @param  {Number} t Current time
   * @param  {Number} b Start value
   * @param  {Number} c Change in value
   * @param  {Number} d Duration
   * @return {Number}
   */
  var easings = {
    linear: function (t, b, c, d) {
      return c*t/d + b;
    },

    easeInOutQuad: function (t, b, c, d) {
      t /= d/2;
      if (t < 1) { return c/2*t*t + b; }
      t--;
      return -c/2 * (t*(t-2) - 1) + b;
    },

    easeInOutCube: function (t, b, c, d) {
      t /= d/2;
      if (t < 1) { return c/2*t*t*t + b; }
      t -= 2;
      return c/2*(t*t*t + 2) + b;
    }
  };

  /**
   * Get document height.
   * @ref http://james.padolsey.com/javascript/get-document-height-cross-browser/
   * @return {Number} The document height
   */
  var getDocHeight = function () {
    var body = document.body;
    var docElem = document.documentElement;

    return Math.max(
      body.scrollHeight, docElem.scrollHeight,
      body.offsetHeight, docElem.offsetHeight,
      body.clientHeight, docElem.clientHeight
    );
  };

  /**
   * Get scroll Y position.
   * @return {Number} The scroll Y position
   */
  var getScrollY = function () {
    return (window.pageYOffset !== undefined) ?
      window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
  };

  /**
   * Get Y position of an element.
   * @param  {Object} elem - DOM element
   * @return {Number}
   */
  var getElemY = function (elem) {
    var top = 0;

    while (elem) {
      top += elem.offsetTop;
      elem = elem.offsetParent;
    }

    return top;
  };

  /**
   * Check if all array values are true. Used to check feature list array.
   * @param  {Array}   arr
   * @return {Boolean}
   */
  var truthyArray = function (arr) {
    return arr.every(Boolean);
  };

  /**
   * Scrolling to top loop animation.
   * @param {Number} time - Timestamp from rAF.
   */
  var animationLoop = function (time) {
    if (!start) {
      start = time;
    }

    // Set current time.
    var currentTime = time - start;

    // Set pos with easing.
    var pos = easings[settings.scrollEasing](currentTime, startPos, -startPos + scrollToPos, settings.scrollDuration);

    // Scroll.
    window.scrollTo(0, pos);

    // If current time is less than scrollSpeed, keep going.
    if (currentTime < settings.scrollDuration) {
      animationId = requestAnimationFrame(animationLoop);
    } else {
      stopAninmation();
    }
  };

  /**
   * Stop animation.
   */
  var stopAninmation = function () {

    // Reset vars.
    start = null;
    startPos = null;
    scrollToPos = null;

    // Cancel the animation.
    cancelAnimationFrame(animationId);

    // Callback.
    if (settings.onTop) {
      settings.onTop.call(triggerElem);
    }
  };

  /**
   * Scroll event.
   */
  var scrollEvent = function () {
    if (getScrollY() > settings.scrollDistance) {
      if (triggerVisible) {
        return;
      }

      ScrollUp.showTrigger();
    } else {
      if (!triggerVisible) {
        return;
      }

      ScrollUp.hideTrigger();
    }
  };

  /**
   * Trigger click event.
   */
  var triggerClickEvent = function (event) {
    event.preventDefault();

    // Set where we're scrolling to.
    scrollToPos = getElemY(document.querySelector(settings.scrollTarget)) || 0;

    // Set the start position.
    startPos = getScrollY();

    // Run animation.
    animationId = requestAnimationFrame(animationLoop);
  };

  /**
   * Create trigger elem.
   * @param  {String} template
   * @return {Object}
   */
  var createTrigger = function (template) {
    var tempDiv = document.createElement('div');
    tempDiv.innerHTML = template;

    var elem = tempDiv.firstChild;

    // Append trigger to body
    return document.body.appendChild(elem);
  };

  /**
   * Assign feature test result to public API. "Cuts The Mustard".
   * @type {Boolean}
   */
  ScrollUp.cutsTheMustard = truthyArray(features);

  /**
   * Initialise ScrollUp.
   * @param  {String} elem    - String to use with querySelector()
   * @param  {Object} options - User options
   */
  ScrollUp.init = function (elem, options) {

    // Feature test
    if (!ScrollUp.cutsTheMustard) {
      return;
    }

    // Destroy any existing initializations.
    ScrollUp.destroy();

    // Check if object is passed in as first param and assign options to it.
    if (typeof elem === 'object') {
      options = elem;
    }

    // Merge user options with defaults.
    ScrollUp.settings = settings = extend(defaults, options || {});

    // Create trigger if needed.
    triggerElem = settings.triggerTemplate ? createTrigger(settings.triggerTemplate) : document.querySelector(elem);

    // Events.
    scrollEventThrottled = throttle(scrollEvent, settings.scrollThrottle);
    settings.scrollElement.addEventListener('scroll', scrollEventThrottled, false);
    triggerElem.addEventListener('click', triggerClickEvent, false);

    // Callback.
    if (settings.onInit) {
      settings.onInit.call(triggerElem);
    }
  };

  /**
   * Show trigger.
   */
  ScrollUp.showTrigger = function () {

    // Check initial state to add init class.
    if (isInitialState) {
      ScrollUp.handleInitialState();
    }

    // Remove hide class.
    if (triggerElem.classList.contains(settings.classes.hide)) {
      triggerElem.classList.remove(settings.classes.hide);
    }

    // Add show class.
    triggerElem.classList.add(settings.classes.show);

    // Set global state var.
    triggerVisible = true;

    // Callback.
    if (settings.onShow) {
      settings.onShow.call(triggerElem);
    }
  };

  /**
   * Hide trigger.
   */
  ScrollUp.hideTrigger = function () {

    // Remove show class.
    if (triggerElem.classList.contains(settings.classes.show)) {
      triggerElem.classList.remove(settings.classes.show);
    }

    // Add hide class.
    triggerElem.classList.add(settings.classes.hide);

    // Set global state var.
    triggerVisible = false;

    // Callback.
    if (settings.onHide) {
      settings.onHide.call(triggerElem);
    }
  };

  /**
   * Handle the initial state. Adds the init class.
   */
  ScrollUp.handleInitialState = function () {
    triggerElem.classList.add(settings.classes.init);

    // Set global state var.
    isInitialState = false;
  };

  /**
   * Destroy ScrollUp.
   */
  ScrollUp.destroy = function () {

    // Make sure ScrollUp is initialised first.
    if (!settings) {
      return;
    }

    // Remove events.
    settings.scrollElement.removeEventListener('scroll', scrollEventThrottled);
    triggerElem.removeEventListener('click', triggerClickEvent);

    // Remove DOM element, if created.
    if (settings.triggerTemplate) {
      triggerElem.parentNode.removeChild(triggerElem);
    }

    // Callback.
    if (settings.onDestroy) {
      settings.onDestroy.call(triggerElem);
    }

    // Reset variables.
    isInitialState = true;
    triggerVisible = false;
    start = null;
    startPos = null;
    scrollToPos = null;
    animationId = null;
    settings = null;
    triggerElem = null;
    scrollEventThrottled = null;
  };

  /**
   * Return public API.
   */
  return ScrollUp;
});

/*
 * Initialize Foundation. 
 * ----------------------------------------------------------------------------
 */

// Make the DropdownMenu more responsive feeling.
Foundation.DropdownMenu.defaults.hoverDelay  = 0;
Foundation.DropdownMenu.defaults.closingTime = 0;

// Initialize Foundation
jQuery(document).foundation();

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
/*
 * Initialize scrollUP, a jQuery plugin used for scrolling to the top of the page. 
 * ----------------------------------------------------------------------------
 */

jQuery( document ).ready( function( $ ) {

	// Scroll Up button v3  - https://github.com/markgoodyear/scrollup/tree/v3
	ScrollUp.init({
		triggerTemplate: '<a id="back-to-top" class="back-to-top"></a>',
		scrollDistance: 150,
		scrollThrottle: 50,
		scrollDuration: 200,	    
		classes: {
			init: 'animated',
			show: 'animate-fade-in',
			hide: 'animate-fade-out'
		},
		scrollEasing: 'easeInOutCube',
		onInit: function () {
			// `this` references the element
			//console.log(this, 'Init');
		},
		onDestroy: function () {
			// `this` references the element
			// console.log(this, 'Destroy');
		},
		onHide: function () {
			// Remove the hide class manually because it will still be display:block via CSS, which is needed for the animiation to work.
			var triggerElement = this;
			setTimeout( function() {
      	$( triggerElement ).removeClass( ScrollUp.settings.classes.hide );
			}, 300 ); // The timeout should be slightly longer than the animation-duration set in CSS.
		}
	});		
});

/**
 * A Basic jQuery Plugin for the theme using the Module Pattern
 * @link https://www.sitepoint.com/jquery-plugin-module-pattern/
 */
(function( exports, $, undefined ) {
	var Hermi = function() {

		//-------- PLUGIN VARS ------------------------------------------------------------
		var priv = {}, // private API

		Hermi = {}, // public API

		defaults = {
			// Variables for comments module.
			comments: {
				replyContainer  :   "#respond",
				replySmallWidth :   640, // Width in pixels that defines the small sized reply container.
				replySmallClass :   "comment-reply-small",
				replyLinkSelector : ".comment-reply-link"
			}
		};
		
		//-------- PRIVATE METHODS --------------------------------------------------------
		/*
		priv.options = {}; //private options
		
		priv.method1 = function() {
			console.log('Private method 1 called...');
			$('#videos').append(''+this.options.name+'');
			priv.method2(this.options);
		};

		priv.method2 = function() {
			console.log('Private method 2 called...');
			$('#'+priv.options.id).append(''+this.options.url+''); // append title
			$('#'+priv.options.id).append(''); //append video
		};
		*/

		//-------- PUBLIC METHODS ----------------------------------------------------------
		/*
		Hermi.method1 = function() {
			console.log('Public method 1 called...');
			console.log(Hermi);

			//options called in public methods must access through the priv obj
			console.dir(priv.options);
		};

		Hermi.method2 = function() {
			console.log('Public method 2 called...');
			console.log(Hermi);
		};
		*/

		/**
		 * Toggles styling helper classes on the comment reply form's container.
		 * This allows us to display the Name, Email, and Website fields all on
		 * one line when the comment reply form is wide enough, and then stack these
		 * fields when the form is too skinny.
		 *
		 * @link https://stackoverflow.com/questions/12251750/can-media-queries-resize-based-on-a-div-element-instead-of-the-screen
		 *
		 * TODO: (maybe) incorporate this stuff into Hermi.comments
		 */	
		Hermi.comment_reply_container_size_helper = function() {
			// Comment reply container
			$comment_reply_container = $( Hermi.config.comments.replyContainer );
			
			// Class used to designate small reply container
			comment_reply_small_class = Hermi.config.comments.replySmallClass;
			
			// Toggle the small reply container class
			if ( $comment_reply_container.outerWidth() <= Hermi.config.comments.replySmallWidth ) {
				$comment_reply_container.addClass( comment_reply_small_class );
			} else {
				$comment_reply_container.removeClass( comment_reply_small_class );
			}
		};
	
		/**
		 * Toggle the helper class by firing  comment_reply_container_size_helper()
		 * whenever appropriate.
		 */	
		Hermi.comment_reply_container_toggle_helper_class = function() {
			/**
			 * Throttled function to toggle the helper class when resizing the screen.
			 */		
			$( window ).on( 'resize', Foundation.util.throttle( function( e ){
				Hermi.comment_reply_container_size_helper();
			}, 300 ));

			/**
			 * Trigger the helper function when the comment reply button is clicked
			 * so that the fields are laid out appropriately upon display.
			 */		 
			$( Hermi.config.comments.replyLinkSelector ).click( function( e ) {
				Hermi.comment_reply_container_size_helper();
			});
		};
	
		/**
		 * Public initialization
		 */		
		Hermi.init = function( options ) {
			Hermi.config = $.extend( priv.options, defaults, options || {} );
			
			//priv.method1();

			/**
			 * Adds an HTML class to the comment reply form container 
			 */	
			Hermi.comment_reply_container_size_helper();
			Hermi.comment_reply_container_toggle_helper_class();
			
			return Hermi;
		};
		
		// Return the Public API (Plugin) we want to expose
		return Hermi;
	};

	exports.Hermi = Hermi;

}( this, jQuery ) );

/**
 * Initialize the theme's JS plugin and run other JS related to the theme.
 */
jQuery( document ).ready( function( $ ) {

	/**
	 * Initialize Hermi plugin
	 */	
  var hermi = new Hermi();
	hermi.init( {
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
	 * Add miscellaneous JavaScript below.
	 */
	
	/**
	 * Select contents of search fields on focus.
	 * @link http://stackoverflow.com/a/35941346/3059883
	 */
	$( document ).on( "focus", "input[type=search]", function() { 
		$( this ).select();
	});	
});

//# sourceMappingURL=scripts.js.map
