<?php
/**
 * The default page template.
 *
 * Change the template name passed to locate_template() below to change
 * the default template. This makes it easier to set the default page template.
 *
 * @package Hermi
 * @since Hermi 0.1.0
 */
 
/**
 * Available templates:
 *	templates/
 *   tpl-page.php
 *   tpl-page-narrow.php (default)
 *   tpl-page-full-width.php
 *   tpl-page-sidebar-right.php
 *   tpl-page-sidebar-left.php
 */

// Load default template with require_once() because we don't want this to fail silently.  
require_once( locate_template(
	apply_filters( 'hermi_default_page_template', 'templates/tpl-page-narrow.php' )
) ); 

/* 
// Example of changing default page template with a filter:
add_filter( 'hermi_default_page_template', 'hermi_change_default_page_template' );
function hermi_change_default_page_template( $page_template ) {
	return 'tpl-page.php';
}
*/

exit();
