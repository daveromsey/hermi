'use strict';

// Grab our gulp packages
var gulp         = require( 'gulp' ),
		HubRegistry  = require( 'gulp-hub' ),
    autoprefixer = require( 'gulp-autoprefixer' ),
    bower        = require( 'gulp-bower' ),
    babel        = require( 'gulp-babel' ),
		gulpif       = require( 'gulp-if' ),
    clone       = require( 'gulp-clone' ),
    size       = require( 'gulp-size' ),
    clip       = require( 'gulp-clip-empty-files' ),
    merge       = require( 'merge-stream' ),
    concat       = require( 'gulp-concat' ),
    cssnano      = require( 'gulp-cssnano' ),
    uglify       = require( 'gulp-uglify' ),
    path         = require( 'gulp-path' ),
    jshint       = require( 'gulp-jshint' ),
    rename       = require( 'gulp-rename' ),
    sass         = require( 'gulp-sass' ),
    sourcemaps   = require( 'gulp-sourcemaps' ),
    browser      = require( 'browser-sync' ).create(),
    stylish      = require( 'jshint-stylish' ),
    rimraf       = require( 'rimraf' ),
    del          = require( 'del' ),
    fs           = require( 'fs' ),
    yaml         = require( 'js-yaml' ),		
		argv         = require( 'yargs' ).argv;

// Load configuration variables via yaml.	
function loadConfig() {
	let ymlFile = fs.readFileSync( 'config.yml', 'utf8' );
	return yaml.load( ymlFile );
}

/*
var gulper = module.exports = {
	// These constants hold our configuration values.
	constants : const {
		SASS_OPTIONS,
		AUTOPREFIXER_OPTIONS,
		PATHS
	} = loadConfig();
}

module.exports.getConfig = function() {
	return {
		SASS_OPTIONS,
		AUTOPREFIXER_OPTIONS,
		PATHS
	}
}
*/

// These constants hold our configuration values.
const {
	SASS_OPTIONS,
	AUTOPREFIXER_OPTIONS,
	PATHS
} = loadConfig();

// Check for --production flag
const PRODUCTION = !!(argv.production);

/*
// Load files containing tasks into the registry.
var hub = new HubRegistry( [ 'gulp/tasks/*.js' ] );

// Tell gulp to use the tasks just loaded
gulp.registry( hub );
*/

// Delete compiled files.
function clean() {
	return del( PATHS.clean ).then( paths => {
    console.log( 'Clean task done. Files deleted:\n', paths.join( '\n' ) );
	});
}
gulp.task( 'clean', clean );


// Compile Sass, Autoprefix and minify
function styles2() {
	return gulp.src( PATHS.sass )
		
		// Note: Sourcemaps will report line number of parent when selectors are nested.
		// Workaround: CTRL + click property/value in Chrome to jump to correct line in Sass file.
		// @link https://github.com/sass/libsass/issues/1747
		.pipe( sourcemaps.init( /*{ debug: true }*/ ) )
		
		.pipe( sass( SASS_OPTIONS )
			.on( 'error', sass.logError )
		)
		
		.pipe( autoprefixer( AUTOPREFIXER_OPTIONS ) )
		
		// Only minify if --production flag is set when running gulp.
		// Creating expanded and minified files causes issues when generating soucemaps.
		// @link https://github.com/ben-eb/gulp-cssnano/issues/38
		.pipe( gulpif( PRODUCTION, cssnano() ) )
		.pipe( gulpif( PRODUCTION, rename( { suffix: '.min' } ) ) )
		
		.pipe( sourcemaps.write( '.' ) )
		
		.pipe( gulp.dest( PATHS.cssDist ) );

		//.pipe(browser.reload({ stream: true }));
		//.pipe(browser.stream( { match: ['**/*.css', '**/*.map'] } ) );
		
		//.pipe(browser.stream( { match: '**/*.css' } ) );
}


