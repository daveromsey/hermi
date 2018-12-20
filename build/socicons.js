/**
 * Copies socicons-sass from the theme's /source to /dist directory.
 */
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	return gulp.src( CONFIG.PATHS.SOCICON_SASS, { dot: true } )
		.pipe( gulp.dest( CONFIG.PATHS.CSS_DIST + '/socicon-sass' ) );
};
