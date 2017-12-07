/**
 * This is a TinyMCE plugin used by the theme. 
 * 
 * It adds the "row" HTML class to the <html> tag used by the TinyMCE editor.
 *This is helpful when applying editor styles to TinyMCE.
 *
 * @see /hermi/includes/editor-style.php
 */
(function() {
	tinymce.create( 'tinymce.plugins.hermi_editor_style', {
		
		init : function( editor, url ) {
			
			editor.on( 'init', function(e) {
				// Get the iframe.
				var doc = editor.getDoc();
				
				// Add row class to <html> tag for styling purposes
				var html_tag = doc.getElementsByTagName( 'html' )[0];
				html_tag.classList.add( 'row' );				
			});			
		},
	});
	
	tinymce.PluginManager.add( 'hermi_editor_style', tinymce.plugins.hermi_editor_style );
})();