// Compile Sass, Autoprefix and minify
// Stream is split to allow minified and non-minifed files to be created at the same time 
// that sourcemaps are generated.
// @link https://github.com/ben-eb/gulp-cssnano/issues/21#issuecomment-173922771
function styles() {
	var source = gulp.src( PATHS.sass )
								.pipe( sourcemaps.init( /*{ debug: true }*/ ) )
								.pipe( sass( SASS_OPTIONS )
									.on( 'error', sass.logError )
								)
								.pipe( autoprefixer( AUTOPREFIXER_OPTIONS ) )
								.pipe( size() );
								
	var expanded = source.pipe( clone() )
       .pipe( sourcemaps.write( '.' ) )
       .pipe( gulp.dest( PATHS.cssDist ) );		

	if ( PRODUCTION ) {		 
		var minified = source.pipe( clone() )
				.pipe( cssnano() )
				.pipe( rename( { suffix: '.min' } ) )
				.pipe( size() )
				.pipe( sourcemaps.write( '.' ) )
				.pipe( clip() )
				.pipe( gulp.dest( PATHS.cssDist ) );
				
		return merge( expanded, minified );
	} else {
		return expanded;		
	}
}

// JSHint, concat, and minify JavaScript
function siteJS2() {
	//return gulp.src( PATHS.javascript )
	return gulp.src( PATHS.javascriptTheme )
		.pipe( sourcemaps.init() )
		
		.pipe( jshint() )
		.pipe( jshint.reporter( 'jshint-stylish' ) )

		.pipe( concat( 'scripts.js' ) )
		
		.pipe( gulpif( PRODUCTION, uglify().on( 'error', e => { console.log( e ); } ) ) )
		.pipe( gulpif( PRODUCTION, rename( { suffix: '.min' } ) ) )
		
		.pipe( sourcemaps.write( '.' ) )
		
		.pipe( gulp.dest( PATHS.javascriptDist ) );

		//.pipe( browser.reload({ stream: true }) );
		//.pipe( browser.reload );
}   

// JSHint, concat, and minify JavaScript
function siteJS() {
	
	var source = gulp.src( PATHS.javascriptTheme )
								.pipe( sourcemaps.init() )
								.pipe( jshint() )
								.pipe( jshint.reporter( 'jshint-stylish' ) )
								.pipe( concat( 'scripts.js' ) );

   var expanded = source.pipe(clone())
										.pipe( sourcemaps.write( '.' ) )
										.pipe( gulp.dest( PATHS.javascriptDist ) );
										
	if ( PRODUCTION ) {								
   var minified = source.pipe(clone())
										.pipe( uglify().on( 'error', e => { console.log( e ); } ) )
										.pipe( rename( { suffix: '.min' } ) )
										.pipe( sourcemaps.write( '.' ) )
										.pipe( gulp.dest( PATHS.javascriptDist ) );
										
		return merge( expanded, minified );
	} else {
		return expanded;		
	}
}   




// JSHint, concat, and minify Foundation JavaScript
function foundationJS2() {
  return gulp.src( PATHS.javascriptFoundation )
		.pipe( sourcemaps.init() )
		
		.pipe( babel() )
					
		.pipe( concat( 'foundation.js' ) )
		
		.pipe( gulpif( PRODUCTION, uglify().on( 'error', e => { console.log( e ); } ) ) )
		.pipe( gulpif( PRODUCTION,  rename( { suffix: '.min' } ) ) )
		
		.pipe( sourcemaps.write( '.' ) )
		
		.pipe( gulp.dest( PATHS.javascriptDist ) );
		
		//.pipe( browser.reload({ stream: true }) );
		//.pipe( browser.reload() );
}   

