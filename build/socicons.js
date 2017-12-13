/**
 * Copies Socicons from /node_modules into our theme's dist directory.
 */
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	return gulp.src( CONFIG.PATHS.SOCICON_ICONS, { dot: true } )
		.pipe( gulp.dest( CONFIG.PATHS.CSS_DIST + '/socicon' ) );
};