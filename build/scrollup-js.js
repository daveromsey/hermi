// Copies ScrollUp source files from node_modules into our theme's dist directory.
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	return gulp.src( CONFIG.PATHS.JAVASCRIPT_SCROLLUP )
		.pipe( gulp.dest( CONFIG.PATHS.JAVASCRIPT_DIST + '/scrollup' ) );
};