// JSHint, concat, and minify Foundation JavaScript
function foundationJS() {
	var source = gulp.src( PATHS.javascriptFoundation )
								.pipe( sourcemaps.init() )
								.pipe( babel() )
								.pipe( concat( 'foundation.js' ) );
								
   var expanded = source.pipe(clone())
										.pipe( sourcemaps.write( '.' ) )
										.pipe( gulp.dest( PATHS.javascriptDist ) );
										
	if ( PRODUCTION ) {			
   var minified = source.pipe(clone())
										.pipe( uglify().on( 'error', e => { console.log( e ); } ) )
										.pipe( rename( { suffix: '.min' } ) )
										.pipe( sourcemaps.write( '.' ) )
										.pipe( gulp.dest( PATHS.javascriptDist ) );
										
		return merge( expanded, minified );
	} else {
		return expanded;		
	}								
}   


// example for copying external files into our dist directory
function bowerScripts() {
	return gulp.src( PATHS.javascriptWhatInput )
		.pipe( gulp.dest( PATHS.javascriptDist ) );
}


// Copies Foundation Icons from the modules directory into our theme's dist directory.
function foundationIcons() {
	return gulp.src( PATHS.foundationIcons )
		.pipe( gulp.dest( PATHS.cssDist + '/foundation-icons' ) );
}


// Copy Google Material Design icons from the modules directory into our theme's dist directory.
function materialDesignIcons() {
	return gulp.src( PATHS.meterialDesignIcons )
		.pipe( gulp.dest( PATHS.cssDist + '/material-design-icons' ) );
}


// Helper function for escaping digits in CSS selectors
function selectorEscapeStartingDigit( selectorString ) {
	// Regex: starting digit, replace it with escaped version. Globally, do for each line.
	// https://regex101.com/r/jO5kM8/1

	// If a selector string begins with a digit, we must escape it. 
	// i.e. .3d-rotation would need to be output as .\33 d-rotation
	// CSS Escapes https://mathiasbynens.be/notes/css-escapes
	// Example:
	//   .\31 a2b3c { } /* matches elements with class="1a2b3c" */
	
	selectorString = selectorString.replace( new RegExp( /(^\d)/gm ), "\\3$1 " ); // substitution string needs to be escaped to avoid error: "Octal literals are not allowed in strict mode".
	
	return selectorString;
}


