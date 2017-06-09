// Using a codepoints file as input, generate a CSS file that allows Google's Material Design Icons to be used with classes rather than using ligatures.
// The Material Icon files should be moved over to the CSS_DIST directory before running this task.
//
// Possibly interesting links:
//   https://www.npmjs.com/package/codepoints
//   https://www.npmjs.com/package/css-codepoints
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	var fs = require( 'fs' );
	
	var codepointsFileSource = CONFIG.PATHS.CSS_DIST + "/material-design-icons/codepoints";

	var fileIconsAllCss  = CONFIG.PATHS.CSS_DIST + "/material-design-icons/material-icons-classes-all.css";
	var fileIconsAllScss = CONFIG.PATHS.CSS_DIST + "/material-design-icons/_material-icons-classes-all.scss";
	
	var fileIconsSelectedCss  = CONFIG.PATHS.CSS_DIST + "/material-design-icons/material-icons-classes-selected.css";
	var fileIconsSelectedScss = CONFIG.PATHS.CSS_DIST + "/material-design-icons/_material-icons-classes-selected.scss";

	// Prefix allows us to avoid bad selectors, such as ones that start with a digit. E.g. 3d_rotate
	var iconSelectorPrefix = "mdi-";
	
	var scssFontSrcPath = '$material-icons-path: "." !default;' + "\n";
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
	// CSS - all icons
	try {
		fs.accessSync( fileIconsAllCss, fs.R_OK );
		console.log( "Deleting " + fileIconsAllCss );
		fs.unlinkSync( fileIconsAllCss );
	} catch(e) {
		console.log( fileIconsAllCss + " was not deleted because it did not exist." );
	}
	
	// CSS - selected icons
	try {
		fs.accessSync( fileIconsSelectedCss, fs.R_OK );
		console.log( "Deleting " + fileIconsSelectedCss );
		fs.unlinkSync( fileIconsSelectedCss );
	} catch(e) {
		console.log( fileIconsSelectedCss + " was not deleted because it did not exist." );
	}
	
	// SCSS - all icons
	try {
		fs.accessSync( fileIconsAllScss, fs.R_OK );
		console.log( "Deleting " + fileIconsAllScss );
		fs.unlinkSync( fileIconsAllScss );
	} catch(e) {
		console.log( fileIconsAllScss + " was not deleted because it did not exist." );
	}

	// SCSS - selected icons
	try {
		fs.accessSync( fileIconsSelectedScss, fs.R_OK );
		console.log( "Deleting " + fileIconsSelectedScss );
		fs.unlinkSync( fileIconsSelectedScss );
	} catch(e) {
		console.log( fileIconsSelectedScss + " was not deleted because it did not exist." );
	}	
	
	
	// Add the @font-face rules to our output files:
	// CSS
	fs.appendFileSync( fileIconsAllCss, fontFace );
	fs.appendFileSync( fileIconsSelectedCss, fontFace );
	
	// SCSS
	fs.appendFileSync( fileIconsAllScss, fontFaceScss );		
	fs.appendFileSync( fileIconsSelectedScss, fontFaceScss );		
	
	
	// Add the individual selectors that will use the common declarations.
	var outputBufferAllIcons      = "";
	var outputBufferSelectedIcons = "";
	
	fileContent.toString().trim().split( "\n" ).forEach( function( line, index, arr ) {
		
		var linePieces = line.split( " " ); // A single line of the codepoints file. E.g.: arrow_downward e5db
		var lineEnding = "";
		var iconName;
		var iconCode;
		
		if ( linePieces[0] && linePieces[1] ) {
			// Replace underscores with hyphens
			iconName = linePieces[0].replace( new RegExp( "_", 'g' ), "-" );
			
			// Handle all icons:
			// Add a comma and linebreak unless we're on the last item.
			if ( index !== ( arr.length - 1 ) ) {
				lineEnding = "," + "\n";
			} else {
				lineEnding = "";
			}
			outputBufferAllIcons += '.' + iconSelectorPrefix + iconName + ":before" + lineEnding;
			
			
			// Handle selected icons. If we're using all icons, this will be the same as the all icons output.
			if ( true === CONFIG.MATERIAL_ICONS_INCLUDE_ALL ) {
				outputBufferSelectedIcons = outputBufferAllIcons;
			} else {
				
				if ( typeof CONFIG.MATERIAL_ICONS_INCLUDED !== 'undefined' ) {
					
					if ( CONFIG.MATERIAL_ICONS_INCLUDED.indexOf( iconName ) !== -1 ) {
						
						// Add a comma and linebreak unless we're on the last item.
						if ( iconName !== ( CONFIG.MATERIAL_ICONS_INCLUDED[ CONFIG.MATERIAL_ICONS_INCLUDED.length - 1 ] ) ) {
							lineEnding = "," + "\n";
						} else {
							lineEnding = "";
						}
					
						outputBufferSelectedIcons += '.' + iconSelectorPrefix + iconName + ":before" + lineEnding;						
					}
					
				}
			}
		}
	});	
	
	// Append our formatted list of selectors to the output file.
	// CSS
	fs.appendFileSync( fileIconsAllCss, outputBufferAllIcons );
	fs.appendFileSync( fileIconsSelectedCss, outputBufferSelectedIcons );

	// SCSS
	fs.appendFileSync( fileIconsAllScss, outputBufferAllIcons );	
	fs.appendFileSync( fileIconsSelectedScss, outputBufferSelectedIcons );	
	
	
	// Append main CSS rules
	// CSS
	fs.appendFileSync( fileIconsAllCss, iconCssMain );
	fs.appendFileSync( fileIconsSelectedCss, iconCssMain );
	
	// SCSS
	fs.appendFileSync( fileIconsAllScss, iconCssMain );		
	fs.appendFileSync( fileIconsSelectedScss, iconCssMain );		
	
	
	// Assign the individual rules for each material design icon.
	var outputBufferAllIcons      = "";
	var outputBufferSelectedIcons = "";
	
	fileContent.toString().trim().split( "\n" ).forEach( function( line, index, arr ) {
		var linePieces = line.split( " " ); // A single line of the codepoints file. E.g.: arrow_downward e5db
		var iconName;
		var iconCode;
		
		if ( linePieces[0] && linePieces[1] ) {
			// Replace _ with -
			iconName = linePieces[0].replace( new RegExp( "_", 'g' ), "-" );
			
			// Remove newlines
			iconCode = linePieces[1].replace( /\r?\n|\r/g, "" );
			
			outputBufferAllIcons += "." + iconSelectorPrefix + iconName + ":before { content: '\\" + iconCode + "'; }" + "\n";				
		
			// Handle selected icons. If we're using all icons, this will be the same as the all icons output.
			if ( true === CONFIG.MATERIAL_ICONS_INCLUDE_ALL ) {
				outputBufferSelectedIcons = outputBufferAllIcons;
			} else {
				if ( typeof CONFIG.MATERIAL_ICONS_INCLUDED !== 'undefined' ) {
					
					if ( CONFIG.MATERIAL_ICONS_INCLUDED.indexOf( iconName ) !== -1 ) {
						outputBufferSelectedIcons += "." + iconSelectorPrefix + iconName + ":before { content: '\\" + iconCode + "'; }" + "\n";						
					}
					
				}
			}		
		}
	});
	
	// Append the output buffer containing the mapping for each font icon to our output file. E.g. .mdi-alarm:before { content: "\e855"; }
	// CSS
	fs.appendFileSync( fileIconsAllCss, outputBufferAllIcons );
	fs.appendFileSync( fileIconsSelectedCss, outputBufferSelectedIcons );
	
	
	// SCSS
	fs.appendFileSync( fileIconsAllScss, outputBufferAllIcons );
	fs.appendFileSync( fileIconsSelectedScss, outputBufferSelectedIcons );

	
	// Icon HTML demo page.
	var htmlOutputBefore = "";
	var htmlOutputAfter  = "";
	var htmlAll          = "material-icons-classes-all.html";
	var htmlSelected     = "material-icons-classes-selected.html";
	var cssAll           = "material-icons-classes-all.css";
	var cssSelected      = "material-icons-classes-selected.css";

	// If it exists, delete the existing HTML file so we can start fresh.
	// @link http://stackoverflow.com/questions/4482686/check-synchronously-if-file-directory-exists-in-node-js
	// All icons
	try {
		fs.accessSync( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlAll, fs.R_OK );
		console.log( "Deleting " + CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlAll );
		fs.unlinkSync( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlAll );
	} catch(e) {
		console.log( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlAll + " was not deleted because it did not exist." );
	}
	
	// Selected icons
	try {
		fs.accessSync( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlSelected, fs.R_OK );
		console.log( "Deleting " + CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlSelected );
		fs.unlinkSync( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlSelected );
	} catch(e) {
		console.log( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlSelected + " was not deleted because it did not exist." );
	}
	
	htmlOutputBefore += "<html>" + "\n";
	htmlOutputBefore +=   "<head>" + "\n";
	htmlOutputBefore +=   "<meta charset='UTF-8'>" + "\n";
	htmlOutputBefore +=   "<title>Google Material Design Icons via HTML classes</title>" + "\n";
	htmlOutputBefore +=   "<link rel='stylesheet' type='text/css' href='{{css-file}}'>" + "\n"; // {{css-file}} will be replaced with the path to the appropriate CSS file.
	
	htmlOutputBefore += "<style>" + "\n";
	htmlOutputBefore +=   ".material-icons-demo { display: flex; flex-wrap: wrap; }" + "\n";
	htmlOutputBefore +=   ".material-icons-demo li { list-style: none; margin: 0 30px 30px 0; width: 200px; }" + "\n";
	htmlOutputBefore +=   ".material-icons-demo li span { display: flex; }" + "\n";
	htmlOutputBefore +=   ".material-icons-demo li span:before { margin-right: 10px; }" + "\n";
	htmlOutputBefore += "</style>" + "\n";

	htmlOutputBefore += "</head>" + "\n";
	htmlOutputBefore += "<body>" + "\n";
	htmlOutputBefore += "<main>" + "\n";
	htmlOutputBefore += '<ul class="material-icons-demo">' + "\n";
	
	
	htmlOutputAfter += '</ul>' + "\n";
	htmlOutputAfter += "</main>" + "\n";
	htmlOutputAfter += "</body>" + "\n";
	htmlOutputAfter += "</html>" + "\n";
			
	// All icons
	fs.appendFileSync( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlAll , htmlOutputBefore.replace( /{{css-file}}/, cssAll ) );
	
	// Selected icons
	fs.appendFileSync( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlSelected , htmlOutputBefore.replace( /{{css-file}}/, cssSelected ) );
	
	
	// Assign the individual rules for each material design icon.
	var outputBufferAllIcons      = "";
	var outputBufferSelectedIcons = "";
	
	fileContent.toString().trim().split( "\n" ).forEach( function( line ) {
		var linePieces = line.split( " " );
		var iconName;
		
		if ( linePieces[0] && linePieces[1] ) {
			// Replace _ with -
			iconName = linePieces[0].replace( new RegExp( "_", 'g' ), "-" );
			
			outputBufferAllIcons += '<li><span class="' + iconSelectorPrefix + iconName + '"> ' +  iconSelectorPrefix + iconName + '</span></li>' + "\n";

			// Handle selected icons. If we're using all icons, this will be the same as the all icons output.
			if ( true === CONFIG.MATERIAL_ICONS_INCLUDE_ALL ) {
				outputBufferSelectedIcons = outputBufferAllIcons;
			} else {
				if ( typeof CONFIG.MATERIAL_ICONS_INCLUDED !== 'undefined' ) {
					
					if ( CONFIG.MATERIAL_ICONS_INCLUDED.indexOf( iconName ) !== -1 ) {
						outputBufferSelectedIcons += '<li><span class="' + iconSelectorPrefix + iconName + '"> ' +  iconSelectorPrefix + iconName + '</span></li>' + "\n";					
					}
				}
			}
		}
	});
	
	fs.appendFileSync( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlAll, outputBufferAllIcons + htmlOutputAfter );
	fs.appendFileSync( CONFIG.PATHS.CSS_DIST + "/material-design-icons/" + htmlSelected, outputBufferSelectedIcons + htmlOutputAfter );
	
	
	// Return a promise to notify gulp that this task has completed.
	// @link http://stackoverflow.com/questions/36897877/gulp-error-the-following-tasks-did-not-complete-did-you-forget-to-signal-async
	return new Promise(function(resolve, reject) {
		console.log( "Material Design Icons classes complete." , "\n" );
		resolve();
	});
};
