// Copy Google Material Design icons from the modules directory into our theme's dist directory.
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	return gulp.src( CONFIG.PATHS.MATERIAL_ICONS )
		.pipe( gulp.dest( CONFIG.PATHS.CSS_DIST + '/material-design-icons' ) );
};
