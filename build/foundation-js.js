/**
 * Process Foundation JavaScript. 
 */
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	// Process Foundation source JS.
	var source = gulp.src( CONFIG.PATHS.JAVASCRIPT_FOUNDATION_COMPONENTS )
								.pipe( plugins.sourcemaps.init() )
								.pipe( plugins.babel() )
								.pipe( plugins.concat( 'foundation.js' ) );
							
	// Generate expanded JS.
	var expanded = source.pipe( plugins.clone() )
									.pipe( plugins.sourcemaps.write( '.' ) )
									.pipe( gulp.dest( CONFIG.PATHS.JAVASCRIPT_DIST ) );
	
	// Generate & return minified JS when production flag is set, otherwise return expanded JS. 
	if ( ARGS.PRODUCTION ) {
		var minified = source.pipe( plugins.clone() )
										.pipe( plugins.uglify().on( 'error', e => { console.log( e ); } ) )
										.pipe( plugins.rename( { suffix: '.min' } ) )
										.pipe( plugins.sourcemaps.write( '.' ) )
										.pipe( gulp.dest( CONFIG.PATHS.JAVASCRIPT_DIST ) );
										
		return plugins.merge( expanded, minified );
	} else {
		return expanded;		
	}								   
};
