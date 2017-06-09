module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	return plugins.del( CONFIG.PATHS.CLEAN ).then( paths => {
    console.log( 'Clean task done. Files deleted:\n', paths.join( '\n' ) );
	});
};
