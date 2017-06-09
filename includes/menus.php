<?php

/**
 * Register the navigation menus used by the theme.
 * 
 */
function hermi_register_nav_menus() {
	register_nav_menus( array(
		'off-canvas'    => __( 'Off-Canvas Menu', 'hermi' ),
		'main-nav'      => __( 'Main Menu', 'hermi' ),
		'primary-left'  => __( 'Primary Menu - Left', 'hermi' ),
		'primary-right' => __( 'Primary Menu - Right', 'hermi' ),
		'footer'        => __( 'Footer Menu', 'hermi' ),
	) );
}
add_action( 'after_setup_theme', 'hermi_register_nav_menus' );


// Off Canvas Menu
function hermi_off_canvas_nav() {
	wp_nav_menu( array(
		'container'      => false,                           // Remove nav container
		'menu_class'     => 'vertical menu',       // Adding custom nav class
		'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
		'theme_location' => 'main-nav',        			// Where it's located in the theme
		//'depth'          => 5,                                   // Limit the depth of the nav
		'fallback_cb'    => false,                         // Fallback function (see below)
		'walker' => new Off_Canvas_Menu_Walker()
	));
}



function hermi_foundation_dropdown_nav_right() {
	wp_nav_menu( array(
		'theme_location'  => 'main-nav',
		'walker'          => new Topbar_Menu_Walker(),
		//'walker'         => new hermi_foundation_navigation(),
		'fallback_cb'     => false,
		'container'       => 'div',
		'container_class' => 'top-bar-right show-for-medium foundation-dropdown',
		'menu_class'      => 'vertical medium-horizontal menu',
		'items_wrap'      => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
	) );
}
add_action( 'hermi_foundation_top_bar_nav', 'hermi_foundation_dropdown_nav_right');


/**
 * Remove id attribute from menu items to avoid duplication when the same menu is output multiple times.
 * This will not affect the containers for menus. The ids of the containers can
 * be modified by customizing the items_wrap argument for wp_nav_menu().
 * 
 * See inline docs on nav_menu_item_id for argument details.
 *
 * @since Hermi 0.1.0
 */
function hermi_nav_menu_item_id( $id, $item, $args ) {
	return false;
}
add_filter( 'nav_menu_item_id', 'hermi_nav_menu_item_id', 10, 3 );


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
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );

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
