/**
 * Process JavaScript for TinyMCE plugin that helps with
 * editor content styling in the admin
 */
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	
	var source = gulp.src( CONFIG.PATHS.JAVASCRIPT_TINYMCE )
								.pipe( plugins.sourcemaps.init() )
								.pipe( plugins.jshint( CONFIG.JSHINT_OPTIONS ) )
								.pipe( plugins.jshint.reporter( 'jshint-stylish' ) )
								.pipe( plugins.concat( 'tinymce-editor-style.js' ) );

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