// Using a codepoints file as input, generate a CSS file that allows Google's Material Design Icons to be used with classes rather than using ligatures.
// The Material Icon files should be moved over to the cssDist directory before running this task.
//
// Possibly interesting links:
//   https://www.npmjs.com/package/codepoints
//   https://www.npmjs.com/package/css-codepoints
function materialDesignIconsClasses( done ) {

	var codepointsFileSource      = PATHS.cssDist + "/material-design-icons/codepoints";
	
	var codepointsFileDestination = PATHS.cssDist + "/material-design-icons/icon-classes.css";
	
	//var materialIconsClassesCss = PATHS.cssDist + "/material-design-icons/material-icons-classes.css";
	var materialIconsClassesScss = PATHS.cssDist + "/material-design-icons/_material-icons-classes.scss";
	var iconSelectorPrefix        = "mdi-";
	
	var scssFontSrcPath =  '$material-icons-path: "." !default;' + "\n";
	var scssFontSrcPathPlaceholder =  '#{$material-icons-path}/';
	
	var fontFace =
			"@font-face {" + "\n" +
				"\t" + "font-family: 'Material Icons';" + "\n" +
				"\t" + "font-style: normal;" + "\n" +
				"\t" + "font-weight: 400;" + "\n" +
				"\t" + "src: url(MaterialIcons-Regular.eot);" + "\n" +
				"\t" + "src: local('Material Icons')," + "\n" +
				"\t" + "local('MaterialIcons-Regular')," + "\n" +
				"\t" + "url(MaterialIcons-Regular.woff2) format('woff2')," + "\n" +
				"\t" + "url(MaterialIcons-Regular.woff) format('woff')," + "\n" +
				"\t" + "url(MaterialIcons-Regular.ttf) format('truetype');" + "\n" +
			"}" + "\n\n";
			
	var fontFaceScss =
			scssFontSrcPath + "\n" +
			"@font-face {" + "\n" +
				"\t" + "font-family: 'Material Icons';" + "\n" +
				"\t" + "font-style: normal;" + "\n" +
				"\t" + "font-weight: 400;" + "\n" +
				"\t" + "src: url('" + scssFontSrcPathPlaceholder + "MaterialIcons-Regular.eot');" + "\n" +
				"\t" + "src: local('" + scssFontSrcPathPlaceholder + "Material Icons')," + "\n" +
				"\t" + "local('" + scssFontSrcPathPlaceholder + "MaterialIcons-Regular')," + "\n" +
				"\t" + "url('" + scssFontSrcPathPlaceholder + "MaterialIcons-Regular.woff2') format('woff2')," + "\n" +
				"\t" + "url('" + scssFontSrcPathPlaceholder + "MaterialIcons-Regular.woff') format('woff')," + "\n" +
				"\t" + "url('" + scssFontSrcPathPlaceholder + "MaterialIcons-Regular.ttf') format('truetype');" + "\n" +
			"}" + "\n\n";
			
	var iconCssMain = " { " + "\n" +
			"\t" + "font-family: 'Material Icons';" + "\n" +
			"\t" + "font-weight: normal;" + "\n" +
			"\t" + "font-style: normal;" + "\n" +
			"\t" + "font-size: 24px;" + "\n" +
			"\t" + "display: inline-block;" + "\n" +
			"\t" + "line-height: 1;" + "\n" +
			"\t" + "text-transform: none;" + "\n" +
			"\t" + "letter-spacing: normal;" + "\n" +
			"\t" + "word-wrap: normal;" + "\n" +
			"\t" + "white-space: nowrap;" + "\n" +
			"\t" + "direction: ltr;" + "\n" +
			"\t" + "-webkit-font-smoothing: antialiased;" + "\n" + // Support for all WebKit browsers
			"\t" + "text-rendering: optimizeLegibility;" + "\n" +  // Support for Safari and Chrome.
			"\t" + "-moz-osx-font-smoothing: grayscale;" + "\n" +  // Support for Firefox.
			"\t" + "font-feature-settings: 'liga' 0;" + "\n" +     // Disable ligatures: https://developer.mozilla.org/en-US/docs/Web/CSS/font-feature-settings
		"}" + "\n\n";			
		
	var fileContent = fs.readFileSync( codepointsFileSource, "utf8" );

	// If codepoints.css exists, delete it so that we can start fresh.
	// @link http://stackoverflow.com/questions/4482686/check-synchronously-if-file-directory-exists-in-node-js
	// CSS
	try {
		fs.accessSync( codepointsFileDestination, fs.R_OK );
		console.log( "Deleting " + codepointsFileDestination );
		fs.unlinkSync( codepointsFileDestination );
	} catch(e) {
		console.log( codepointsFileDestination + " was not deleted because it did not exist." );
	}
	
	// Scss
	try {
		fs.accessSync( materialIconsClassesScss, fs.R_OK );
		console.log( "Deleting " + materialIconsClassesScss );
		fs.unlinkSync( materialIconsClassesScss );
	} catch(e) {
		console.log( materialIconsClassesScss + " was not deleted because it did not exist." );
	}

	// Add the @font-face rules to our output files:
	// CSS
	fs.appendFileSync( codepointsFileDestination, fontFace );		
	// Scss
	fs.appendFileSync( materialIconsClassesScss, fontFaceScss );		
	
	
	// Add the individual selectors that will use the common declarations.
	var outputBuffer = "";
	fileContent.toString().trim().split( "\n" ).forEach( function( line, index, arr ) {
		var linePieces = line.split( " " ); // A single line of the codepoints file. E.g.: arrow_downward e5db
		var lineEnding = "";
		
		if ( linePieces[0] && linePieces[1] ) {
			// Replace _ with -
			linePieces[0] = linePieces[0].replace( new RegExp( "_", 'g' ), "-" );
			
			// Prepend our selector prefix. This allows us to avoid bad selectors, such as ones that start with a digit. E.g. 3d_rotate
			linePieces[0] = iconSelectorPrefix + linePieces[0];
			
			// Add a comma and linebreak unless we're on the last item.
			if ( index !== ( arr.length - 1 ) ) {
				lineEnding = "," + "\n";
			}
			
			// Put together output;
			outputBuffer += '.' + linePieces[0] + ":before" + lineEnding;				
		}
	});	
	
	// Append our formatted list of selectors to the output file.
	// CSS
	fs.appendFileSync( codepointsFileDestination, outputBuffer );
	
	// Scss
	fs.appendFileSync( materialIconsClassesScss, outputBuffer );	
	
	
	// Append main CSS rules
	// CSS
	fs.appendFileSync( codepointsFileDestination, iconCssMain );		
	// Scss
	fs.appendFileSync( materialIconsClassesScss, iconCssMain );		
	
	
	// Assign the individual rules for each material design icon.
	var outputBuffer = "";
	fileContent.toString().trim().split( "\n" ).forEach( function( line, index, arr ) {
		var linePieces = line.split( " " );
		
		if ( linePieces[0] && linePieces[1] ) {
			// Replace _ with -
			linePieces[0] = linePieces[0].replace( new RegExp( "_", 'g' ), "-" );
			
			//linePieces[0] = selectorEscapeStartingDigit( linePieces[0] );
			
			// Add prefix
			linePieces[0] = iconSelectorPrefix + linePieces[0];
						
			// remove newlines
			outputBuffer += "." + linePieces[0] + ":before { content: '\\" + linePieces[1].replace( /\r?\n|\r/g, "" ) + "'; }" + "\n";				
		}
	});
	
	// Append the output buffer containing the mapping for each font icon to our output file. E.g. .mdi-alarm:before { content: "\e855"; }
	// CSS
	fs.appendFileSync( codepointsFileDestination, outputBuffer );
	// Scss
	fs.appendFileSync( materialIconsClassesScss, outputBuffer );
	
	
	// Icon HTML demo page.
	// If it exists, delete the existing codepoints-css-html-test.html file so we can start fresh.
	// @link http://stackoverflow.com/questions/4482686/check-synchronously-if-file-directory-exists-in-node-js
	try {
		fs.accessSync( PATHS.cssDist + "/material-design-icons/codepoints-css-html-test.html", fs.R_OK );
		console.log( "Deleting " + PATHS.cssDist + "/material-design-icons/codepoints-css-html-test.html" );
		fs.unlinkSync( PATHS.cssDist + "/material-design-icons/codepoints-css-html-test.html" );
	} catch(e) {
		console.log( PATHS.cssDist + "/material-design-icons/codepoints-css-html-test.html" + " was not deleted because it did not exist." );
	}	
	
	var htmlOutputBefore = "";
	var htmlOputAfter    = "";
	
	htmlOutputBefore += "<html>" + "\n";
	htmlOutputBefore += "<head>" + "\n";
	htmlOutputBefore += "<meta charset='UTF-8'>" + "\n";
	htmlOutputBefore += "<title>Google Material Design Icons via HTML classes</title>" + "\n";
	htmlOutputBefore += "<link rel='stylesheet' type='text/css' href='icon-classes.css'>" + "\n";
	
	htmlOutputBefore += "<style>" + "\n";
	htmlOutputBefore += ".material-icons-demo { display: flex; flex-wrap: wrap; }" + "\n";
	htmlOutputBefore += ".material-icons-demo li { list-style: none; margin: 0 30px 30px 0; width: 200px; }" + "\n";
	htmlOutputBefore += ".material-icons-demo li span { display: flex; }" + "\n";
	htmlOutputBefore += ".material-icons-demo li span:before { margin-right: 10px; }" + "\n";
	htmlOutputBefore += "</style>" + "\n";

	htmlOutputBefore += "</head>" + "\n";
	htmlOutputBefore += "<body>" + "\n";
	htmlOutputBefore += "<main>" + "\n";
	htmlOutputBefore += '<ul class="material-icons-demo">' + "\n";
	
	htmlOputAfter += '</ul>' + "\n";
	htmlOputAfter += "</main>" + "\n";
	htmlOputAfter += "</body>" + "\n";
	htmlOputAfter += "</html>" + "\n";
			
	fs.appendFileSync( PATHS.cssDist + "/material-design-icons/codepoints-css-html-test.html" , htmlOutputBefore );
	
	// Assign the individual rules for each material design icon.
	var ouputBuffer = "";
	fileContent.toString().trim().split( "\n" ).forEach( function( line ) {
		var linePieces = line.split( " " );
		
		if ( linePieces[0] && linePieces[1] ) {
			// Replace _ with -
			linePieces[0] = linePieces[0].replace( new RegExp( "_", 'g' ), "-" );
			
			//linePieces[0] = selectorEscapeStartingDigit( linePieces[0] );
			linePieces[0] = iconSelectorPrefix + linePieces[0];
			
			ouputBuffer += '<li><span class="' + linePieces[0] + '"> ' +  linePieces[0] + '</span></li>' + "\n";				
		}
	});
	
	fs.appendFileSync( PATHS.cssDist + "/material-design-icons/codepoints-css-html-test.html", ouputBuffer );
	
	fs.appendFileSync( PATHS.cssDist + "/material-design-icons/codepoints-css-html-test.html", htmlOputAfter );
	
	return done();
}


