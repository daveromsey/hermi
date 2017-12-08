/**
 * Clean task: Removes files and directories specified in CONFIG.PATHS.CLEAN.
 *
 * Options:
 *  debug (bool) Outputs deleted items to console when true.
 */
module.exports = function( gulp, plugins, CONFIG, ARGS ) {
	if ( CONFIG.TASK_OPTIONS.clean.debug ) {
		return plugins.del( CONFIG.PATHS.CLEAN ).then( paths => {
			console.log( 'Clean task done. Files deleted:\n', paths.join( '\n' ) );
		});
	} else {
		return plugins.del( CONFIG.PATHS.CLEAN );		
	}
};
