module.exports = function( gulp, plugins, CONFIG, ARGS, browser ) {
	
	var source = gulp.src( CONFIG.PATHS.CSS )
								.pipe( plugins.sourcemaps.init() )
								.pipe( plugins.autoprefixer( CONFIG.AUTOPREFIXER_OPTIONS ) )
								.pipe( plugins.size() );
								
	var expanded = source.pipe( plugins.clone() )
       .pipe( plugins.sourcemaps.write( '.' ) )
       .pipe( gulp.dest( CONFIG.PATHS.CSS_DIST ) );		

	if ( ARGS.PRODUCTION ) {		 
		var minified = source.pipe( plugins.clone() )
				.pipe( plugins.cssnano() )
				.pipe( plugins.rename( { suffix: '.min' } ) )
				.pipe( plugins.size() )
				.pipe( plugins.sourcemaps.write( '.' ) )
				.pipe( plugins.clip() )
				.pipe( gulp.dest( CONFIG.PATHS.CSS_DIST ) );
				
		return plugins.merge( expanded, minified );
	} else {
		return expanded;		
	}
}