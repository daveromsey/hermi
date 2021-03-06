/**
 * File customize-preview.js.
 *
 * Instantly live-update Customizer's settings in the preview for improved user experience.
 */
(function($) {
	// Site title and description.
	wp.customize("blogname", function(value) {
		value.bind(function(to) {
			$(".site-title a").text(to);
		});
	});
	wp.customize("blogdescription", function(value) {
		value.bind(function(to) {
			$(".site-description").text(to);
		});
	});
})(jQuery);
