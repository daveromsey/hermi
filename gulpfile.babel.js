'use strict';

//Run alternate file like this: gulp --gulpfile=gulp2.js

var gulp = require( 'gulp' );
var plugins = require( 'gulp-load-plugins' )({
  pattern: [ 
							'gulp-*',
							'gulp.*',
							'del',
							'rimraf',
							'js-yaml',
							'jshint-stylish',
							'merge-stream'
					],
	rename : {
		'js-yaml'        : 'yaml',
		'jshint-stylish' : 'stylish',
		'merge-stream'   : 'merge',
		'gulp-clip-empty-files' : 'clip'
	},
	DEBUG: false,
	lazy: true
});


var browser = require( 'browser-sync' ).create(),
		argv    = require( 'yargs' ).argv;
		
/**
 * Configuration
 */		
function loadConfig() {
	var fs      = require( 'fs' );
	let ymlFile = fs.readFileSync( 'config.yml', 'utf8' );
	return plugins.yaml.load( ymlFile );
}
const CONFIG = loadConfig();


/**
 * Command line arguments
 */
const ARGS = {};

// Check for --production flag
ARGS.PRODUCTION = !!( argv.production );

/**
 * Start a server with BrowserSync to preview the site.
 * 
 */
function server( done ) {
	// Using the original URL, not proxy, with browser-sync
	// http://stackoverflow.com/a/29607382/3059883
	// https://github.com/BrowserSync/browser-sync/issues/646
  browser.init( {
		logSnippet: true,
    //proxy:  "daveromsey.com", // TODO Use a default and override with parameters cia cli
    //host:   "daveromsey.com",
    //host:   "wp-theme-testing",
    
		//proxy:  "localhost/wp-theme-testing", // TODO Use a default and override with parameters cia cli
    
		//open:   'external',
    //host:   "localhost",
		//proxy:  "localhost/wp-theme-testing",
		
		open:   false,
		port:   3000,
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

/**
 * Reload the browser with BrowserSync
 * @link https://github.com/zurb/foundation-zurb-template/pull/37
 */
function reload( done ) {
  browser.reload();
  done();
}

/**
 * Watch files for changes and reload browser.
 */ 
function watch() {
	// Watch images directory.
	gulp.watch( CONFIG.PATHS.IMAGES ).on( 'change', gulp.series( images, reload ) );
	
	// Watch Sass files.
	//gulp.watch( PATHS.sass, gulp.series( styles ) );
	gulp.watch( CONFIG.PATHS.SASS ).on( 'change', gulp.series( stylesSass, reload ) );

	// Watch valilla CSS files.
	gulp.watch( CONFIG.PATHS.CSS ).on( 'change', gulp.series( stylesCSS, reload ) );
  
	// Watch Foundation's JavaScript files.
  gulp.watch( CONFIG.PATHS.JAVASCRIPT_FOUNDATION_ALL ).on( 'change', gulp.series( foundationJS, reload ) );
  
	// Watch theme's JavaScript files.
	gulp.watch( CONFIG.PATHS.JAVASCRIPT ).on( 'change', gulp.series( siteJS, tinymceJS, reload ) );
  
	// Watch theme's PHP files.
	gulp.watch( CONFIG.PATHS.PHP ).on( 'change', gulp.series( reload ) );
}

/**
 * Functions for various tasks
 * 
 */
 
 
function testing(done) {
	clean();
	//console.log( clean );
	//return done();
	
	//require('./gulp/config-load')(gulp, plugins, config);
	
	return done();
}

function clean() {
	return require( './gulp/clean' )( gulp, plugins, CONFIG, ARGS );
}


/**
 * Process image files.
 */
function images() {
	return require( './gulp/images' )( gulp, plugins, CONFIG, ARGS, browser );
}

/**
 * Process Sass files.
 */
function stylesSass() {
	return require( './gulp/styles-sass' )( gulp, plugins, CONFIG, ARGS, browser );
}

/**
 * Copies CSS files from /source to /dist directory.
 * This is used just in case we want to include some plain
 * CSS files with our theme. For instance, if they are not available
 * via a package manager or they are not Sass files.
 */
function stylesCSS() {
	return require( './gulp/styles-css' )( gulp, plugins, CONFIG, ARGS, browser );
}

function foundationIcons() {
	return require( './gulp/foundation-icons' )( gulp, plugins, CONFIG, ARGS );
}

function sociconIcons() {
	return require( './gulp/socicons' )( gulp, plugins, CONFIG, ARGS );
}

function materialDesignIcons() {
	return require( './gulp/material-design-icons' )( gulp, plugins, CONFIG, ARGS );
}

function materialDesignIconsClasses() {
	return require( './gulp/material-design-icons-classes' )( gulp, plugins, CONFIG, ARGS );
}

function siteJS() {
	return require( './gulp/site-js' )( gulp, plugins, CONFIG, ARGS );
}

function tinymceJS() {
	return require( './gulp/tinymce-js' )( gulp, plugins, CONFIG, ARGS );
}

function foundationJS() {
	return require( './gulp/foundation-js' )( gulp, plugins, CONFIG, ARGS );
}

gulp.task( 'mdclasses',
  gulp.series(
		materialDesignIconsClasses,
		function( done ) { done() }
	)
);

gulp.task( 'images',
  gulp.series(
		images,
		function( done ) { done() }
	)
);

gulp.task( 'styles',
	gulp.series(
		clean, 
		foundationIcons,
		gulp.series( materialDesignIcons, materialDesignIconsClasses, stylesSass, stylesCSS ),
		function( done ) {
			done();
		}
	)
);

gulp.task( 'build',
	gulp.series(
		clean, 
		gulp.parallel( foundationIcons, sociconIcons ),
		gulp.series( materialDesignIcons, materialDesignIconsClasses ),
		gulp.parallel(
				images,
				stylesSass,
				stylesCSS,
				gulp.series( siteJS, tinymceJS, foundationJS )
		),
		function( done ) {
			done();
		}
	)
);


// Start up the Browsersync server, build the Sass and JS, watch for file changes
gulp.task( 'default',
  gulp.series( 'build', server, watch, function( done ) { done(); })
);
