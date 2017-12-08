// Copies Foundation Icons from the node_modules directory into our theme's dist directory.
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	return gulp.src( CONFIG.PATHS.FOUNDATION_ICONS, { dot: true } )
		.pipe( gulp.dest( CONFIG.PATHS.CSS_DIST + '/foundation-icons' ) );
};