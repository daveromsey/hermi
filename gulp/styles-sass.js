/**
 * Process Sass files used by the theme.
 */
module.exports = function( gulp, plugins, CONFIG, ARGS, browser ) {
	
	// Combine some different values from our configuration for our full set of Sass options.
	var sassOptions              = CONFIG.SASS_OPTIONS;
			sassOptions.includePaths = CONFIG.PATHS.SASS_INCLUDES;
	
	var source = gulp.src( CONFIG.PATHS.SASS )
								.pipe( plugins.sourcemaps.init() )
								.pipe( plugins.sass( sassOptions )
									.on( 'error', plugins.sass.logError )
									//.on('error', function(err){
										//plugins.sass.logError;
										////console.log(typeof( browser));
										//browser.notify(err.message, 3000);
										//this.emit('end');
									//})

									//.on('error', function(err) {
									//	plugins.notify().write(err);
									//	this.emit('end');
									//})
								)
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