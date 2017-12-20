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
 *     tpl-page.php
 *     tpl-page-narrow.php (default)
 *     tpl-page-full-width.php
 *     tpl-page-sidebar-right.php
 *     tpl-page-sidebar-left.php
 */

// Load default template with require_once() because we don't want this to fail silently.  
require_once( locate_template( 'templates/tpl-page-narrow.php' ) ); 

exit();
