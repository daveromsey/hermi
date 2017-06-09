// JSHint, concat, and minify JavaScript
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	
	var source = gulp.src( CONFIG.PATHS.JAVASCRIPT_QUEUE )
								.pipe( plugins.sourcemaps.init() )
								.pipe( plugins.jshint() )
								.pipe( plugins.jshint.reporter( 'jshint-stylish' ) )
								.pipe( plugins.concat( 'scripts.js' ) );

   var expanded = source.pipe( plugins.clone() )
										.pipe( plugins.sourcemaps.write( '.' ) )
										.pipe( gulp.dest( CONFIG.PATHS.JAVASCRIPT_DIST ) );
										
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
