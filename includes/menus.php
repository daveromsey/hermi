<?php
/**
 * Menu registration and display.
 * 
 * @package Hermi
 * @subpackage Menus
 */

/**
 * Register the navigation menus used by the theme.
 * 
 */
add_action( 'after_setup_theme', 'hermi_register_nav_menus' );
function hermi_register_nav_menus() {
	register_nav_menus( [
		// Mobile nav (Same for both Foundation and WP dropdown navs)
		'mobile-nav'      => __( 'Mobile Menu', 'hermi' ),
		
		/*
	   * Note: It is suggested to use either the Foundation nav
		 * or the WP Dropdown navs.
		 */
		
		// WP Dropdown nav for large screens.
		'secondary-left'  => __( 'Secondary Menu - Left', 'hermi' ),
		'secondary-right' => __( 'Secondary Menu - Right', 'hermi' ),
		
		'primary-left'    => __( 'Primary Menu - Left', 'hermi' ),
		'primary-center'  => __( 'Primary Menu - Center', 'hermi' ), // unused example
		'primary-right'   => __( 'Primary Menu - Right', 'hermi' ),
		
		
		// Foundation dropdown nav for large screens
		//'main-nav'      => __( 'Main Menu', 'hermi' ),
		
		// Footer nav
		'footer'        => __( 'Footer Menu', 'hermi' ),
	] );
}

/**
 * Remove id attribute from menu items to avoid duplication when the same menu is output multiple times.
 * This will not affect the containers for menus. The ids of the containers can
 * be modified by customizing the items_wrap argument for wp_nav_menu().
 * 
 * See inline docs on nav_menu_item_id for argument details.
 *
 * @since Hermi 0.1.0
 */	
add_filter( 'nav_menu_item_id', 'hermi_nav_menu_item_id', 10, 3 );
function hermi_nav_menu_item_id( $id, $item, $args ) {
	return false;
}


//////////////////////////

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = Array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"menu\">\n";
	}
}

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = Array() ) {
		$indent  = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical nested menu\">\n";
	}
}

// Add Foundation active class to menu
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}

//////////////////////////

/**
 * Custom walker to make menu output more compatible with 
 * Zurb Foundation's Top Bar and Off Canvas menus.
 */
class hermi_foundation_navigation extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		// Add class to navigation sub-menu
		$output .= "\n$indent<ul class='dropdown'>\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( !empty( $children_elements[ $element->$id_field ] ) ) {
			$element->classes[] = 'has-dropdown';
		}
			
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}
