/**
 * This is a TinyMCE plugin used by the theme. 
 * 
 * This is used to add an class to the <html> tag used by the TinyMCE editor.
 * Adding a custom class can be helpful when applying editor styles to TinyMCE.
 * 
 * @see /hermi/includes/editor-style.php
 */
(function() {
	tinymce.create( 'tinymce.plugins.hermi_editor_style', {
		
		init : function( editor, url ) {
			
			editor.on( 'init', function(e) {
				// Get the iframe.
				var doc = editor.getDoc();
				
				// Add styling helper class to <html> tag.
				var html_tag = doc.getElementsByTagName( 'html' )[0];
				html_tag.classList.add( 'custom-class' );	
			});			
		},
	});
	
	tinymce.PluginManager.add( 'hermi_editor_style', tinymce.plugins.hermi_editor_style );
})();
//# sourceMappingURL=tinymce-editor-style.js.map
