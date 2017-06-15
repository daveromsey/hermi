// Copies images from /source to /dist directory.
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	return gulp.src( CONFIG.PATHS.IMAGES )
		.pipe( gulp.dest( CONFIG.PATHS.IMAGES_DIST ) );
};