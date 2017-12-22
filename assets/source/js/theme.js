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
				replyContainer  : "#respond",
				replySmallWidth : 600,
				replySmallClass : "comment-reply-small"
			}
		};
		
		/*
		//-------- PRIVATE METHODS --------------------------------------------------------

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

		//-------- PUBLIC METHODS ----------------------------------------------------------

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
		
		// Public initialization
		Hermi.init = function( options ) {
			Hermi.config = $.extend( priv.options, defaults, options || {} );
			
			//priv.method1();
			
			return Hermi;
		};
		
		// Return the Public API (Plugin) we want to expose
		return Hermi;
	};

	exports.Hermi = Hermi;

}( this, jQuery ) );

/**
 * Initialize the theme's JS plugin and run other JS
 * related to the theme.
 */
jQuery( document ).ready( function( $ ) {
	
	// Initialize hermi JS plugin
  var hermi = new Hermi();
	
	hermi.init( {
		/*
		// Example overrides
		comments : {
			replyContainer  : "#respond",
			replySmallWidth : 760,
			replySmallClass : "comment-reply-small"
		}
		*/
	});
	
	/**
	 * Select contents of search fields on focus.
	 * @link http://stackoverflow.com/a/35941346/3059883
	 */
	$( document ).on( "focus", "input[type=search]", function() { 
		$( this ).select();
	});

	/**
	 * Toggles styling helper classes on the comment reply form's container.
	 * This allows us to display the Name, Email, and Website fields all on
	 * one line when the comment reply form is wide enough, and then stack these
	 * fields when the form is too skinny.
	 *
	 * TODO incorporate this stuff into Hermi.comments
	 * @link https://stackoverflow.com/questions/12251750/can-media-queries-resize-based-on-a-div-element-instead-of-the-screen
	 */	
	//
	function comment_reply_container_size_helper() {
		$comment_reply_container = $( hermi.config.comments.replyContainer );
		comment_reply_small_class = hermi.config.comments.replySmallClass;
		
		if ( $comment_reply_container.outerWidth() <= hermi.config.comments.replySmallWidth ) {
			$comment_reply_container.addClass( comment_reply_small_class );
		} else {
			$comment_reply_container.removeClass( comment_reply_small_class );
		}		
	}
	
	/**
	 * Adds an HTML class to the comment reply form container 
	 */	
	comment_reply_container_size_helper();

	/**
	 * Throttled function to toggle the helper class when resizing the screen.
	 */		
	$( window ).on( 'resize', Foundation.util.throttle( function( e ){
		comment_reply_container_size_helper();
	}, 300 ));

	/**
	 * Trigger the helper function when the comment reply button is clicked
	 * so that the fields are laid out appropriately upon display.
	 */		 
	$( ".comment-reply-link" ).click( function(e) {
		comment_reply_container_size_helper();
	});
});
