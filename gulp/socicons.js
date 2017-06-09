// Copies Socicons icons dir from the source directory into our theme's dist directory.
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	return gulp.src( CONFIG.PATHS.SOCICON_ICONS )
		.pipe( gulp.dest( CONFIG.PATHS.CSS_DIST + '/socicon' ) );
};