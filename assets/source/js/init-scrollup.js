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