gulp.task( materialDesignIconsClasses,
	gulp.series( materialDesignIconsClasses )
);


// Build the project.
gulp.task( 'build', gulp.series( clean,
																 foundationIcons,
																 gulp.series( materialDesignIcons, materialDesignIconsClasses ),
							                   gulp.parallel( styles, 
																								gulp.series( siteJS, foundationJS ) )
																 
) );
 
 
// Start up the Browsersync server, build the Sass and JS, watch for file changes
gulp.task( 'default',
  gulp.series( 'build', server, watch )
);

function reloadBrowser( done ) {
	browser.reload();
	done();
}

// Start a server with BrowserSync to preview the site.
function server( done ) {
	// Using the original URL, not proxy, with browser-sync
	// http://stackoverflow.com/a/29607382/3059883
	// https://github.com/BrowserSync/browser-sync/issues/646
  browser.init( {
    //proxy:  "daveromsey.com", // TODO Use a default and override with parameters cia cli
    //host:   "daveromsey.com",
    proxy:  "localhost/wp-theme-testing", // TODO Use a default and override with parameters cia cli
    //host:   "wp-theme-testing",
		port:   3000,
		open:   false,
		notify: false,
		ghost:  false /*,
		
		watchOptions: { debounceDelay: 1000 },
		files: [
			PATHS.sass,
			PATHS.javascript,
			PATHS.javascriptFoundationAll,
			PATHS.php
		]*/
  } );

  done();
}

// Reload the browser with BrowserSync
// @link https://github.com/zurb/foundation-zurb-template/pull/37
function reload(done) {
  browser.reload();
  done();
}

// Watch files for changes and reload browser.
function watch() {
	// Watch Sass files
	//gulp.watch( PATHS.sass, gulp.series( styles ) );
	gulp.watch( PATHS.sass ).on( 'change', gulp.series( styles, reload ) );

  // Watch Foundation's JavaScript files
  gulp.watch( PATHS.javascriptFoundationAll ).on( 'change', gulp.series( foundationJS, reload ) );
  
	// Watch theme's JavaScript files
	gulp.watch( PATHS.javascript ).on( 'change', gulp.series( siteJS, reload ) );
  
	// Watch theme's PHP files
	gulp.watch( PATHS.php ).on( 'change', gulp.series( reload ) );
}
